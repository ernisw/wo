@extends('vendor.vendor')
@section('content')
<div class="row mb-5">
    <h3>Edit Layanan</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <form action="{{ route('updateLayananVendor', $data->id_layanan) }}" method="post">
           {{ csrf_field() }}
            <!-- <input type="text" value="{{ $data->nama_layanan }}" class="form-control" placeholder="Nama Layanan" name="nama_layanan"> -->
            <select name="nama_layanan" class="form-control">
            <option value="Dekorasi">Dekorasi</option>
                <option value="Hiburan">Hiburan</option>
                <option value="Make Up">Make Up</option>
                <option value="Dokumentasi">Dokumentasi</option>
                <option value="Venue">Venue</option>
                <option value="Catering">Catering</option>
            </select>
            <input type="text" value="{{ $data->detail_layanan }}"  class="form-control mt-3" placeholder="Detail Layanan" name="detail_layanan">
            <input type="text" value="{{ $data->harga_layanan }}"  class="form-control mt-3" placeholder="Harga Layanan" name="harga_layanan">
            <input type="file"  value="{{ $data->gambar_layanan }}" class="form-control mt-3" placeholder="Gambar Layanan" name="gambar_layanan">
            <br>
            <button type="submit" class="btn btn-success">Edit layanan</button>
        </form>
    </div>
    <div class="col-md-6 col-xs-12">
      
        <!-- <img width="200" src="{{url('img/fotoUser')}}/{{$data->gambar_layanan}}" alt=""> -->
    </div>
</div>
@endsection
