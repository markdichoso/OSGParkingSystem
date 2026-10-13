<?php
$session = session();
$userRole = $session->get('user_role');
$employeeNumber = $session->get('user_id');
if ($userRole === '2') {
?>

    <header class="fixed top-0 w-full max-w-[1080px] bg-white z-50 shadow-sm">
        <div class="flex items-center justify-between px-5 py-4 h-16">
            <div class="font-['Pacifico'] text-2xl text-primary">
                <img src="<?= base_url('public/img/logo/OSG CAR PARK.png') ?>" style="height: 60px;">
            </div>


            <div class="flex items-center gap-4">
                <!-- <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                    </div> -->
                <div
                    class="w-10 h-10 flex items-center justify-center cursor-pointer"
                    id="menu-button">
                    <i class="ri-menu-line text-2xl text-gray-700"></i>
                </div>
            </div>
        </div>
        <div
            id="menu-dropdown"
            class="absolute right-5 top-16 bg-white rounded-xl shadow-lg w-48 hidden overflow-hidden z-50">
            <div class="py-2">
                <button
                    class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('update-profile'); ?>';">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg">
                        <i class="ri-user-line text-lg text-primary"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Account</span>
                </button>
                <div class="border-t border-gray-100"></div>
                <button
                    class="w-full px-4 py-3 flex items-center gap-3 hover:bg-red-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('signout'); ?>';">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg">
                        <i class="ri-logout-box-r-line text-lg text-red-600"></i>
                    </div>
                    <span class="text-sm font-medium text-red-600">Log Out</span>
                </button>
            </div>
        </div>


    </header>


<?php

} else {
?>

    <header class="fixed top-0 w-full max-w-[1080px] bg-white z-50 shadow-sm">
        <div class="flex items-center justify-between px-5 py-4 h-16">
            <div class="font-['Pacifico'] text-2xl text-primary">
                <img src="<?= base_url('public/img/logo/OSG CAR PARK.png') ?>" style="height: 60px;">
            </div>


            <div class="flex items-center gap-4">
                <!-- <div
                        class="w-10 h-10 flex items-center justify-center cursor-pointer">
                        <i class="ri-notification-3-line text-2xl text-gray-700"></i>
                    </div> -->
                <div
                    class="w-10 h-10 flex items-center justify-center cursor-pointer"
                    id="menu-button">
                    <i class="ri-menu-line text-2xl text-gray-700"></i>
                </div>
            </div>
        </div>
        <div
            id="menu-dropdown"
            class="absolute right-5 top-16 bg-white rounded-xl shadow-lg w-48 hidden overflow-hidden z-50">
            <div class="py-2">
                <button
                    class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('update-profile'); ?>';">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg">
                        <i class="ri-user-line text-lg text-primary"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Account</span>
                </button>
                <div class="border-t border-gray-100"></div>
                <button
                    class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('update-profile'); ?>';">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-blue-50 rounded-lg">
                        <i class="ri-file-text-line text-lg text-primary"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Logs</span>
                </button>
                <div class="border-t border-gray-100"></div>
                <button
                    class="w-full px-4 py-3 flex items-center gap-3 hover:bg-red-50 transition-colors cursor-pointer" onclick="window.location.href = '<?php echo base_url('signout'); ?>';">
                    <div
                        class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg">
                        <i class="ri-logout-box-r-line text-lg text-red-600"></i>
                    </div>
                    <span class="text-sm font-medium text-red-600">Log Out</span>
                </button>
            </div>
        </div>


    </header>

<?php
}

?>