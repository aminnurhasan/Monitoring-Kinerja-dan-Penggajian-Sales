@extends('layouts.owner.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Master Gaji</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Master Gaji</a></li>
                    <li class="breadcrumb-item"></li>
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

                {{-- <a href="{{ route('user.create') }}" class="btn btn-md btn-primary mb-2">Tambah Data Admin</a> --}}
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Master Gaji
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">Gaji Pokok</th>
                                    <th class="col-2">Insentif Kunjungan</th>
                                    <th class="col-2">Bonus Penjualan</th>
                                    <th class="col-2">Denda</th>
                                    <th class="col-1">Aksi</th>
                                </tr>
                            </thead>
                                @foreach ($master as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>Rp. {{ number_format($item->gapok) }}/Bulan</td>
                                        <td>Rp. {{ number_format($item->insentifKunjungan) }}/Kunjungan</td>
                                        <td>{{ $item->bonusPenjualan*100 }}%</td>
                                        <td>Rp. {{ number_format($item->denda) }}/Kunjungan</td>
                                        <td>
                                            <a href='{{ url('master/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm fas fa-pen"></a>
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