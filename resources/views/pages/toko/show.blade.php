@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Toko</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
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
                            Detail Data Toko
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <tbody>
                                <tr>
                                    <th>ID Toko</th>
                                    <td>{{ $toko->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Toko</th>
                                    <td>{{ $toko->title }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Sales</th>
                                    <td>{{ $toko->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $toko->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Latitude</th>
                                    <td>{{ $toko->latitude }}</td>
                                </tr>
                                <tr>
                                    <th>Longitude</th>
                                    <td>{{ $toko->longitude }}</td>
                                </tr>
                                <tr>
                                    <th>Snippet</th>
                                    <td>{{ $toko->snippet }}</td>
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

