<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                "name"    =>  "it",
                "manager"    =>  "0"
            ],
            [
                "name"    =>  "curtain",
                "manager"    =>  "0",
            ],
            [
                "name"    =>  "showroom",
                "manager"    =>  "0"
            ],
        ];

        $employees = [
            [
                "employee_no"       =>  "0001",
                "first_name"        =>  "Junalen",
                "last_name"         =>  "Tan",
                "middle_name"       =>  "Samillano",
                "passport_no"       =>  "P2957302A",
                "qatar_id"          =>  "000",
                "mobile_no"         =>  "12345",
                "nationality"       =>  "Filipino",
                "date_joined"       =>  Carbon::parse("2010-01-01"),
                "dept"        =>   "showroom"
            ],
            [
                "employee_no"       =>  "0002",
                "first_name"        =>  "Rolito",
                "last_name"         =>  "Belchez",
                "middle_name"       =>  "Guarin",
                "passport_no"       =>  "P1085997A",
                "qatar_id"          =>  "0001",
                "mobile_no"         =>  "12345",
                "nationality"       =>  "Filipino",
                "date_joined"       =>  Carbon::parse("2010-01-01"),
                "dept"        =>   "curtain"
            ]
        ];

        //department
        if(\App\Models\Department::count() == 0 ) {
            foreach ($departments as $department) {

                $departmentModel = new \App\Models\Department($department);

                $departmentModel->save();

            }
        }

        if(\App\Models\Employee::count() == 0) {
            foreach ($employees as $employee) {

                $dept = $employee['dept'];
                unset($employee['dept']);

                $employeeModel = new \App\Models\Employee($employee);
                $employeeModel->setDepartment($dept);
                $employeeModel->save();
            }
        }

    }
}
