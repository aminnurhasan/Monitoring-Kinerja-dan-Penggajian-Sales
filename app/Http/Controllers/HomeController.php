<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use App\Models\Transaksi;
use Charts;
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
    public function index(Request $request)
    {
        $transaksi = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->pluck('totalQuantity', 'bulan');

        $labels = $transaksi->keys();
        $data = $transaksi->values();
        
        $chartData = $request->chartData;

        $sales = DB::table('user')
            ->where('is_admin', 0)
            ->count();

        $toko = DB::table('toko')
            ->count();

        $penjualan = Transaksi::whereRaw("DATE_FORMAT(waktu, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
            ->sum('quantity');

        $pendapatan = Transaksi::whereRaw("DATE_FORMAT(waktu, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
            ->sum('totalPrice');

        return view('home', compact ('chartData', 'sales', 'toko', 'penjualan', 'pendapatan', 'labels', 'data'));
    }
}
