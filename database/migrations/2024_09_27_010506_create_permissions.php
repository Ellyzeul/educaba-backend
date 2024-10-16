<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    private array $permissions = [];

    private array $rolesAndPermissions = [
        'admin' => [
            'invite user',
            'access panel',
        ],
        'standard' => [],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach($this->rolesAndPermissions as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);

            foreach($permissions as $permissionName) {
                $role->givePermissionTo($this->permission($permissionName));
            }
        }
    }

    private function permission(string $name): Permission
    {
        if(!isset($this->permissions[$name])) {
            $this->permissions[$name] = Permission::create(['name' => $name]);
        }

        return $this->permissions[$name];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
