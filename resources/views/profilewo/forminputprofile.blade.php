@extends('wo_admin.wo_admin')
@section('content')
<div class="row mb-5">
    <h3>Tambah Profile Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertProfile') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
            <input type="text" class="form-control" placeholder="Nama Paket" name="name">
            <input type="text" class="form-control mt-3" placeholder="Harga Paket" name="alamat">
            <input type="file" class="form-control mt-3" placeholder="Gambar Paket" name="no_telp">
            <br>
            <button type="submit" class="btn btn-success">Input Profile</button>
        </form>
    </div>
</div>
@endsection
