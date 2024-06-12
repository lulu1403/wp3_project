@extends('backend.v_layouts.app')
@section('content')
<!-- template -->


<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <form action="/user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    {{-- div left --}}
                    <div class="form-group">
                        <label>Foto</label>
                        <img class="foto-preview">
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewFoto()">
                        @error('foto')
                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    {{-- div right --}}

                    <div class="form-group">
                        <label>Hak Ases</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="" {{ old('role') == '' ? 'selected' : '' }}> - Pilih Hak Akses
                                -
                            </option>
                            <option value="1" {{ old('role') == '1' ? 'selected' : '' }}> Super Admin</option>
                            <option value="0" {{ old('role') == '0' ? 'selected' : '' }}> Admin
                            </option>
                            <option value="2" {{ old('role') == '2' ? 'selected' : '' }}> Anggota
                            </option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                        @error('nama')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                        @error('email')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>HP</label>
                        <input type="text" onkeypress="return hanyaAngka(event)" name="hp" value="{{ old('hp') }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP">
                        @error('hp')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                        @error('password')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    </div>

                </div>

                <br>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                <a href="{{ route('user.index') }}">
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