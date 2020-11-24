<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'administrador',
            'email'=>'admin@aciet.com',
            'password' =>bcrypt('secreto'),
//            'college_id'=>
            'cell_phone'=>'3187110975',
            'position'=>'Administrador'

        ]);
    }
}
