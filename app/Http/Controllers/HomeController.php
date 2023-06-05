<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->get();
        
        $chartData = [
            'bulan' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'totalQuantity' => []
        ];

        foreach ($data as $row){
            $chartData['totalQuantity'][] = $row->totalQuantity;
        }

        return view('home', compact ('chartData'));
    }
}
