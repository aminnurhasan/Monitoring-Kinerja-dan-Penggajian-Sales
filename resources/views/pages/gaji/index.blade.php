@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gaji Sales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Gaji</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <a href="{{ route('gaji.create') }}" class="btn btn-nd btn-primary mb-2">Tambah Data Gaji</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Gaji Sales
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Nama Sales</th>
                                    <th class="col-1">Bulan</th>
                                    <th class="col-1">Tahun</th>
                                    <th class="col-2">Gaji Pokok</th>
                                    <th class="col-1">Insentif Kunjungan</th>
                                    <th class="col-1">Bonus Penjualan</th>
                                    <th class="col-2">Total Gaji</th>
                                    <th class="col-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gaji as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                            @if($item->bulan == 1)
                                                <td>Januari</td>
                                            @elseif($item->bulan == 2)
                                                <td>Februari</td>
                                            @elseif($item->bulan == 3)
                                                <td>Maret</td>
                                            @elseif($item->bulan == 4)
                                                <td>April</td>
                                            @elseif($item->bulan == 5)
                                                <td>Mei</td>
                                            @elseif($item->bulan == 6)
                                                <td>Juni</td>
                                            @elseif($item->bulan == 7)
                                                <td>Juli</td>
                                            @elseif($item->bulan == 8)
                                                <td>Agustus</td>
                                            @elseif($item->bulan == 9)
                                                <td>September</td>
                                            @elseif($item->bulan == 10)
                                                <td>Oktober</td>
                                            @elseif($item->bulan == 11)
                                                <td>November</td>
                                            @else
                                                <td>Desember</td>
                                            @endif
                                        <td>{{ $item->tahun }}</td>
                                        <td>Rp. {{ number_format($item->gajiPokok) }}</td>
                                        <td>Rp. {{ number_format($item->intensifKunjungan) }}</td>
                                        <td>Rp. {{ number_format($item->bonusPenjualan) }}</td>
                                        <td>Rp. {{ number_format($item->gajiTotal) }}</td>
                                        <td>
                                            <a href='{{ route('gaji.show', $item->id) }}' class="btn btn-warning btn-sm fas fa-eye"></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" class="d-inline"
                                                action="{{ url('gaji/' . $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name='submit' class="btn btn-danger btn-sm fas fa-trash-can"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>            
        </div>
    </div>
</section>
@endsection