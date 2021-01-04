@extends('admin.admin')
@section('content')
<div class="row mb-5">
    <h3>Tambah Paket Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertPaket') }}" method="post">
           {{ csrf_field() }}
            <input type="text" class="form-control" placeholder="Nama Paket" name="nama_paket">
            <input type="text" class="form-control" placeholder="Harga Paket" name="harga_paket">
            <input type="text" class="form-control mt-3" placeholder="Id Vendor" name="id_vendor">
            <input type="text" class="form-control mt-3" placeholder="Gambar Paket" name="gambar_paket">
            <br>
            <button type="submit" class="btn btn-success">Input Paket</button>
        </form>
    </div>
</div>
@endsection
