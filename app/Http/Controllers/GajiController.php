<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Transaksi;

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
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        $gaji = Gaji::with('user', 'transaksi');
        // $namaSales = $request->toko->user->name;
        if($katakunci){
            $gaji = $gaji->where('title', 'like', "%$katakunci%")
            // ->orWhere("$namaSales", 'like', "%$katakunci%")
            ->orWhere('alamat', 'like', "%$katakunci%")
            ->orWhere('snippet', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else{
            $gaji = Gaji::orderBy('id', 'asc')->paginate($jumlahbaris);
        }
        return view('pages.gaji.index', compact("gaji"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $user = User::all();
        return view('pages.gaji.create', compact('user'))->with('bulan', $bulan);
    }

    public function perhitunganGaji()
    {
        $totalPenjualan = DB::table('transaksi')
            ->select('salesName', DB::raw('SUM(quantity) as totalQuantity'), DB::raw('SUM(totalPrice) as totalPenjualan'))
            ->where('salesName', $namaSales)
            ->whereBetween('waktu', [$tglAwal, $tglAkhir])
            ->groupBy('salesName')
            ->get();
    }

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
