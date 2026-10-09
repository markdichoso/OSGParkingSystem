<?php

namespace App\Libraries;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;

class RememberMe
{
    private const COOKIE_NAME = 'osg_remember';
    private const LIFETIME = 2592000;

    public function issue(string $employeeNumber, IncomingRequest $request, ResponseInterface $response): void
    {
        $this->revokeCookie($request);

        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + self::LIFETIME);
        $db = \Config\Database::connect();
        $db->table('remember_tokens')->where('expires_at <', date('Y-m-d H:i:s'))->delete();
        $db->table('remember_tokens')->insert([
            'selector' => $selector,
            'token_hash' => hash('sha256', $validator),
            'u_empno' => $employeeNumber,
            'expires_at' => $expiresAt,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $response->setCookie(
            self::COOKIE_NAME,
            $selector . ':' . $validator,
            self::LIFETIME,
            '',
            $this->cookiePath(),
            config('Cookie')->prefix,
            $request->isSecure(),
            true,
            'Lax'
        );
    }

    public function restore(IncomingRequest $request, ResponseInterface $response): void
    {
        if (session('user_id')) {
            return;
        }

        $cookie = (string) $request->getCookie(config('Cookie')->prefix . self::COOKIE_NAME);
        if (!preg_match('/\A([a-f0-9]{32}):([a-f0-9]{64})\z/', $cookie, $matches)) {
            if ($cookie !== '') {
                $this->clearCookie($response);
            }
            return;
        }

        [, $selector, $validator] = $matches;
        $db = \Config\Database::connect();
        $token = $db->table('remember_tokens')
            ->where('selector', $selector)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->get()
            ->getRowArray();

        if (!$token || !hash_equals($token['token_hash'], hash('sha256', $validator))) {
            if ($token) {
                $db->table('remember_tokens')->where('selector', $selector)->delete();
            }
            $this->clearCookie($response);
            return;
        }

        $user = $db->table('users_tbl')
            ->where('u_empno', $token['u_empno'])
            ->get()
            ->getRowArray();
        if (!$user) {
            $db->table('remember_tokens')->where('selector', $selector)->delete();
            $this->clearCookie($response);
            return;
        }

        $profile = $db->table('userprofile_tbl')
            ->where('up_empno', $token['u_empno'])
            ->get()
            ->getRowArray() ?? [];

        session()->regenerate(true);
        session()->set([
            'user_id' => $token['u_empno'],
            'user_fullname' => $profile['up_fullname'] ?? '',
            'user_email' => $profile['up_email'] ?? $user['u_email'],
            'user_contact' => $profile['up_mobileno'] ?? '',
            'user_division' => $profile['up_division'] ?? '',
            'user_role' => $profile['up_role'] ?? null,
            'user_image' => $profile['up_image'] ?? '',
        ]);
    }

    public function revokeCookie(IncomingRequest $request): void
    {
        $cookie = (string) $request->getCookie(config('Cookie')->prefix . self::COOKIE_NAME);
        if (preg_match('/\A([a-f0-9]{32}):[a-f0-9]{64}\z/', $cookie, $matches)) {
            \Config\Database::connect()
                ->table('remember_tokens')
                ->where('selector', $matches[1])
                ->delete();
        }
    }

    public function clearCookie(ResponseInterface $response): void
    {
        $response->deleteCookie(
            self::COOKIE_NAME,
            '',
            $this->cookiePath(),
            config('Cookie')->prefix
        );
    }

    private function cookiePath(): string
    {
        $path = parse_url(config('App')->baseURL, PHP_URL_PATH);
        return is_string($path) && $path !== '' ? $path : '/';
    }
}
