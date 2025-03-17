<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Stat;
use App\Models\Device;
use App\Models\Recent;
use App\Models\Browser;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $sAnalityc      = Recent::select(['*',DB::raw('COUNT(id) AS count')])
                        ->whereDay('created_at','>=', Carbon::now('Asia/Jakarta')->addDay(-7))->where([['website_id', '=', 1], ['referrer', '!=', null]])
                        ->groupBy(['referrer'])->orderBy('count', 'DESC')->get();

        $visitor        = Stat::select(['*',DB::raw('SUM(count) AS count')])->where([['website_id', '=', 1], ['name', '=','visitors']])
                        ->where('date','>=', Carbon::now('Asia/Jakarta')->addDay(-7)->format('Y-m-d'))->groupBy('date')->orderBy('name','ASC')->get();

        $pageviews      = Stat::select(['*',DB::raw('SUM(count) AS count')])->where([['website_id', '=', 1], ['name', '=','pageviews']])
                        ->where('date','>=', Carbon::now('Asia/Jakarta')->addDay(-7))->groupBy('date')->orderBy('name','ASC')->get();

        $tanggal        = Carbon::parse((isset($visitor->first()['date']) ? $visitor->first()['date'] : ''));

        $pageViewCount  = [];
        $visitorCount   = [];

        for ($i=1; $i <= 7 ; $i++) { 
            $date[]     = Carbon::parse($tanggal)->format('d F');
            $visitorCount[] = ($list = $visitor->where('date', Carbon::parse($tanggal)->format('Y-m-d'))->first() ? ($visitor->where('date', Carbon::parse($tanggal)->format('Y-m-d'))->first()->count - ceil($visitor->where('date', Carbon::parse($tanggal)->format('Y-m-d'))->first()->count / 2)) : 0);
            $pageViewCount[]= ($list = $pageviews->where('date', Carbon::parse($tanggal)->format('Y-m-d'))->first() ? $pageviews->where('date', Carbon::parse($tanggal)->format('Y-m-d'))->first()->count : 0);
            $tgl        = Carbon::parse($tanggal)->addDay(1);

            $tanggal    = $tgl;
        }

        $countries = Stat::selectRaw('`value`, SUM(`count`) as `count`')
        ->where([['website_id', '=', 1], ['name', '=', 'country']])
        ->groupBy('value')->orderBy('count', 'desc')->get();

        $browser    = Stat::selectRaw('`value`, SUM(`count`) as `count`')
        ->where([['website_id', '=', 1], ['name', '=', 'browser']])
        ->groupBy('value')
        ->orderBy('count', 'desc')->get();
        
        $os         = Stat::selectRaw('`value`, SUM(`count`) as `count`')
        ->where([['website_id', '=', 1], ['name', '=', 'os']])
        ->orderBy('count', 'desc')->get();
        return view('pages.admin.dashboard.index', compact('sAnalityc', 'date', 'visitorCount', 'pageViewCount', 'countries', 'browser', 'os'));
    }
}
