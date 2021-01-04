@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Edit WO</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updatewo', $data->id) }}" method="post">
           {{ csrf_field() }}
            <input type="text" value="{{ $data->username }}" class="form-control" placeholder="Username" name="username">
            <input type="text" value="{{ $data->name }}" class="form-control" placeholder="Nama Lengkap" name="name">
            <input type="text" value="{{ $data->password }}" class="form-control mt-3" placeholder="Password" name="password">
            <input type="text"  value="{{ $data->email }}" class="form-control mt-3" placeholder="Email" name="email">
            <input type="text"  value="{{ $data->no_telp }}" class="form-control mt-3" placeholder="Nomor Telpon" name="no_telp">
            <input type="text"  value="{{ $data->alamat }}" class="form-control mt-3" placeholder="Alamat" name="alamat">
            <input type="file"  value="{{ $data->gambar }}" class="form-control mt-3" placeholder="Gambar Wo" name="gambar">
            <input type="file"  value="{{ $data->foto }}" class="form-control mt-3" placeholder="Gambar Wo" name="foto">
            <br>
            <button type="submit" class="btn btn-success">Input WO</button>
        </form>
    </div>
</div>
@endsection
