@extends('admin.admin')
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
        <a href="{{route('inputPaket')}}">
            <button class="btn btn-success">Tambah</button>
        </a>
        
    </div>
</div>
<table class="table" id="table-paket">
    <thead>
        <tr>
            <!-- <td>No</td> -->
            <td>Nama Paket</td>
            <td>Harga Paket</td>
            <td>Id Vendor</td>
            <td>Gambar Paket</td>
            <td>aksi</td>
        </tr>

        @foreach($datas as $data)
        <tr>
            <td>{{ $data->nama_paket }}</td>
            <td>{{ $data->harga_paket }}</td>
            <td>{{ $data->id_vendor }}</td>
            <td>{{ $data->gambar_paket }}</td>
            <td>
                <a href="{{ route('formEditPaket', $data->id_paket) }}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <a href="{{ route('deletePaket', $data->id_paket) }}">
                    <button class="btn btn-danger" onclick="return konfirmasi()">Delete</button>
                </a>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
{{ $datas->links() }}
@endsection


