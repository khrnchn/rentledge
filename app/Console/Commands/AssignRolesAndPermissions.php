<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRolesAndPermissions extends Command
{
    protected $signature = 'assign:roles';
    protected $description = 'Assign roles and permissions to users';

    public function __construct()
    {
        parent::__construct();
    }

    // $user = User::create($data);
    // $user->assignRole('student');
    // $permissions = $user->getPermissionsViaRoles();
    // $user->givePermissionTo($permissions);

    public function handle()
    {
        $userWithTenantRole = User::find(5);
        $userWithTenantRole->assignRole('tenant');
        $tenantPermissions = $userWithTenantRole->getPermissionsViaRoles();
        $success = $userWithTenantRole->givePermissionTo($tenantPermissions);

        if ($success) {
            $this->info('Roles and permissions assigned successfully for Rahimi.');
        }

        $userWithLandlordRole = User::find(6);
        $userWithLandlordRole->assignRole('landlord');
        $landlordPermissions = $userWithLandlordRole->getPermissionsViaRoles();
        $success = $userWithLandlordRole->givePermissionTo($landlordPermissions);

        if ($success) {
            $this->info('Roles and permissions assigned successfully for Shamim.');
        }
    }
}
