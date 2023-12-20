<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;



class SpecImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $group_number = (DB::connection('spc_v2')->table('approve_spec')->max('group'));
        $group_number += 1;

        foreach ($rows as $row) {
            DB::connection('spc_v2')->table('approve_spec')->insert([
                'dep_name' => $row['dep_name'],
                'process_name' => $row['process_name'],
                'line_name' => $row['line_name'],
                'machine_name' => $row['machine_name'],
                'partname' => $row['partname'],
                'param_name' => $row['param_name'],
                'chart_type' => $row['chart_type'],
                'ts_value' => $row['ts_value'],
                'us_value' => $row['us_value'],
                'ls_value' => $row['ls_value'],
                'tc_value' => $row['tc_value'],
                'uc_value' => $row['uc_value'],
                'lc_value' => $row['lc_value'],
                'param_unit_name' => $row['param_unit_name'],
                'tcp_value' => $row['tcp_value'],
                'tcpk_value' => $row['tcpk_value'],
                'tsd_value' => $row['tsd_value'],
                'own_account_id' => Session::get('employee_id'),
                'regis_user_id' => Session::get('regis_id'),
                'status' => 0,
                'request_time' => Carbon::now(),
                'spec_id' => 0,
                'action' => Session::get('action'),
                'group' => $group_number
            ]);
        }
    }
}

