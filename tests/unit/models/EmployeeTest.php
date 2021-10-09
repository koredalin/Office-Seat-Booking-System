<?php

namespace tests\unit\models;

use app\models\Employee;
use app\services\DateTimeManager;

class EmployeeTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testEmployeeValidation()
    {
        $employee = new Employee();

        $employee->first_name = null;
        $this->assertFalse($employee->validate(['first_name']));

        $employee->last_name = 'Ivanov';
        $this->assertTrue($employee->validate(['last_name']));

        $employee->payroll_number = null;
        $this->assertFalse($employee->validate(['payroll_number']));

        $employee->email = 'dddyahoo.com';
        $this->assertFalse($employee->validate(['email']));

        $employee->email = 'ddd@yahoo.com';
        $this->assertTrue($employee->validate(['email']));
    }

    public function testSavingEmployee()
    {
        $payrollTestStr = 'PRN333444';
        
        $employeeInit = new Employee();
        $employeeInit->first_name = 'Ivan';
        $employeeInit->last_name = 'Ivanov';
        $employeeInit->payroll_number = $payrollTestStr;
        $employeeInit->email = 'ivan.ivanov@yahoo.com';
        $employeeInit->created_at = DateTimeManager::nowStr();
        $employeeInit->updated_at = DateTimeManager::nowStr();
        $employeeInit->save();
        // Validates the record into `employees` table.
        expect_that($employee = Employee::findOne(['payroll_number' => $payrollTestStr]));
        // Deletes the record into `employees` table.
        $employee->delete();
        // Not Existing DB record.
        expect_not(Employee::findOne(['payroll_number' => $payrollTestStr]));
    }
}
