@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Toko</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('toko.index') }}">Toko</a></li>
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

                        <form action="{{ route('toko.update', $toko->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="">ID Toko</label>
                                <input type="number" name="id" class="form-control" disabled value="{{ old('id', $toko->id) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Toko</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $toko->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Sales</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $toko->alamat) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Latitude</label>
                                <input type="text" name="latitude" class="form-control" value="{{ old('alamat', $toko->latitude) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Longitude</label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('alamat', $toko->longitude) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Snippet</label>
                                <input type="text" name="snippet" class="form-control" value="{{ old('alamat', $toko->snippet) }}">
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

