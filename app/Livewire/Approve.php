<?php 

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Exports\UpsertExport;
use App\Exports\InsertExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Query\Builder;

class Approve extends Component
{
    public $requesr_detail, $old_data, $new_data, $test, $password, $all_request, $search_status = "Status", $search_action = "Action";
    public $start, $end, $search;
    public function change_action($action)
    {
        $this->search_action = $action;
    }
    public function change_status($status)
    {
        $this->search_status = $status;
    }
    public function load_update($id)
    {
        $this->new_data = DB::connection('spc_v2')->table('approve_spec')->where('id', $id)->first();
        $this->old_data = DB::connection('spc_v2')->table('spc_spec_v2')->where('id', $this->new_data->spec_id)->first();
    }
    public function load_insert($id)
    {
        $this->new_data = DB::connection('spc_v2')->table('approve_spec')->where('id', $id)->first();
    }
    public function load_upsert($id)
    {
        $this->new_data = DB::connection('spc_v2')->table('approve_spec')->where('id', $id)->first();
        Session::put('group', $this->new_data->group);
    }
    public function load_insert_file($id)
    {
        $this->new_data = DB::connection('spc_v2')->table('approve_spec')->where('id', $id)->first();
        Session::put('group', $this->new_data->group);
    }
    public function export_in()
    {
        return Excel::download(new InsertExport, 'Approve_insert.xlsx');
    }
    public function export_up()
    {
        return Excel::download(new UpsertExport, 'Approve_upsert.xlsx');
    }
    public function close_modal()
    {
        $this->password = null;
    }
    public function approve_insert($id)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        $data = DB::connection("spc_v2")->table('approve_spec')->where('id', $id)->first();
        DB::connection('spc_v2')->table('spc_spec_v2')
            ->insert([
                'dep_name' => Session::get('department'),
                'process_name' => $data->process_name,
                'line_name' => $data->line_name,
                'machine_name' => $data->machine_name,
                'partname' => $data->partname,
                'param_name' => $data->param_name,
                'chart_type' => $data->chart_type,
                'ts_value' => $data->ts_value,
                'us_value' => $data->us_value,
                'ls_value' => $data->ls_value,
                'tc_value' => $data->tc_value,
                'uc_value' => $data->uc_value,
                'lc_value' => $data->lc_value,
                'param_unit_name' => $data->param_unit_name,
                'tcp_value' => $data->tcp_value,
                'tcpk_value' => $data->tcpk_value,
                'tsd_value' => $data->tsd_value,
                'updated_date' => Carbon::now(),
                'created_date' => Carbon::now(),
                'own_account_id' => $data->own_account_id,
                'regis_user_id' => $data->regis_user_id,
                'approve_id' => Session::get('employee_id'),
            ]);
        DB::connection('spc_v2')->table('approve_spec')->where('id', $id)
            ->update([
                'status' => 1,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        return redirect('/spc/approve');
    }
    public function approve_upsert($group)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection("spc_v2")->table('spc_spec_v2')->where('id', '>', 0)->where('dep_name', Session::get('department'))->delete();
        $data = DB::connection("spc_v2")->table('approve_spec')->where('group', $group)->get();
        $arr_data = ($data->toArray());
        $final_file = [];
        $batchSize = 1000;
        foreach ($arr_data as $data) {
            array_push($final_file, [
                'dep_name' => $data->dep_name,
                'process_name' => $data->process_name,
                'line_name' => $data->line_name,
                'machine_name' => $data->machine_name,
                'partname' => $data->partname,
                'param_name' => $data->param_name,
                'chart_type' => $data->chart_type,
                'ts_value' => $data->ts_value,
                'us_value' => $data->us_value,
                'ls_value' => $data->ls_value,
                'tc_value' => $data->tc_value,
                'uc_value' => $data->uc_value,
                'lc_value' => $data->lc_value,
                'param_unit_name' => $data->param_unit_name,
                'tcp_value' => $data->tcp_value,
                'tcpk_value' => $data->tcpk_value,
                'tsd_value' => $data->tsd_value,
                'created_date' => Carbon::now(),
                'updated_date' => Carbon::now(),
                'own_account_id' => $data->own_account_id,
                'regis_user_id' => $data->regis_user_id,
                'approve_id' => Session::get('employee_id'),
            ]);
        }
        for ($i = 0; $i < count($final_file); $i += $batchSize) {
            DB::connection("spc_v2")->table('spc_spec_v2')->insert(array_slice($final_file, $i, $batchSize));
        }

        DB::connection("spc_v2")->table('approve_spec')->where('group', $group)->update([
            'status' => 1,
            'approve_time' => Carbon::now(),
            'approve_id' => Session::get('employee_id'),
        ]);
        DB::connection("spc_v2")->table('approve_spec')->where('action', 0)->where('status', 0)->update([
            'status' => 2,
            'approve_time' => Carbon::now(),
            'approve_id' => Session::get('employee_id'),
        ]);
        return redirect('/spc/approve');
    }
    public function approve_update($spec_id, $id)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        $data = DB::connection("spc_v2")->table('approve_spec')->where('id', $id)->first();
        DB::connection('spc_v2')->table('spc_spec_v2')->where('id', $spec_id)
            ->update([
                'process_name' => $data->process_name,
                'line_name' => $data->line_name,
                'machine_name' => $data->machine_name,
                'partname' => $data->partname,
                'param_name' => $data->param_name,
                'chart_type' => $data->chart_type,
                'ts_value' => $data->ts_value,
                'us_value' => $data->us_value,
                'ls_value' => $data->ls_value,
                'tc_value' => $data->tc_value,
                'uc_value' => $data->uc_value,
                'lc_value' => $data->lc_value,
                'param_unit_name' => $data->param_unit_name,
                'tcp_value' => $data->tcp_value,
                'tcpk_value' => $data->tcpk_value,
                'tsd_value' => $data->tsd_value,
                'updated_date' => Carbon::now(),
                'own_account_id' => $data->own_account_id,
                'regis_user_id' => $data->regis_user_id,
                'approve_id' => Session::get('employee_id'),
            ]);
        DB::connection('spc_v2')->table('approve_spec')->where('id', $id)
            ->update([
                'status' => 1,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        DB::connection('spc_v2')->table('approve_spec')
            ->where('spec_id', $spec_id)
            ->where('request_time', '<', $data->request_time)
            ->where('status', 0)
            ->update([
                'status' => 2,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);

        return redirect('/spc/approve');
    }
    public function approve_insert_file($group)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        $data = (DB::connection("spc_v2")->table('approve_spec')->where('group', $group)->get());
        $arr_data = ($data->toArray());
        $final_file = [];
        $batchSize = 1000;
        foreach ($arr_data as $data) {
            array_push($final_file, [
                'dep_name' => $data->dep_name,
                'process_name' => $data->process_name,
                'line_name' => $data->line_name,
                'machine_name' => $data->machine_name,
                'partname' => $data->partname,
                'param_name' => $data->param_name,
                'chart_type' => $data->chart_type,
                'ts_value' => $data->ts_value,
                'us_value' => $data->us_value,
                'ls_value' => $data->ls_value,
                'tc_value' => $data->tc_value,
                'uc_value' => $data->uc_value,
                'lc_value' => $data->lc_value,
                'param_unit_name' => $data->param_unit_name,
                'tcp_value' => $data->tcp_value,
                'tcpk_value' => $data->tcpk_value,
                'tsd_value' => $data->tsd_value,
                'created_date' => Carbon::now(),
                'updated_date' => Carbon::now(),
                'own_account_id' => $data->own_account_id,
                'regis_user_id' => $data->regis_user_id,
                'approve_id' => Session::get('employee_id'),
            ]);
        }
        for ($i = 0; $i < count($final_file); $i += $batchSize) {
            DB::connection("spc_v2")->table('spc_spec_v2')->insert(array_slice($final_file, $i, $batchSize));
        }
        DB::connection("spc_v2")->table('approve_spec')->where('group', $group)->update([
            'status' => 1,
            'approve_time' => Carbon::now(),
            'approve_id' => Session::get('employee_id'),
        ]);
        return redirect('/spc/approve');
    }
    public function reject_upsert($group)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->where('group', $group)
            ->update([
                'status' => 2,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        return redirect('/spc/approve');
    }
    public function reject_insert_file($group)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->where('group', $group)
            ->update([
                'status' => 2,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        return redirect('/spc/approve');
    }
    public function reject_update($id)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->where('id', $id)
            ->update([
                'status' => 2,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        return redirect('/spc/approve');
    }
    public function reject_insert($id)
    {
        $this->validate([
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->where('id', $id)
            ->update([
                'status' => 2,
                'approve_time' => Carbon::now(),
                'approve_id' => Session::get('employee_id'),
            ]);
        return redirect('/spc/approve');
    }
    public function render()
    {
        $t1 = DB::connection('spc_v2')->table('approve_spec')->distinct('group')
            ->where('group', '!=', 0)
            ->where('dep_name', Session::get('department'))
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
                if ($this->search_status != 'Status') {
                    if ($this->search_status == 'Waiting') {
                        $query->where('status', 0);
                    } elseif ($this->search_status == 'All') {
                        $query->where(function (Builder $query) {
                            $query->orwhere('status', 0);
                            $query->orwhere('status', 1);
                            $query->orwhere('status', 2);
                        });
                    } elseif ($this->search_status == 'Approve') {
                        $query->where('status', 1);
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
                    }elseif ($this->search == 'Approve' or $this->search == 'approve') {
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
        return view('livewire.approve');
    }
}
