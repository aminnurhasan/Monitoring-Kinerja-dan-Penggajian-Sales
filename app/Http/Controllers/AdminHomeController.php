<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use App\Models\Transaksi;
use Charts;
use DB;

class AdminHomeController extends Controller
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
        // Query Quantity Penjualan Semua Sales Dalam 12 Bulan
        $transaksi = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy('waktu', 'desc')
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->take(12)
            ->pluck('totalQuantity', 'bulan')
            ->reverse();

        $labels = $transaksi->keys();
        $data = $transaksi->values();

        // Jumlah Sales
        $sales = DB::table('user')
            ->where('role', 0)
            ->where('status', 1)
            ->count();

        // Jumlah Toko
        $toko = DB::table('toko')
            ->count();

        // Quantity Penjualan Bulan Ini
        $penjualan = Transaksi::whereRaw("DATE_FORMAT(waktu, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
            ->sum('quantity');

        // Pendapatan Bulan Ini
        $pendapatan = Transaksi::whereRaw("DATE_FORMAT(waktu, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
            ->sum('totalPrice');

        return view('pages.admin.home', compact ('sales', 'toko', 'penjualan', 'pendapatan', 'labels', 'data'));
    }
}
