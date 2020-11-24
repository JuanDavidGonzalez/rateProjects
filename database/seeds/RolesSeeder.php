<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        Roles
        DB::table('roles')->insert([
            'name'=>'root',
            'display_name'=>'Super Admin',
            'description'=>'Usuario super administrador'
        ]);
        DB::table('roles')->insert([
            'name'=>'admin',
            'display_name'=>'Admin',
            'description'=>'Usuario administrador'
        ]);
        DB::table('roles')->insert([
            'name'=>'coordinator',
            'display_name'=>'Coordinador',
            'description'=>'Usuario Cordinador'
        ]);
        DB::table('roles')->insert([
            'name'=>'delegate',
            'display_name'=>'Delegado',
            'description'=>'Usuario delegado'
        ]);

//        Permisos
        DB::table('permissions')->insert([
            'name'=>'create-college',
            'display_name'=>'Registrar instituciones',
            'description'=>'Puede ver, crear y editar instituciones'
        ]);
        DB::table('permissions')->insert([
            'name'=>'create-projects',
            'display_name'=>'Registrar proyectos',
            'description'=>'Puede ver, crear y editar proyectos'
        ]);
        DB::table('permissions')->insert([
            'name'=>'create-groups',
            'display_name'=>'Registrar grupos',
            'description'=>'Puede ver, crear y editar grupos'
        ]);
        DB::table('permissions')->insert([
            'name'=>'create-seedbeds',
            'display_name'=>'Registrar Semilleros',
            'description'=>'Puede ver, crear y editar semilleros'
        ]);

//       Relations

        DB::table('role_user')->insert([
            'user_id'=>1,
            'role_id'=>1,
        ]);

        DB::table('permission_role')->insert([
            'permission_id'=>1,
            'role_id'=>1,
        ]);
    }
}
