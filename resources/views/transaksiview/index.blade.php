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
<!-- <div class="row mb-5">
    <div class="col-md-6">
        <a href="{{route('inputVendor')}}">
            <button class="btn btn-success">Tambah</button>
        </a>
        
    </div>
</div> -->
<table class="table table-responsive" id="table-pembayaran">
    <thead>
        <tr>
          
            <td>Nama Item</td>
            <td>Nama User</td>
            <td>Jenis</td>
            <td>Status</td>
            <td>Tanggal Nikah</td>
            <td>Bukti Pembayran</td>
            <td>Aksi</td>
        </tr>

        @foreach($datas as $data)
        <tr>
           
            <td>{{ $data['detail']['namaItem'] }}</td>
            <td>{{ $data['name'] }}</td>
            <td>{{ $data['jenis'] }}</td>
            <td>
                @if($data['status'] == 0)
                    Belum Dikonfirmasi
                @elseif($data['status'] == 1)
                    Sudah Dikonfirmasi
                @elseif($data['status'] == 2)
                    Sudah Upload Bukti Bayar
                @elseif($data['status'] == 3)
                    Sudah Konfirmasi Bukti Bayar
                @elseif($data['status'] == 4)
                    Selesai
                @endif
            </td>
            <td>{{ date('d-M-Y', strtotime($data['tanggal_nikah'])) }}</td>
            <td>
                @if($data['status'] >= 2)
                    <button type="button" onclick="getData({{ json_encode($data['bukti_pembayaran']) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Lihat
                        </button>
                    <!-- <button class="btn btn-success">Lihat</button> -->
                @else
                    <button type="button" onclick="getData({{ json_encode($data['bukti_pembayaran']) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Lihat
                        </button>
                    <!-- <button disabled class="btn btn-success">Lihat</button> -->
                @endif
            </td>
            <td>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('konfirmasi', $data['id_bayar']) }}">
                            <button {{ $data['status'] == 0 ? '' : 'disabled' }} onclick="return konfirmasi()" class="btn btn-warning">Konfirmasi Pemesanan</button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('konfirmasipembayaran', $data['id_bayar']) }}">
                            <button {{ $data['status'] == 2 ? '' : 'disabled' }} onclick="return konfirmasi()" class="btn btn-warning">Konfirmasi Pembyaran</button>
                        </a>
                    </div>
                </div>
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
        <img width="400" src="" id="bukti_pembayaran" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function getData (data) {
        $('#bukti_pembayaran').attr("src", "{!!  url('img/fotoUser/" + data +"') !!}")
    }
</script>
@endsection
