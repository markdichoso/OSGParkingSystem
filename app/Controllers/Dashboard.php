<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function main()
    {
        // session(); // Start the session

        $session = session();

        if (!$session->has('user_id') || !$session->has('user_fullname') || !$session->has('user_division')) {
            // User is not logged in, redirect to login page
            $session->setFlashdata('error', 'Please log in to access the dashboard.');
            unset($_SESSION['user_id']);
            unset($_SESSION['user_fullname']);
            unset($_SESSION['user_division']);
            echo "<script>
                    window.location.href = './';
                  </script>";
            exit; // Stop further execution
        }
        $data['currentParking'] = self::getCurrentParking($session->get('user_id'));
        $data['availableFreeParkingCount'] = self::getAvailableFreeParkingCount();
        $data['availablePaidParkingCount'] = self::getAvailablePaidParkingCount();
        $data['parkingHistory'] = self::getCurrentMonthHistory($session->get('user_id'));
        return view('main/main', $data);
    }

    public function qrcodescan()
    {
        return view('main/qrcodescan');
    }


    public function attendant()
    {
        return view('main/attendant');
    }


    public function assignParking()
    {
        $session = session();

        $clientEmpNo = $this->request->getPost('client_empno');
        if ($clientEmpNo !== null && $clientEmpNo !== '') {
            $session->set('client_empno', $clientEmpNo);
        }

        if ($clientEmpNo !== null && $clientEmpNo !== '') {
            $activeLog = self::getActiveParkingLog($clientEmpNo);
            if ($activeLog !== null) {
                $this->checkoutParking($activeLog);
                return redirect()->to(base_url('osgparkingsystem/attendant'));
            }
        }

        $data['clientEmpNo'] = $session->get('client_empno');
        $clientProfile = $data['clientEmpNo']
            ? self::getClientProfile($data['clientEmpNo'])
            : null;
        $data['clientName'] = $clientProfile['up_fullname'] ?? '';
        $data['clientVehicles'] = $data['clientEmpNo']
            ? self::getClientVehicle($data['clientEmpNo'])
            : [];
        $data['availableParkingSlots'] = self::getAvailableParkingSlots();
        return view('main/assign-parking', $data);
    }

    private static function getActiveParkingLog($empno)
    {
        $db = \Config\Database::connect();

        return $db->table('parklog_tbl')
            ->where('u_empno', $empno)
            ->where('pl_checkin IS NOT NULL', null, false)
            ->where('pl_checkout IS NULL', null, false)
            ->orderBy('pl_checkin', 'DESC')
            ->get()
            ->getRowArray();
    }

    private function checkoutParking(array $activeLog): void
    {
        $checkin = new \DateTime($activeLog['pl_checkin']);
        $checkout = new \DateTime();
        $elapsedSeconds = max(0, $checkout->getTimestamp() - $checkin->getTimestamp());
        $durationHours = max(1, (int) ceil($elapsedSeconds / 3600));

        if ((string) $activeLog['pl_category'] === '1') {
            $due = $durationHours <= 2
                ? 40
                : 40 + (($durationHours - 2) * 10);
        } else {
            $due = 0;
        }

        $db = \Config\Database::connect();
        $db->transStart();
        $db->table('parklog_tbl')
            ->where('pl_id', $activeLog['pl_id'])
            ->where('pl_checkout IS NULL', null, false)
            ->update([
                'pl_checkout' => $checkout->format('Y-m-d H:i:s'),
                'pl_duration' => $durationHours,
                'pl_due'      => $due,
            ]);

        if (!empty($activeLog['p_id'])) {
            $db->table('parking_tbl')
                ->where('p_id', $activeLog['p_id'])
                ->update(['p_status' => '0']);
        }
        $db->transComplete();

        if (!$db->transStatus()) {
            throw new \RuntimeException('The parking checkout could not be saved.');
        }
    }

    public function confirmEntry()
    {
        $session = session();
        $clientEmpNo = $session->get('client_empno');
        $vehicleId = (int) $this->request->getPost('vehicle_id');
        $parkingId = (int) $this->request->getPost('parking_id');

        if (!$clientEmpNo || $vehicleId < 1 || $parkingId < 1) {
            return $this->response->setStatusCode(422)->setJSON([
                'message' => 'A client, vehicle, and parking slot are required.',
            ]);
        }

        $db = \Config\Database::connect();
        $vehicle = $db->table('vehicle_tbl')
            ->where('v_id', $vehicleId)
            ->where('v_empno', $clientEmpNo)
            ->get()
            ->getRowArray();
        $parkingSlot = $db->table('parking_tbl')
            ->where('p_id', $parkingId)
            ->where('p_status', '0')
            ->get()
            ->getRowArray();

        if (!$vehicle || !$parkingSlot) {
            return $this->response->setStatusCode(422)->setJSON([
                'message' => 'The selected vehicle or parking slot is no longer available.',
            ]);
        }

        $db->transStart();
        $db->table('parklog_tbl')->insert([
            'u_empno'      => $clientEmpNo,
            'v_id'         => $vehicleId,
            'p_id'         => $parkingId,
            'pl_checkin'   => date('Y-m-d H:i:s'),
            'pl_category'  => $parkingSlot['p_category'],
            'pl_checkout'  => null,
            'pl_duration'  => null,
            'pl_due'       => null,
        ]);
        $db->table('parking_tbl')
            ->where('p_id', $parkingId)
            ->where('p_status', '0')
            ->update(['p_status' => '1']);
        $db->transComplete();

        if (!$db->transStatus()) {
            return $this->response->setStatusCode(500)->setJSON([
                'message' => 'The vehicle entry could not be saved.',
            ]);
        }

        $session->set([
            'selected_vehicle_id' => $vehicleId,
            'selected_parking_id' => $parkingId,
        ]);

        return $this->response->setJSON([
            'redirect' => base_url('osgparkingsystem/attendant'),
        ]);
    }

    public function userProfile()
    {
        return view('main/user-profile');
    }

    public function updateProfile()
    {
        return view('main/update-profile');
    }

    public static function getClientVehicle($empno)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('vehicle_tbl');
        $builder->where('v_empno', $empno);
        return $builder->get()->getResultArray();
    }

    public static function getCurrentMonthHistory($empno)
    {
        $startOfMonth = date('Y-m-01 00:00:00');
        $startOfNextMonth = date('Y-m-01 00:00:00', strtotime('+1 month'));

        return \Config\Database::connect()
            ->table('parklog_tbl pl')
            ->select('pl.pl_checkin, pl.pl_category, pl.pl_duration, pl.pl_due, p.p_slotno, p.p_level, v.v_make, v.v_model, v.v_plateno')
            ->join('parking_tbl p', 'p.p_id = pl.p_id', 'left')
            ->join('vehicle_tbl v', 'v.v_id = pl.v_id', 'left')
            ->where('pl.u_empno', $empno)
            ->where('pl.pl_checkin >=', $startOfMonth)
            ->where('pl.pl_checkin <', $startOfNextMonth)
            ->orderBy('pl.pl_checkin', 'DESC')
            ->get()
            ->getResultArray();
    }

    public static function getClientProfile($empno)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('userprofile_tbl');
        $builder->where('up_empno', $empno);
        return $builder->get()->getRowArray();
    }

    public static function getCurrentParking($empno)
    {
        $db = \Config\Database::connect();
        $user = $db->table('users_tbl')
            ->select('u_status')
            ->where('u_empno', $empno)
            ->get()
            ->getRowArray();

        $result = [
            'status' => strtolower((string) ($user['u_status'] ?? 'inactive')) === 'active'
                ? 'Active'
                : 'Inactive',
            'log' => null,
            'durationSeconds' => 0,
        ];

        if ($result['status'] !== 'Active') {
            return $result;
        }

        $log = $db->table('parklog_tbl pl')
            ->select('pl.pl_checkin, pl.pl_category, p.p_slotno, p.p_level, v.v_make, v.v_model, v.v_plateno')
            ->join('parking_tbl p', 'p.p_id = pl.p_id', 'left')
            ->join('vehicle_tbl v', 'v.v_id = pl.v_id', 'left')
            ->where('pl.u_empno', $empno)
            ->where('pl.pl_checkout IS NULL', null, false)
            ->orderBy('pl.pl_checkin', 'DESC')
            ->get()
            ->getRowArray();

        if ($log) {
            $checkin = new \DateTime($log['pl_checkin']);
            $now = new \DateTime();
            $result['durationSeconds'] = max(0, $now->getTimestamp() - $checkin->getTimestamp());
            $result['log'] = $log;
        }

        return $result;
    }

    public static function getAvailableParkingSlots()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '0');
        $builder->orderBy('p_slotno', 'ASC');
        return $builder->get()->getResultArray();
    }

    public static function getParkedCarCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '1');
        return $builder->countAllResults();
    }

    public static function getAvailableFreeParkingCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '0');
        $builder->where('p_category', '0');
        return $builder->countAllResults();
    }

    public static function getAvailablePaidParkingCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('parking_tbl');
        $builder->where('p_status', '0');
        $builder->where('p_category', '1');
        return $builder->countAllResults();
    }
}
