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
    <div class="col-md-12">
        Pengajuan Permintaan Kerjasama Dengan Anda
    </div>
</div>
<table class="table" id="table-vendor">
    <thead>
        <tr>
            <td>Nama WO</td>
            <td>Nama Layanan</td>
            <!-- <td>Jenis</td> -->
            <td>Harga</td>
            <td>Status</td>
            <td>Gambar</td>
            <td>Aksi</td>
        </tr>

        @foreach($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->nama_layanan }}</td>
                <!-- <td>{{ $data->jenis_layanan }}</td> -->
                <td>Rp.{{ $data->harga_layanan }},-</td>
                <td>
                    @if ($data->statusKonfirmasi === 0)
                        Menunggu Persetujuan
                    @elseif ($data->statusKonfirmasi === 1)
                        Terkonfirmasi
                    @else
                        Ditolak
                    @endif
                </td>
                <td>
                    <!-- <img width="200" src="{{url('img/fotoUser')}}/{{$data->gambar_layanan}}" alt=""> -->
                    <button type="button" onclick="getData({{ json_encode($data['gambar_layanan']) }})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Lihat
                        </button>
                </td>
                <td>
                    
                    <a href="{{ route('konfirmasiKerjasama', $data->id_detail_paket) }}">
                        <button {{ $data['statusKonfirmasi'] == 0 ? '' : 'disabled' }} onclick="return konfirmasi()" class="btn btn-warning">Konfirmasi</button>
                    </a>

                    <a href="{{ route('tolakKerjasama', $data->id_detail_paket) }}">
                        <button {{ $data['statusKonfirmasi'] == 0 ? '' : 'disabled' }} onclick="return konfirmasi()" class="btn btn-warning">Tolak</button>
                    </a>
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
        <img width="400" src="" id="gambar_layanan" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    function getData (data) {
        $('#gambar_layanan').attr("src", "{!!  url('img/fotoUser/" + data +"') !!}")
    }
</script>
@endsection
