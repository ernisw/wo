@extends('vendor.vendor')
@section('content')
<div class="row mb-5">
    <h3>Edit Paket</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updateTransaksi', $data->id_transaksi) }}" method="post">
           {{ csrf_field() }}
            <input type="text" value="{{ $data->id_vendor }}" class="form-control" placeholder="Id Vendor" name="id_vendor">
            <input type="text" value="{{ $data->id_pengguna }}" class="form-control" placeholder="Id Pengguna" name="id_pengguna">
            <input type="text" value="{{ $data->nama_paket }}" class="form-control" placeholder="Nama Paket" name="nama_paket">
            <input type="text" value="{{ $data->nama_vendor }}" class="form-control mt-3" placeholder="Nama Vendor" name="nama_vendor">
            <input type="text" value="{{ $data->total }}" class="form-control mt-3" placeholder="Total Harga" name="total">
            <input type="text" value="{{ $data->set_tanggal_nikah }}" class="form-control mt-3" placeholder="Set Tanggal Nikah Harga" name="set_tanggal_nikah">
            <input type="text"  value="{{ $data->gambar_vendor }}" class="form-control mt-3" placeholder="Gambar Vendor" name="gambar_vendor">
            <br>
            <button type="submit" class="btn btn-success">Input Transaksi</button>
        </form>
    </div>
</div>
@endsection
