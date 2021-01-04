@extends('vendor.vendor')
@section('content')
@if(session('afterAksi'))
    @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endif
<div class="row mb-5">
    <div class="col-md-6">
        <a href="{{route('inputLayanan')}}">
            <button class="btn btn-success">Tambah</button>
        </a>
        
    </div>
</div>
<table class="table" id="table-layanan">
    <thead>
        <tr>
            <!-- <td>No</td> -->
            <td>Nama Layanan</td>
            <td>Jenis Layanan</td>
            <td>Harga Layanan</td>
            <td>Id Vendor</td>
            <td>Id Paket</td>
            <td>Gambar Layanan</td>
            <td>aksi</td>
        </tr>
        @foreach($datas as $data)
        <tr>
            <td>{{ $data->nama_layanan }}</td>
            <td>{{ $data->jenis_layanan }}</td>
            <td>{{ $data->harga_layanan }}</td>
            <td>{{ $data->id_vendor }}</td>
            <td>{{ $data->id_paket }}</td>
            <td>{{ $data->gambar_layanan }}</td>
            <td>
                <a href="{{ route('formEditLayanan', $data->id_layanan) }}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <a href="{{ route('deleteLayanan', $data->id_layanan) }}">
                    <button class="btn btn-danger" onclick="return konfirmasi()">Delete</button>
                </a>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
{{ $datas->links() }}
@endsection
