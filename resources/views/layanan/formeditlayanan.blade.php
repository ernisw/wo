@extends('vendor.vendor')
@section('content')
<div class="row mb-5">
    <h3>Edit Layanan</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updateLayanan', $data->id_layanan) }}" method="post">
           {{ csrf_field() }}
            <input type="text" value="{{ $data->nama_layanan }}" class="form-control" placeholder="Nama Layanan" name="nama_layanan">
            <input type="text" value="{{ $data->jenis_layanan }}"  class="form-control mt-3" placeholder="Jenis Layanan" name="jenis_layanan">
            <input type="text" value="{{ $data->harga_layanan }}"  class="form-control mt-3" placeholder="Harga" name="harga_layanan">
            <input type="text" value="{{ $data->id_vendor }}" class="form-control mt-3" placeholder="Id Vendor" name="id_vendor">
            <input type="text" value="{{ $data->id_paket }}" class="form-control mt-3" placeholder="Id Paket" name="id_paket">
            <input type="text"  value="{{ $data->gambar_layanan }}" class="form-control mt-3" placeholder="Gambar Layanan" name="gambar_layanan">
            <br>
            <button type="submit" class="btn btn-success">Input layanan</button>
        </form>
    </div>
</div>
@endsection
