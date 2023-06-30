@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Gaji Sales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('gaji.index') }}">Gaji</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <a href="{{ url()->previous() }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Detail Data Gaji Sales
                        </h3>
                    </div>

                    <div class="card-body">
                        <table class="table" id="datatable">
                            <tbody>
                                <tr>
                                    <th>ID Gaji</th>
                                    <td>{{ $gaji->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Sales</th>
                                    <td>{{ $gaji->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <td>Rp. {{ number_format($gaji->gajiPokok) }}</td>
                                </tr>
                                <tr>
                                    <th>Insentif Kunjungan</th>
                                    <td>Rp. {{ number_format($gaji->intensifKunjungan) }}</td>
                                </tr>
                                <tr>
                                    <th>Bonus Penjualan</th>
                                    <td>Rp. {{ number_format($gaji->bonusPenjualan) }}</td>
                                </tr>
                                <tr>
                                    <th>Denda</th>
                                    <td>Rp. {{ number_format($gaji->denda) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Gaji</th>
                                    <td>Rp. {{ number_format($gaji->gajiTotal) }}</td>
                                </tr>
                                <tr>
                                    <th>Bulan</th>
                                    @if($gaji->bulan == 1)
                                        <td>Januari</td>
                                    @elseif($gaji->bulan == 2)
                                        <td>Februari</td>
                                    @elseif($gaji->bulan == 3)
                                        <td>Maret</td>
                                    @elseif($gaji->bulan == 4)
                                        <td>April</td>
                                    @elseif($gaji->bulan == 5)
                                        <td>Mei</td>
                                    @elseif($gaji->bulan == 6)
                                        <td>Juni</td>
                                    @elseif($gaji->bulan == 7)
                                        <td>Juli</td>
                                    @elseif($gaji->bulan == 8)
                                        <td>Agustus</td>
                                    @elseif($gaji->bulan == 9)
                                        <td>September</td>
                                    @elseif($gaji->bulan == 10)
                                        <td>Oktober</td>
                                    @elseif($gaji->bulan == 11)
                                        <td>November</td>
                                    @else
                                        <td>Desember</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $gaji->tahun }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

