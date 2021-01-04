@extends('wo_admin.wo_admin')
@section('content')
<div class="row mb-5">
    <h3>Edit Paket</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('prosesUpdatePaketVendor', $data->id_paket) }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
            <input type="text" value="{{ $data->nama_paket }}" class="form-control mt-3" placeholder="Nama Paket" name="nama_paket">
            <input type="text" value="{{ $data->harga_paket }}" class="form-control mt-3" placeholder="Harga Paket" name="harga_paket">
            <input type="file" value="{{ $data->gambar_paket }}" class="form-control mt-3" placeholder="Gambar Paket" name="gambar_paket">
            <br>
            <button type="submit" class="btn btn-success">Input Paket</button>
        </form>
    </div>
</div>
@endsection
