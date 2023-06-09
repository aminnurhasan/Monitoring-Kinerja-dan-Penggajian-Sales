@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <a href="{{ url()->previous() }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Detail Data Transaksi
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <tbody>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <td>{{ $transaksi->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Toko</th>
                                    <td>{{ $transaksi->transaksi->tokoName }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <td>{{ $transaksi->transaksi->salesName }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $transaksi->transaksi->quantity }} Packs</td>
                                </tr>
                                <tr>
                                    <th>Total Penjualan</th>
                                    <td>Rp. {{ number_format($transaksi->transaksi->totalPrice) }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $transaksi->transaksi->waktu }}</td>
                                </tr>
                                <tr>
                                    <th>Foto Presensi</th>
                                    <td><img width="350" src="{{ asset('/storage/transaksi/' . $transaksi->fotosales) }}" alt=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection

