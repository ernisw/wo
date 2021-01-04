@extends('vendor.vendor')
@section('content')
<div class="row mb-5">
    <h3>Tambah Layanan Baru</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('insertLayananVendor') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
            <!-- <input type="text" class="form-control" placeholder="Nama Layanan" name="nama_layanan"> -->
            <select name="nama_layanan" class="form-control">
            <option value="Dekorasi">Dekorasi</option>
                <option value="Hiburan">Hiburan</option>
                <option value="Make Up">Make Up</option>
                <option value="Dokumentasi">Dokumentasi</option>
                <option value="Venue">Venue</option>
                <option value="Catering">Catering</option>
            </select>
            <input type="text" class="form-control mt-3" placeholder="Detail Layanan" name="detail_layanan">
            <input type="text" class="form-control mt-3" placeholder="Harga Layanan" name="harga_layanan">
            <input type="file" class="form-control mt-3" placeholder="Gambar Layanan" name="gambar_layanan">
            <br>
            <button type="submit" class="btn btn-success">Input layanan</button>
        </form>
    </div>
</div>
@endsection
