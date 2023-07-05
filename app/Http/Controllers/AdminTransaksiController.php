<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Foto;
use DB;
use PDF;

class AdminTransaksiController extends Controller
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
        $transaksi = Transaksi::all();
        return view('pages.admin.transaksi.index', compact("transaksi"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.transaksi.cetak');
    }

    public function cetakPDF(Request $request)
    {
        $inputBulan = $request->input('bulan');
        $inputTahun = $request->input('tahun');

        $transaksi = DB::select(DB::raw('
            SELECT transaksi.id AS id, user.name AS nama, transaksi.tokoName AS toko, transaksi.quantity AS quantity, transaksi.totalPrice AS total, transaksi.waktu AS waktu
            FROM transaksi
            JOIN user ON transaksi.user_id = user.id
            WHERE EXTRACT(MONTH FROM transaksi.waktu) = :inputBulan
            AND EXTRACT(YEAR FROM transaksi.waktu) = :inputTahun
            GROUP BY id, nama, toko, quantity, total, waktu
        '), ['inputBulan' => $inputBulan, 'inputTahun' => $inputTahun]);

        if ($inputBulan == 1){
            $bulan = 'Laporan Transaksi Sales Bulan Januari';
        } else if($inputBulan == 2){
            $bulan = 'Laporan Transaksi Sales Bulan Februari';
        } else if($inputBulan == 3){
            $bulan = 'Laporan Transaksi Sales Bulan Maret';
        } else if($inputBulan == 4){
            $bulan = 'Laporan Transaksi Sales Bulan April';
        } else if($inputBulan == 5){
            $bulan = 'Laporan Transaksi Sales Bulan Mei';
        } else if($inputBulan == 6){
            $bulan = 'Laporan Transaksi Sales Bulan Juni';
        } else if($inputBulan == 7){
            $bulan = 'Laporan Transaksi Sales Bulan Juli';
        } else if($inputBulan == 8){
            $bulan = 'Laporan Transaksi Sales Bulan Agustus';
        } else if($inputBulan == 9){
            $bulan = 'Laporan Transaksi Sales Bulan September';
        } else if($inputBulan == 10){
            $bulan = 'Laporan Transaksi Sales Bulan Oktober';
        } else if($inputBulan == 11){
            $bulan = 'Laporan Transaksi Sales Bulan November';
        } else{
            $bulan = 'Laporan Transaksi Sales Bulan Desember';
        }

        $data = [
            'title' => $bulan,
            'items' => $transaksi,
        ];

        $pdf = PDF::loadView('pages.admin.transaksi.template', $data);

        return $pdf->stream('Rekap Transaksi.pdf');
        return redirect()->route('/admin/transaksi');
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
    public function show($transaksi_id)
    {
        $transaksi = Foto::findOrFail($transaksi_id);
        return view('pages.admin.transaksi.show', compact('transaksi'));
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
        $transaksi = Transaksi::find($id);        

        $transaksi->delete();

        return redirect()->route('transaksi.index');
    }
}
