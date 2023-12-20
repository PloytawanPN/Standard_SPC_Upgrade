<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Session;

class SpecExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::connection('spc_v2')->table('spc_spec_v2')->select('dep_name','process_name','line_name','machine_name','partname','param_name','chart_type','ts_value','us_value','ls_value','tc_value','uc_value','lc_value','param_unit_name','tcp_value','tcpk_value','tsd_value')
        ->where('dep_name',Session::get('department'))
        ->get();
    }
    public function headings(): array
    {
        return ['dep_name','process_name','line_name','machine_name','partname','param_name','chart_type','ts_value','us_value','ls_value','tc_value','uc_value','lc_value','param_unit_name','tcp_value','tcpk_value','tsd_value'];
    }
}
