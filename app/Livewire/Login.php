<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Login extends Component
{
    public $username, $password;
    public function sign_in()
    {

        $day_ago = Carbon::now()->subDays(7)->format('Y-m-d');

        $approve_detail = DB::connection('spc_v2')->table('approve_spec')
            ->where('request_time', '<=', $day_ago)
            ->where('status', 0)
            ->delete();

        $this->validate([
            'username' => [
                'required',
                function ($attribute, $value, $fail) {
                    $check_user = DB::connection("spc_v2")->table("users")->where("username", $this->username)->count();
                    if ($check_user == 0) {
                        $fail("This username invalid");
                    }
                },
                function ($attribute, $value, $fail) {
                    $detail = DB::connection("spc_v2")->table("users")->where("username", $this->username)->first();
                    if ($detail->status == 1) {
                        $fail("This username invalid");
                    }
                }
            ],
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $check_user = DB::connection("spc_v2")->table("users")->where("username", $this->username)->count();
                    $password = DB::connection("spc_v2")->table("users")->where("username", $this->username)->select('password')->get();
                    if ($check_user != 0) {
                        if ((Hash::check($this->password, $password[0]->password) == false)) {
                            $fail("This password invalid");
                        }
                    }
                },
                function ($attribute, $value, $fail) {
                    $check_user = DB::connection("spc_v2")->table("users")->where("username", $this->username)->count();
                    $password = DB::connection("spc_v2")->table("users")->where("username", $this->username)->select('password')->get();
                    $detail = DB::connection("spc_v2")->table("users")->where("username", $this->username)->first();
                    if ($detail->status == 1) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        $user_detail = DB::connection("spc_v2")->table("users")->where("username", $this->username)->get();
        DB::connection("spc_v2")->table("users")
            ->where('id', $user_detail[0]->id)
            ->update(['token' => Session::get('_token')]);
        Session::put('username', $user_detail[0]->username);
        Session::put('department', $user_detail[0]->department);
        Session::put('employee_id', $user_detail[0]->employee_ID);
        Session::put('rows', 10);
        return redirect('/spc/dashboard');

    }
    public function re_signun()
    {
        return redirect('/spc/register');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
