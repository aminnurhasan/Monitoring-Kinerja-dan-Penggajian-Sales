<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Transaksi;
use DB;
use Illuminate\Support\Carbon;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $gaji = Gaji::all();
        return view('pages.gaji.index', compact("gaji"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::all();
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');
        $gajiPokok = $request->input('gajiPokok');
        $bonusKunjungan = $request->input('bonusKunjungan');

        $idSales = $request->input('user_id');

        $namaSales = DB::table('user')
            ->join('transaksi', 'user.id', '=', 'transaksi.user_id')
            ->select('user.name as nama')
            ->where('user.id', '=', $idSales)
            ->get();

        // Query Total Quantity dan Total Penjualan Sales
        $totalPenjualan = DB::table('transaksi')
            ->select('salesName as nama', DB::raw('SUM(quantity) as totalQuantity'), DB::raw('SUM(totalPrice) as totalPenjualan'))
            ->where('user_id', '=', $idSales)
            ->whereBetween('waktu', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('salesName')
            ->get();
        
        // Query Total Kunjungan Sales
        $totalKunjungan = DB::table('transaksi')
            ->select(DB::raw('COUNT(*) as kunjungan'))
            ->where('user_id', '=', $idSales)
            ->get();

        $nama = "";
        foreach ($namaSales as $namaSales){
            $nama = $namaSales->nama;
        }

        // Perhitungan Total Insentif Kunjungan Sales
        $insentifKunjungan = 0;
        foreach ($totalKunjungan as $kunjungan){
            $insentifKunjungan += $kunjungan->kunjungan;
        }
        
        $totalInsentifKunjungan = $insentifKunjungan * $bonusKunjungan;

        // Perhitungan Bonus Penjualan Sales
        $penjualanSales = 0;
        $quantitySales = 0;
        foreach ($totalPenjualan as $penjualan){
            $penjualanSales += $penjualan->totalPenjualan;
            $quantitySales += $penjualan->totalQuantity;
        }

        $bonusPenjualan = 0.05 * $penjualanSales;

        // Perhitungan Total Gaji Sales
        $totalGaji = $gajiPokok + $totalInsentifKunjungan + $bonusPenjualan;

        return view('pages.gaji.create', compact('user', 'nama', 'penjualanSales', 'gajiPokok', 'tanggalAwal', 'tanggalAkhir', 'quantitySales', 'totalKunjungan', 'totalInsentifKunjungan', 'bonusPenjualan', 'totalGaji'));
    }

    // public function perhitungan(Request $request)
    // {
    //     $idSales = $request->user_id;
    //     $namaSales = DB::table('user')
    //         ->join('transaksi', 'user.id', '=', 'transaksi.user_id')
    //         ->select('user.name as nama')
    //         ->where('user.id', '=', $idSales)
    //         ->get();
        
    //     $data = $namaSales->pluck('nama')->map(function ($item){
    //         $modifiedItem = str_replace('nama', '', $item);
            
    //         return $modifiedItem;
    //     });

    //     $totalPenjualan = DB::table('transaksi')
    //         ->select('salesName as nama', DB::raw('SUM(quantity) as totalQuantity'), DB::raw('SUM(totalPrice) as totalPenjualan'))
    //         ->where('user_id', '=', $idSales)
    //         ->whereBetween('waktu', ['2023-05-01', '2023-05-30'])
    //         ->groupBy('salesName')
    //         ->get();
        
    //     return view('pages.gaji.create', compact('totalPenjualan'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
