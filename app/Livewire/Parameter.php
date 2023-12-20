<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use App\Imports\SpecImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
use App\Exports\SpecExport;
use Rap2hpoutre\FastExcel\FastExcel;



class Parameter extends Component
{

    use WithFileUploads;

    public $rows, $param, $url;
    public $process, $line, $machine, $spec_id, $partname, $variable, $chart, $ts, $us, $ls, $tc, $uc, $lc, $unit, $tcp, $tcpk, $tsd;
    public $check_id, $check_password, $search_text, $file, $action,$check_edit=0,$message,$group;

    public function export()
    {
        return Excel::download(new SpecExport, Session::get('department') . '_spec.xlsx');
    }
    public function save_edit(){
        $this->message="*";
        $this->validate([
            'process' => 'required',
            'line' => 'required',
            'machine' => 'required',
            'partname' => 'required',
            'variable' => 'required',
            'chart' => 'required',
            'ts' => 'required|numeric',
            'us' => 'required|numeric',
            'ls' => 'required|numeric',
            'tc' => 'required|numeric',
            'uc' => 'required|numeric',
            'lc' => 'required|numeric',
            'unit' => 'required',
            'tcp' => 'required|numeric',
            'tcpk' => 'required|numeric',
            'tsd' => 'required|numeric',
        ]);
        $this->message=null;
        $this->check_edit+=1;
    }
    public function register()
    {
        $this->check_edit=0;
        $this->validate([
            'process' => 'required',
            'line' => 'required',
            'machine' => 'required',
            'partname' => 'required',
            'variable' => 'required',
            'chart' => 'required',
            'ts' => 'required|numeric',
            'us' => 'required|numeric',
            'ls' => 'required|numeric',
            'tc' => 'required|numeric',
            'uc' => 'required|numeric',
            'lc' => 'required|numeric',
            'unit' => 'required',
            'tcp' => 'required|numeric',
            'tcpk' => 'required|numeric',
            'tsd' => 'required|numeric',
        ]);
        $this->check_edit+=1;
    }
    public function register_spec(){
        $this->validate([
            'check_id' => 'required|numeric',
            'check_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->check_password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->insert([
            'dep_name' => Session::get('department'),
            'process_name' => $this->process,
            'line_name' => $this->line,
            'machine_name' => $this->machine,
            'partname' => $this->partname,
            'param_name' => $this->variable,
            'chart_type' => $this->chart,
            'ts_value' => $this->ts,
            'us_value' => $this->us,
            'ls_value' => $this->ls,
            'tc_value' => $this->tc,
            'uc_value' => $this->uc,
            'lc_value' => $this->lc,
            'param_unit_name' => $this->unit,
            'tcp_value' => $this->tcp,
            'tcpk_value' => $this->tcpk,
            'tsd_value' => $this->tsd,
            'own_account_id' => Session::get('employee_id'),
            'regis_user_id' => $this->check_id,
            'status' => 0,
            'request_time' => Carbon::now(),
            'spec_id' => 0,
            'action' => 1,
            'group' => 0,
        ]);
        return redirect('/spc/parameter');
    }
    public function cancel(){
        $this->check_edit=0;
        $this->check_id=null;
        $this->action=null;
        $this->file=null;
        $this->check_password=null;
        $this->message=null;
    }
    public function add_file()
    {
        $this->check_edit=0;
        $this->validate([
            'file' => 'required|mimes:xlsx, xls ,csv',
            'action' => 'required',
        ]);
        $this->check_edit+=1;
    }

    public function change_action($action)
    {
        $this->action = $action;
    }

    public function insert_file()
    {
        set_time_limit(0);
        $this->validate([
            'file' => 'required|mimes:xlsx, xls ,csv',
            'action' => 'required',
            'check_id' => 'required|numeric',
            'check_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->check_password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);

        $this->group=(DB::connection("spc_v2")->table('approve_spec')->max('group'));
        if($this->group==null){
            $this->group=0;
        }
        $filePath = $this->file->path();
        $data = (new FastExcel)->import($filePath, function ($file) {
            $final_file['dep_name']=$file['dep_name'];
            $final_file['process_name']=$file['process_name'];
            $final_file['line_name']=$file['line_name'];
            $final_file['machine_name']=$file['machine_name'];
            $final_file['partname']=$file['partname'];
            $final_file['param_name']=$file['param_name'];
            $final_file['chart_type']=$file['chart_type'];
            $final_file['ts_value']=$file['ts_value'];
            $final_file['us_value']=$file['us_value'];
            $final_file['ls_value']=$file['ls_value'];
            $final_file['tc_value']=$file['tc_value'];
            $final_file['uc_value']=$file['uc_value'];
            $final_file['lc_value']=$file['lc_value'];
            $final_file['param_unit_name']=$file['param_unit_name'];
            $final_file['tcp_value']=$file['tcp_value'];
            $final_file['tcpk_value']=$file['tcpk_value'];
            $final_file['tsd_value']=$file['tsd_value'];
            $final_file['own_account_id']=Session::get('employee_id');
            $final_file['regis_user_id']=$this->check_id;
            $final_file['status']=0;
            $final_file['request_time']=Carbon::now();
            $final_file['spec_id']=0;
            $final_file['action']=$this->action;
            $final_file['group']=$this->group+1;
            return collect($final_file);
        })->toArray();
        $batchSize = 1000;
        for ($i = 0; $i < count($data); $i += $batchSize) {
            DB::connection("spc_v2")->table('approve_spec')->insert(array_slice($data, $i, $batchSize));
        }
        return redirect('/spc/parameter');
    }

    public function save_change()
    {
        $this->validate([
            'check_id' => 'required|numeric',
            'check_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = DB::connection("spc_v2")->table("users")->where("username", Session::get('username'))->select('password')->first();
                    if ((Hash::check($this->check_password, $password->password) == false)) {
                        $fail("This password invalid");
                    }
                }
            ]
        ]);
        DB::connection('spc_v2')->table('approve_spec')->insert([
            'dep_name' => Session::get('department'),
            'process_name' => $this->process,
            'line_name' => $this->line,
            'machine_name' => $this->machine,
            'partname' => $this->partname,
            'param_name' => $this->variable,
            'chart_type' => $this->chart,
            'ts_value' => $this->ts,
            'us_value' => $this->us,
            'ls_value' => $this->ls,
            'tc_value' => $this->tc,
            'uc_value' => $this->uc,
            'lc_value' => $this->lc,
            'param_unit_name' => $this->unit,
            'tcp_value' => $this->tcp,
            'tcpk_value' => $this->tcpk,
            'tsd_value' => $this->tsd,
            'own_account_id' => Session::get('employee_id'),
            'regis_user_id' => $this->check_id,
            'status' => 0,
            'request_time' => Carbon::now(),
            'spec_id' => $this->spec_id,
            'action' => 0,
            'group' => 0,
        ]);
        return redirect('/spc/parameter');
    }
    public function change_r($row)
    {
        $this->rows = $row;
        Session::put('rows', $row);
        return redirect('/spc/parameter');
    }
    public function add_parameter()
    {
        $this->process = "";
        $this->line = "";
        $this->machine = "";
        $this->partname = "";
        $this->variable = "";
        $this->chart = "";
        $this->ts = "";
        $this->us = "";
        $this->ls = "";
        $this->tc = "";
        $this->uc = "";
        $this->lc = "";
        $this->unit = "";
        $this->tcp = "";
        $this->tcpk = "";
        $this->tsd = "";
    }
    public function modal($id)
    {
        $this->spec_id = $id;
        $spec = DB::connection('spc_v2')->table('spc_spec_v2')->where('id', $id)->first();
        $this->process = $spec->process_name;
        $this->line = $spec->line_name;
        $this->machine = $spec->machine_name;
        $this->partname = $spec->partname;
        $this->variable = $spec->param_name;
        $this->chart = $spec->chart_type;
        $this->ts = $spec->ts_value;
        $this->us = $spec->us_value;
        $this->ls = $spec->ls_value;
        $this->tc = $spec->tc_value;
        $this->uc = $spec->uc_value;
        $this->lc = $spec->lc_value;
        $this->unit = $spec->param_unit_name;
        $this->tcp = $spec->tcp_value;
        $this->tcpk = $spec->tcpk_value;
        $this->tsd = $spec->tsd_value;
    }
    public function repage()
    {
        return redirect('/spc/parameter');
    }
    public function render()
    {
        set_time_limit(0);
        $this->rows = Session::get('rows');
        $parameter = DB::connection('spc_v2')->table('spc_spec_v2')
            ->where('dep_name', Session::get('department'))
            ->where(function (Builder $query) {
                $query->orwhere('id', 'like', '%' . $this->search_text . '%');
                $query->orwhere('process_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('line_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('machine_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('param_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('partname', 'like', '%' . $this->search_text . '%');
                $query->orwhere('chart_type', 'like', '%' . $this->search_text . '%');
                $query->orwhere('ts_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('us_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('ls_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('uc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('lc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('param_unit_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tcp_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tcpk_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tsd_value', 'like', '%' . $this->search_text . '%');
            })
            ->orderBy('created_date', 'desc')->limit(1)->paginate(Session::get('rows'));
        $this->param = DB::connection('spc_v2')->table('spc_spec_v2')
            ->where('dep_name', Session::get('department'))
            ->where(function (Builder $query) {
                $query->orwhere('id', 'like', '%' . $this->search_text . '%');
                $query->orwhere('process_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('line_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('machine_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('param_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('partname', 'like', '%' . $this->search_text . '%');
                $query->orwhere('chart_type', 'like', '%' . $this->search_text . '%');
                $query->orwhere('ts_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('us_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('ls_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('uc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('lc_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('param_unit_name', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tcp_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tcpk_value', 'like', '%' . $this->search_text . '%');
                $query->orwhere('tsd_value', 'like', '%' . $this->search_text . '%');
            })
            ->orderBy('created_date', 'desc')->limit(100)->get();
        return view('livewire.parameter', compact('parameter'));
    }
}

