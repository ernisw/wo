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
        <a href="{{route('inputTransaksi')}}">
            <button class="btn btn-success">Tambah</button>
        </a>
        
    </div>
</div>
<table class="table" id="table-transaksi">
    <thead>
        <tr>
        
            <td>Nama Item</td>
            <td>Nama WO/Vendor</td>
            <td>Harga</td>
            <td>Status</td>
            <td>Aksi</td>
        
        </tr>

        <tr>
            @foreach($datas as $data)
            <td>{{$data->nama_paket}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->no_telp}}</td>
            <td>{{$data->nama_paket}}</td>
            <td>{{$data->total}}</td>
            <td>{{$data->set_tanggal_nikah}}</td>
            <td>{{$data->status}}</td>
            <td>
                <a href="{{ route('status1', $data->id_transaksi)}}">
                <button class="btn btn-danger" onclick="return konfirmasi()">Cancel</button>
                </a><br>
                <a href="{{ route('status2', $data->id_transaksi)}}"> 
                <button class="btn btn-danger" onclick="return konfirmasi()">Proccess</button>
                </a><br>
                <a href="{{ route('status3', $data->id_transaksi)}}"> 
                    <button class="btn btn-danger" onclick="return konfirmasi()">Finish</button>
                </a>
            </td>
            <td>
                <a href="{{ route('formEditTransaksi', $data->id_transaksi) }}">
                    <button class="btn btn-primary">Edit</button>
                </a>
                <a href="{{ route('deleteTransaksi', $data->id_transaksi) }}">
                    <button class="btn btn-danger" onclick="return konfirmasi()">Delete</button>
                </a>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
{{ $datas->links() }}
@endsection


