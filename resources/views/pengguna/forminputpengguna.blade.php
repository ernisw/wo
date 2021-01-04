@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Tambah User Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertPengguna') }}" method="post">
           {{ csrf_field() }}
           <input type="text"  class="form-control" placeholder="Username" name="username">
            <input type="text" class="form-control mt-3" placeholder="Name" name="name">
            <input type="text" class="form-control mt-3" placeholder="Email" name="email">
            <input type="text" class="form-control mt-3" placeholder="Alamat" name="alamat">
            <input type="text" class="form-control mt-3" placeholder="No Telpon" name="no_telp">
            <input type="text" class="form-control mt-3" placeholder="Gambar Pengguna" name="gambar">
            <input type="text" class="form-control mt-3" placeholder="Gambar Pengguna" name="foto">
            <br>
            <button type="submit" class="btn btn-success">Input User</button>
        </form>
    </div>
</div>
@endsection
