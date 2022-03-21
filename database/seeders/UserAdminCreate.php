<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;

class UserAdminCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = User::where('email', 'admin@localhost.com')->first();

        if(!is_null($user_admin)){
            $user_admin = User::updated([
                // 'id'=> 1,
                 'name' =>'Administrador del sistema',
                 'email' => 'admin@localhost.com',
                 'password' => Hash::make('admin'),
                 'tipo' => 1,
                 'estatus'=> 1,
                 'created_at' =>now(),
                 'updated_at' =>now(),
             ]);
        }else{
            $user = User::create([
                // 'id'=> 1,
                 'name' =>'Administrador del sistema',
                 'email' => 'admin@localhost.com',
                 'password' => Hash::make('admin'),
                 'tipo' => 1,
                 'estatus'=> 1,
                 'created_at' =>now(),
                 'updated_at' =>now(),
             ]);
        }
    }
}
