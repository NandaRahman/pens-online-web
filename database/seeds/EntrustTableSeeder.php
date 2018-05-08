<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class EntrustTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $role_admin = new Role();
//        $role_admin->name = 'admin';
//        $role_admin->display_name = 'Admin Login';
//        $role_admin->description = 'Admin';
//        $role_admin->save();
//
//        $role_user = new Role();
//        $role_user->name = 'user';
//        $role_user->display_name = 'User Page';
//        $role_user->description = 'User';
//        $role_user->save();
//
//        $edit_user = new Permission();
//        $edit_user->name = 'edit-user';
//        $edit_user->display_name = 'Edit Users';
//        $edit_user->description = 'edit existing users';
//        $edit_user->save();
//
//        $insert_user = new Permission();
//        $insert_user->name = 'insert-user';
//        $insert_user->display_name = 'Insert User';
//        $insert_user->description = 'insert all data users';
//        $insert_user->save();
//
//        $edit_data = new Permission();
//        $edit_data->name = 'edit-data';
//        $edit_data->display_name = 'Edit Data';
//        $edit_data->description = 'edit all data absence';
//        $edit_data->save();
//
//        $insert_absence = new Permission();
//        $insert_absence->name = 'insert-absence';
//        $insert_absence->display_name = 'Insert Absence';
//        $insert_absence->description = 'insert data absence';
//        $insert_absence->save();
//
//        $view_data = new Permission();
//        $view_data->name = 'view-data';
//        $view_data->display_name = 'View Data';
//        $view_data->description = 'view data absence';
//        $view_data->save();
//
//        $role_admin->attachPermissions([$edit_user, $insert_user, $insert_absence, $edit_data]);
//        $role_user->attachPermissions([$insert_absence]);

        $user = User::create([
            'name' => "Akhmad Mehisa N",
            'username' => "NandaRahman",
            'password' => Hash::make("Nandareus05"),
        ]);
        $user->attachRole(Role::find(1));
        $user->save();

    }
}
