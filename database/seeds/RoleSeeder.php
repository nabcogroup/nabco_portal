<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                "name"          =>  "user",
                "description"   =>  "",
                "can_view"      =>  true,
            ],
            [
                "name"          =>  "supervisor",
                "description"   =>  "",
                "can_view"      =>  true,
            ],
        ];

        foreach($data as $row) {
            $modRole = new \App\Models\Role();
            foreach($row as $key => $value) {
                $modRole->{$key} = $value;
            }
            $modRole->save();
        }
    }
}
