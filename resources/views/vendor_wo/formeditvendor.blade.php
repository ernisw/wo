@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Edit Vendor</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updateVendor', $data->id) }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
            <br>
            <input value="{{ $data->username }}" type="text" class="form-control" placeholder="Username" name="username">
            <input value="{{ $data->name }}" type="text" class="form-control" placeholder="Nama Vendor" name="name">
            <input value="{{ $data->email }}" type="text" class="form-control" placeholder="E-Mail" name="email">
            <input value="{{ $data->alamat }}" type="text" class="form-control mt-3" placeholder="Alamat" name="alamat">
            <input value="{{ $data->no_telp }}" type="text" class="form-control mt-3" placeholder="No Telp" name="no_telp">
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
