@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active"></li>
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

                <a href="{{ route('transaksi.create') }}" class="btn btn-md btn-success mb-2">Cetak PDF</a>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Data Transaksi
                        </h3>
                    </div>

                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Nama Toko</th>
                                    <th class="col-2">Nama Karyawan</th>
                                    <th class="col-2">Quantity</th>
                                    <th class="col-2">Total Price</th>
                                    <th class="col-2">Tanggal</th>
                                    <th class="col-1">Action</th>
                                </tr>
                            </thead>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tokoName }}</td>
                                        <td>{{ $item->salesName }}</td>
                                        <td>{{ $item->quantity }} Packs</td>
                                        <td>Rp. {{ number_format($item->totalPrice) }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>
                                            <a href='{{ route('transaksi.show', $item->id) }}' class="btn btn-warning btn-sm fas fa-eye"></a>
                                            <form onsubmit="return confirm('Apakah Anda Ingin Menghapus Data ?')" class="d-inline"
                                                action="{{ url('transaksi/' . $item->id) }}" method="post">
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
