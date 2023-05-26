<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $reportData = report::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $departmenData =  DB::table('reports')
                    ->join('departments', 'reports.department_id', '=', 'departments.id')
                    ->groupBy(\DB::raw("name"))
                    ->select('name',\DB::raw("COUNT(*) as count"))
                    ->get();
        $statusData =  DB::table('reports')
                    ->groupBy(\DB::raw("status"))
                    ->select(\DB::raw("COUNT(*) as count"))
                    ->pluck('count');
        $statusDataLabel =  DB::table('reports')
                    ->groupBy(\DB::raw("status"))
                    ->select("status")
                    ->pluck('status');
        $data['general'] = report::count();
        $data['ESR']=report::where('stage','ESR')->count();
        $data['CDI']=report::where('stage','CDI')->count();
        $data['IRR']=report::where('stage','IRR')->count();
        $data['CODING']=report::where('stage','CODING')->count();
        return view('dashboard',compact( 'reportData','data','departmenData','statusData','statusDataLabel'));
    }
}
