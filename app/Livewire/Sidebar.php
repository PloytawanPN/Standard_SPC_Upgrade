<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Sidebar extends Component
{
    public $username,$id,$user_detail;
    public function signout(){

        Session::invalidate();
        Session::regenerate();
        return redirect('/spc/login');
    }
    public function render()
    {
        $this->username = Session::get("username");
        $this->id = Session::get("employee_id");
        $this->user_detail=DB::connection('spc_v2')->table('users')->where('username',$this->username)->first();

        return view('livewire.sidebar');
    }
}
