@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Tambah Vendor Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertVendor') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
            <input type="text" class="form-control" placeholder="Username" name="username">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <input type="text" class="form-control" placeholder="Nama Vendor" name="name">
            <input type="text" class="form-control" placeholder="E-Mail" name="email">
            <input type="text" class="form-control mt-3" placeholder="Alamat" name="alamat">
            <input type="text" class="form-control mt-3" placeholder="No Telp" name="no_telp">
            Gambar Vendor
            <input type="file" class="form-control mt-3" placeholder="Gambar Vendor" name="gambar">
            Gambar KTP
            <input type="file" class="form-control mt-3" placeholder="Gambar Vendor" name="foto">
            <br>
            <button type="submit" class="btn btn-success">Input vendor</button>
        </form>
    </div>
</div>
@endsection
