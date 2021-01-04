@extends('wo_admin.wo_admin')
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
    <div class="col-md-12">
        Detail Paket
    </div>
    <div class="col-md-12">
        <a href="{{ route('dataPaketWo') }}">
            <button class="btn btn-warning">Back</button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item align-items-center">
                <div class="text-muded">Nama Paket</div>
                <h5> {{ $paket->nama_paket }}</h5>
            </li>
            <li class="list-group-item align-items-center">
                <div class="text-muded">Harga Paket</div>
                <h5> Rp.{{ $paket->harga_paket }},-</h5>
            </li>
            <li class="list-group-item align-items-center">
                <div class="text-muded">Jumlah Layanan</div>
                <h5>{{ $jumlahLayanan }} Layanan</h5>
            </li>
        </ul>
    </div>
</div>
<br>
<table class="table table-bordered" id="table-vendor">
    <thead>
        <tr style="background-color: #ffffff;">
            <th>Nama</th>
            <th>Detail</th>
            <th>Harga</th>
            <th>Vendor</th>
            <th>Gambar</th>
            <th>Status</th>
        </tr>

        @foreach($datas as $data)
        <tr>
            <td>{{ $data->nama_layanan }}</td>
            <td>{{ $data->detail_layanan }}</td>
            <td>Rp. {{ $data->harga_layanan }},-</td>
            <td>
                <a href="{{ route('dataProfile', $data->id) }}">
                    {{ $data->name }}
                </a>
            </td>
            <td>
                <button type="button" onclick="getData({{ json_encode($data->gambar_layanan) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Gambar User
                </button>
                <!-- <img width="100" src="{{ url('img/fotoUser/') }}/{{ $data->gambar }}" alt=""> -->
            </td>
            <td>
                @if($data->statusKonfirmasi)
                <h3><span class="badge badge-success">Sudah Dikonfirmasi Vendor</span></h3>
                @else
                <h3><span class="badge badge-danger">Belum Dikonfirmasi Vendor</span></h3>
                @endif
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img width="100" src="" id="gambarKTP" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function getData (data) {
        console.log(data)
        $('#gambarKTP').attr("src", "{!!  url('img/fotoUser/" + data +"') !!}")
    }
</script>
{{ $datas->links() }}
@endsection
