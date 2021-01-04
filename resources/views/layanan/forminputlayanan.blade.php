@extends('vendor.vendor')
@section('content')
<div class="row mb-5">
    <h3>Tambah Layanan Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertLayanan') }}" method="post">
           {{ csrf_field() }}
            <input type="text" class="form-control" placeholder="Nama Layanan" name="nama_layanan">
            <input type="text" class="form-control mt-3" placeholder="Details Layanan" name="detail_layanan">
            <input type="text" class="form-control mt-3" placeholder="Harga" name="harga_layanan">
            <input type="text" class="form-control mt-3" placeholder="Id Vendor" name="id_vendor">
            <input type="text" class="form-control mt-3" placeholder="Id Paket" name="id_paket">
            <input type="text" class="form-control mt-3" placeholder="Gambar Layanan" name="gambar_layanan">
            <br>
            <button type="submit" class="btn btn-success">Input layanan</button>
        </form>
    </div>
</div>
@endsection
