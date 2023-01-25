<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class CreateRole
{
    public static function create(object $request)
    {
        $role = Role::create(['name' => $request->name]);

        if (!empty($request->permissions)) {
            $ee = $role->syncPermissions($request->permissions);

        }

        return true;
    }
}
