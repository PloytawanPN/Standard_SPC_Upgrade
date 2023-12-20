<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Request extends Component
{
    public $requesr_detail,$all_request,$search_status="Status",$search_action="Action";
    public $start,$end,$search,$request_id,$employee_id,$password;

    public function confirm_cancel(){
        $request=(DB::connection("spc_v2")->table("approve_spec")->where('id',$this->request_id )->first());
        //dd($request);
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ],
            'employee_id' => 'required|numeric'
        ]);

        if($request->action==0){
            DB::connection("spc_v2")->table("approve_spec")->where('id', $this->request_id)->delete();
        }elseif($request->action==2){
            DB::connection("spc_v2")->table("approve_spec")->where('group', $request->group)->delete();
        }else{
            if($request->group==0){
                DB::connection("spc_v2")->table("approve_spec")->where('id', $this->request_id)->delete();
            }else{
                DB::connection("spc_v2")->table("approve_spec")->where('group', $request->group)->delete();
            }
        }

        return redirect('/spc/request');

        /* DB::connection("spc_v2")->table("approve_spec")->where('votes', '>', 100)->delete(); */

    }
    public function clear_pass(){
        $this->employee_id=null;
        $this->password=null;
    }
    public function rq_id($id){
        $this->request_id=$id;
    }
    public function change_action($action)
    {
        $this->search_action = $action;
    }
    public function change_status($status)
    {
        $this->search_status = $status;
    }    public function render()
    {

        $t1 = DB::connection('spc_v2')->table('approve_spec')->distinct('group')
            ->where('group', '!=', 0)
            ->where('dep_name', Session::get('department'))
            ->where(function (Builder $query) {
                $query->orwhere('regis_user_id', Session::get('employee_id'));
                $query->orwhere('own_account_id', Session::get('employee_id'));
            })
            ->where(function (Builder $query) {
                if ($this->search_status != 'Status') {
                    if ($this->search_status == 'Waiting') {
                        $query->where('status', 0);
                    } elseif ($this->search_status == 'Approve') {
                        $query->where('status', 1);
                    } elseif ($this->search_status == 'All') {
                        $query->where(function (Builder $query) {
                            $query->orwhere('status', 0);
                            $query->orwhere('status', 1);
                            $query->orwhere('status', 2);
                        });
                    } else {
                        $query->where('status', 2);
                    }
                }
                if ($this->search_action != 'Action') {
                    if ($this->search_action == 'Insert') {
                        $query->where('action', 1);
                    } elseif ($this->search_action == 'Upsert') {
                        $query->where('action', 2);
                    }elseif ($this->search_action == 'All') {
                        $query->where(function (Builder $query) {
                            $query->orwhere('action', 0);
                            $query->orwhere('action', 1);
                            $query->orwhere('action', 2);
                        });
                    } else {
                        $query->where('action', 0);
                    }
                }
                if (isset($this->start)) {
                    $query->where('request_time', '>=', '"' . $this->start . '"');
                }
                if (isset($this->end)) {
                    $query->where('request_time', '<', '"' . $this->end . '"');
                }
                if (isset($this->search)) {
                    if ($this->search == 'Wait' or $this->search == 'Waiting' or $this->search == 'wait' or $this->search == 'waiting') {
                        $query->where('status', 0);
                    } elseif ($this->search == 'Approve' or $this->search == 'approve') {
                        $query->where('status', 1);
                    } elseif ($this->search == 'Reject' or $this->search == 'reject') {
                        $query->where('status', 2);
                    } elseif ($this->search == 'insert' or $this->search == 'Insert') {
                        $query->where('action', 1);
                    } elseif ($this->search == 'upsert' or $this->search == 'Upsert') {
                        $query->where('action', 2);
                    } elseif ($this->search == 'update' or $this->search == 'Update') {
                        $query->where('action', 0);
                    } else {
                        $query->where(function (Builder $query) {
                            $query->orwhere('regis_user_id', 'like', '%' . $this->search . '%');
                        });
                    }
                }
            });



        $t2 = DB::connection('spc_v2')->table('approve_spec')
            ->where('group', 0)
            ->where('dep_name', Session::get('department'))
            ->where(function (Builder $query) {
                $query->orwhere('regis_user_id', Session::get('employee_id'));
                $query->orwhere('own_account_id', Session::get('employee_id'));
            })
            ->where(function (Builder $query) {
                if ($this->search_status != 'Status') {
                    if ($this->search_status == 'Waiting') {
                        $query->where('status', 0);
                    } elseif ($this->search_status == 'Approve') {
                        $query->where('status', 1);
                    } elseif ($this->search_status == 'All') {
                        $query->where(function (Builder $query) {
                            $query->orwhere('status', 0);
                            $query->orwhere('status', 1);
                            $query->orwhere('status', 2);
                        });
                    } else {
                        $query->where('status', 2);
                    }
                }
                if ($this->search_action != 'Action') {
                    if ($this->search_action == 'Insert') {
                        $query->where('action', 1);
                    } elseif ($this->search_action == 'Upsert') {
                        $query->where('action', 2);
                    }elseif ($this->search_action == 'All') {
                        $query->where(function (Builder $query) {
                            $query->orwhere('action', 0);
                            $query->orwhere('action', 1);
                            $query->orwhere('action', 2);
                        });
                    } else {
                        $query->where('action', 0);
                    }
                }
                if (isset($this->start)) {
                    $query->where('request_time', '>=', '"' . $this->start . '"');
                }
                if (isset($this->end)) {
                    $query->where('request_time', '<', '"' . $this->end . '"');
                }
                if (isset($this->search)) {
                    if ($this->search == 'Wait' or $this->search == 'Waiting' or $this->search == 'wait' or $this->search == 'waiting') {
                        $query->where('status', 0);
                    } elseif ($this->search == 'Approve' or $this->search == 'approve') {
                        $query->where('status', 1);
                    } elseif ($this->search == 'Reject' or $this->search == 'reject') {
                        $query->where('status', 2);
                    } elseif ($this->search == 'insert' or $this->search == 'Insert') {
                        $query->where('action', 1);
                    } elseif ($this->search == 'upsert' or $this->search == 'Upsert') {
                        $query->where('action', 2);
                    } elseif ($this->search == 'update' or $this->search == 'Update') {
                        $query->where('action', 0);
                    } else {
                        $query->where(function (Builder $query) {
                            $query->orwhere('regis_user_id', 'like', '%' . $this->search . '%');
                        });
                    }
                }
            });

        $this->requesr_detail = $t1->union($t2)->orderBy('request_time', 'desc')->get();
        $this->all_request = $this->requesr_detail->count();
        return view('livewire.request');
    }
}
