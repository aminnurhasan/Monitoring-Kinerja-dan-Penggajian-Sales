@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Master Gaji</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('master.index') }}">Master Gaji</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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

                <a href="{{ url()->previous() }}" class="btn btn-md btn-primary mb-2">Kembali</a>

                <div class="card">  
                    <div class="card-body">

                        <form action="{{ route('master.update', $master->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="">Gaji Pokok</label>
                                <div class="row">
                                    <input type="text" name="" value="Rp." class="form-control col-sm-1 mr-1" disabled>
                                    <input type="number" name="gapok" class="form-control col-sm-10" value="{{ old('gapok', $master->gapok) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Insentif Kunjungan</label>
                                <div class="row">
                                    <input type="text" name="" value="Rp." class="form-control col-sm-1 mr-1" disabled>
                                    <input type="number" name="insentifKunjungan" class="form-control col-sm-10" value="{{ old('insentifKunjungan', $master->insentifKunjungan) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Bonus Penjualan</label>
                                <div class="row">
                                    <input type="number" name="bonusPenjualan" class="form-control col-sm-10" value="{{ old('bonusPenjualan', $master->bonusPenjualan*100) }}">
                                    <input type="text" name="" value="%" class="form-control col-sm-1 ml-1" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Denda</label>
                                <div class="row">
                                    <input type="text" name="" value="Rp." class="form-control col-sm-1 mr-1" disabled>
                                    <input type="number" name="denda" class="form-control col-sm-10" value="{{ old('denda', $master->denda) }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

