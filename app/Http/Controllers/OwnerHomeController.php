<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Toko;
use App\Models\Transaksi;
use Charts;
use DB;

class OwnerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
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

        // Jumlah Admin
        $admin = DB::table('user')
            ->where('role', 1)
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

        return view('pages.owner.home', compact ('sales', 'admin', 'toko', 'penjualan', 'pendapatan', 'labels', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
