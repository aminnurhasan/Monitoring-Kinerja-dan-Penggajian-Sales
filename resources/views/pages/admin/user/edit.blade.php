@extends('layouts.admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
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

                        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="" style="display: block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jenisKelamin" type="radio" id="inlineRadio1" value="l" {{ old('jenisKelamin', $user->jenisKelamin) == 'l' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="jenisKelamin" type="radio" id="inlineRadio2" value="p" {{ old('jenisKelamin', $user->jenisKelamin) == 'p' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input name="alamat" cols="3" class="form-control" value="{{ old('alamat', $user->alamat) }}"></input>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="text" name="tglLahir" class="form-control" value="{{ old('tglLahir', $user->tglLahir) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="">Gaji Pokok</label>
                                <input type="number" name="gajiPokok" class="form-control" value="{{ old('gajiPokok', $user->gajiPokok) }}">
                            </div>
                            <div class="mb-3 row">
                                <label for="foto" class="col-sm-1 col-form-label">Foto</label>
                                <div class="col-sm-11">
                                    <input type="file" name="foto" class="form-control">
                                    {{-- @if ($user->foto) --}}
                                        <img width="350" src="{{ asset('/storage/profile/' . $user->foto) }}" alt="">
                                        {{-- <img src="{{ asset('/storage/profile/' . $user->foto) }}" alt="" height="100"> --}}
                                    {{-- @endif --}}
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

