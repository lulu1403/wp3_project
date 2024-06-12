@extends('backend.v_layouts.app')
@section('content')
<!-- template -->


<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <form action="/produk/{{ $edit->id }}" method="post">
                @method('put')
                @csrf
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Foto</label>
                        {{-- view image --}}
                        @if ($edit->foto)
                        <img src="{{ asset('storage/img-produk/' . $edit->foto) }}" class="foto-preview" width="100%">
                        <p></p>
                        @else
                        <img src="{{ asset('storage/img-produk/img-default.jpg') }}" class="foto-preview" width="100%">
                        <p></p>
                        @endif
                        {{-- file foto --}}
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                        @error('foto')
                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>ID Kategori</label>
                        <select class="form-control @error('ketegori_id') is-invalid @enderror" name="kategori_id" id="kategori">
                            <option value="{{ old('kategori_id',$edit->kategori_id) }}" selected>-- Pilih ID Kategori --</option>
                            @foreach ($kategori as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="{{ old('nama',$edit->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                        @error('nama')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" name="detail" value="{{ old('detail',$edit->detail) }}" class="form-control @error('detail') is-invalid @enderror" placeholder="Masukkan Detail">
                        @error('detail')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="double" name="harga" id="" value="{{ old('harga',$edit->harga) }}" class="form-control form-control-lg @error('harga') is-invalid @enderror" placeholder="Masukkan Harga">
                        @error('harga')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Perbaharui</button>
                <a href="{{ route('produk.index') }}">
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