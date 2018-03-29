<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name"          =>  "juna",
                "email"         =>  "juna@nabcogroup.co",
                "password"      =>  bcrypt("password"),
                "client_id"     =>  2,
                "employee_id"   =>  1,
                'remember_token' => str_random(10),
                "user_role"     =>  [
                    "role"      =>  "user"
                ]
            ],
            [
                "name"          =>  "rolito",
                "email"         =>  "rolito@nabcogroup.co",
                "password"      =>  bcrypt("password"),
                "client_id"     =>  2,
                "employee_id"   =>  2,
                'remember_token' => str_random(10),
                "user_role"     =>  [
                    "role"      =>  "user"
                ]
            ]
        ];


        foreach($data as $row) {
            $modeUser = new \App\Models\User();
            foreach ($row as $key => $value) {
                if ($key !== 'user_role') {
                    $modeUser->{$key} = $value;
                }
            }

            $modeUser->save();

            //save role
            $user_role = $row['user_role'];

            $role = \App\Models\Role::where('name', $user_role["role"])->first();

            $modeUser->roles()->attach($role);
        }
    }
}
