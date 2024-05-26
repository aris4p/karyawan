@extends('layout.admin_main')
@section('body')

<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@if ($message = Session::get('Success') )
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="mb-3">
    <a href="" class="btn btn-primary tombol-tambah-produk" type="submit">Tambah</a>
</div>
<section class="section dashboard">
    <!-- Table with hoverable rows -->
    <table class="table table-striped data-table" style="width:100%" >
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
                
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('karyawan') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    // Tambahkan kolom lain di sini jika perlu
                    { "data": "action", "searchable": false, "orderable": false }
                ]
            });
        });
    </script>
    
    @endsection
    