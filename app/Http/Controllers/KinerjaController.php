<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use DB;

class KinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        
        $salesId = $request->input('user_id');

        // Sales
        $sales = DB::select(DB::raw('
            SELECT id, name, email, is_admin
            FROM user
            WHERE is_admin = 0
        '));

        // Total Penjualan 
        $totalPenjualan = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy('waktu', 'desc')
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->take(12)
            ->pluck('totalQuantity', 'bulan')
            ->reverse();

        $labelsPen = $totalPenjualan->keys();
        $dataPen = $totalPenjualan->values();

        // Top Sales
        $topSales = DB::select(DB::raw('
            SELECT user.name AS nama, SUM(transaksi.quantity) AS quantity, SUM(transaksi.totalPrice) as total
            FROM user
            JOIN transaksi ON user.id = transaksi.user_id
            WHERE DATE_FORMAT(waktu, "%Y-%m") = DATE_FORMAT(CURDATE(), "%Y-%m")
            GROUP BY user.name
            ORDER BY quantity DESC
            LIMIT 5
        '));

        // Quantity Penjualan Per Sales
        $penjualanPerSales = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(totalPrice) AS totalPenjualan"))
            ->where('user_id', $salesId)
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy('waktu', 'desc')
            ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->take(12)
            ->pluck('totalPenjualan', 'bulan')
            ->reverse();

        $labelsPenSales = $penjualanPerSales->keys();
        $dataPenSales = $penjualanPerSales->values();

        // Kunjungan Sales
        $kunjunganPerSales = DB::table('transaksi')
            ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, count(*) AS kunjungan"))
            ->where('user_id', $salesId)
            ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
            ->orderBy('waktu', 'desc')
            ->take(12)
            ->pluck('kunjungan', 'bulan')
            ->reverse();

        $labelsKunjungan = $kunjunganPerSales->keys();
        $dataKunjungan = $kunjunganPerSales->values();

        return view('pages.kinerja.index', compact('sales', 'topSales', 'labelsPen', 'dataPen', 'labelsPenSales', 'dataPenSales', 'labelsKunjungan', 'dataKunjungan'));
    }

    // public function chart(Request $request)
    // {
    //     $this->idSales = $request->input('user_id');

    //     $salesId = $this->idSales;

    //     // Quantity Penjualan Per Sales
    //     $penjualanPerSales = DB::table('transaksi')
    //         ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, SUM(quantity) AS totalQuantity"))
    //         ->where('user_id', $salesId)
    //         ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
    //         ->orderBy('waktu', 'desc')
    //         ->orderBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
    //         ->take(12)
    //         ->pluck('totalQuantity', 'bulan')
    //         ->reverse();

    //     $labelsPenSales = $penjualanPerSales->keys();
    //     $dataPenSales = $penjualanPerSales->values();

    //     // Kunjungan Sales
    //     $kunjunganPerSales = DB::table('transaksi')
    //         ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m') AS bulan, count(*) AS kunjungan"))
    //         ->where('user_id', $salesId)
    //         ->groupBy(DB::raw("DATE_FORMAT(waktu, '%Y-%m')"))
    //         ->orderBy('waktu', 'desc')
    //         ->take(12)
    //         ->pluck('kunjungan', 'bulan')
    //         ->reverse();

    //     $labelsKunjungan = $kunjunganPerSales->keys();
    //     $dataKunjungan = $kunjunganPerSales->values();

    //     return redirect()->route('kinerja.index');
    // }

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
