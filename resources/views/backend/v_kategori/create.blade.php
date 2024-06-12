@extends('backend.v_layouts.app')
@section('content')
<!-- template -->


<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <form action="/kategori" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="" value="{{ old('nama_kategori') }}" class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror" placeholder="Masukkan kategori">
                    @error('nama_kategori')
                    <span class="invalid-feedback alert-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <br>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                <a href="{{ route('kategori.index') }}">
                    <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
                </a>

            </form>
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content -->
</div>
<!-- end template-->
@endsection