@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Edit User</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updatePengguna', $data->id_pengguna) }}" method="post">
           {{ csrf_field() }}
            <input type="text" value="{{ $data->username }}" class="form-control" placeholder="Username" name="username">
            <input type="text" value="{{ $data->password }}" class="form-control mt-3" placeholder="Password" name="password">
            <input type="text" value="{{ $data->nama_lengkap }}" class="form-control mt-3" placeholder="Nama Lengkap" name="nama_lengkap">
            <input type="text"  value="{{ $data->email }}" class="form-control mt-3" placeholder="Email" name="email">
            <input type="text"  value="{{ $data->no_telp }}" class="form-control mt-3" placeholder="No Telpon" name="no_telp">
            <input type="text"  value="{{ $data->gambar_pengguna }}" class="form-control mt-3" placeholder="Gambar Pengguna" name="gambar_pengguna">
            <br>
            <button type="submit" class="btn btn-success">Input User</button>
        </form>
    </div>
</div>
@endsection
