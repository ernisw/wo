@extends('admin.admin')
@section('content')
<button>tmbah</button>
<table class="table" id="table-layanan">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Layanan</td>
            <td>Jenis Layanan</td>
            <td>Harga</td>
            <td>Id Vendor</td>
            <td>Id Paket</td>
            <td>Gambar Layanan</td>
            <td>aksi</td>
        </tr>
    </thead>
</table>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#table-layanan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                'url': '{{ url("/layanan/data") }}',
                'type': 'GET'
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                {data: 'nama_layanan', name: 'nama_layanan', orderable: true},
                {data: 'jenis_layanan', name: 'jenis_layanan', orderable: true},
                {data: 'harga', name: 'harga', orderable: true},
                {data: 'id_vendor', name: 'id_vendor', orderable: true},
                {data: 'id_paket', name: 'id_paket', orderable: true},
                {data: 'gambar_layanan', name: 'gambar_layanan', orderable: true},
                {data: 'aksi', name: 'aksi', orderable: false}
            ],
        });

    });
</script>
@endpush

