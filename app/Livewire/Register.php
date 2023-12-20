<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Register extends Component
{
    public $department_all, $username, $password, $confirm_password, $department, $employee_id;
    public function register()
    {
        $this->validate([
            'department' => 'required',
            'employee_id' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $check_id = DB::connection('spc_v2')->table('users')->where('employee_ID', $this->employee_id)->count();
                    if ($check_id != 0) {
                        $fail('This employee id already exists');
                    }
                }
            ],
            'username' => [
                'required',
                function ($attribute, $value, $fail) {
                    $check_username = DB::connection('spc_v2')->table('users')->where('username', $this->username)->count();
                    if ($check_username != 0) {
                        $fail('This username already exists');
                    }
                }
            ],
            'password' => [
                'required',
                'min:5',
                function ($attribute, $value, $fail) {
                    $int = filter_var($value,FILTER_SANITIZE_NUMBER_INT);
                    if ($int=="") {
                        $fail('Required number and char in password');
                    }
                }
            ],
            'confirm_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value!=$this->password) {
                        $fail('Passwords do not match');
                    }
                }
            ]
        ]);
        DB::connection("spc_v2")->table("users")->insert([
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'department' => $this->department,
            'employee_ID' => $this->employee_id,
            'token' => 0,
            'role' => 0,
            'status' => 0,
            'modifield_at' => Carbon::now(),
            'create_at' => Carbon::now(),
        ]);
        return redirect('/spc/login');
    }
    public function re_login(){
        return redirect('/spc/login');
    }
    public function render()
    {
        $this->department_all = DB::connection("spc_v2")->table("department")->where("status", 1)->get();
        return view('livewire.register');
    }
}
