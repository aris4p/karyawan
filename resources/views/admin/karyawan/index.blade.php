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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
        Tambah Karyawan
    </button>
</div>
<section class="section dashboard">
    <!-- Table with hoverable rows -->
    <table class="table table-striped " id="data-table" style="width:100%" >
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Alamat</th>
                <th scope="col">Foto</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
                
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
    
    {{-- modal tambah karyawan --}}
    
    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama Karyawan</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Masukan Nama">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email</label>
                            <input type="text" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-0">
                            <label for="dobWithTitle" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="dobWithTitle" class="form-control" placeholder="DD / MM / YY">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamatWithTitle" class="form-label">Alamat</label>
                            <textarea type="text" id="alamatWithTitle" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="passwordWithTitle" class="form-label">Password</label>
                            <input type="password" id="passwordWithTitle" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="foto" class="form-label">File Foto</label>
                            <input type="file" id="foto" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select">
                                <option value="1">Menikah</option>
                                <option value="0">Belum Menikah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="btnSimpanKaryawan" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    
    
    {{-- AKhir MOdal Tambah Karyawan --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('karyawan') }}",
                "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "tgllahir" },
                { "data": "alamat" },
                { "data": "foto" },
                { "data": "status" },
                // Tambahkan kolom lain di sini jika perlu
                { "data": "action", "searchable": false, "orderable": false }
                ]
            });
            
            $('#btnSimpanKaryawan').click(function(){
                var nama = $('#nameWithTitle').val();
                var email = $('#emailWithTitle').val();
                var dob = $('#dobWithTitle').val();
                var alamat = $('#alamatWithTitle').val();
                var password = $('#passwordWithTitle').val();
                var foto = $('#foto')[0].files[0]; // Mengambil file gambar
                var status = $('#status').val();
                
                var formData = new FormData();
                formData.append('nama', nama);
                formData.append('email', email);
                formData.append('dob', dob);
                formData.append('alamat', alamat);
                formData.append('password', password);
                formData.append('foto', foto);
                formData.append('status', status);
                formData.append('_token', '{{ csrf_token() }}'); // Menambahkan token CSRF
                
                $.ajax({
                    url: '{{ route("simpan-karyawan") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,  // Diperlukan saat mengirimkan FormData
                    contentType: false,  // Diperlukan saat mengirimkan FormData
                    success: function(response){
                        
                        $('#data-table').DataTable().ajax.reload(); // Perbarui datatable dengan AJAX
                        $('#modalCenter').modal('hide'); // Menutup modal secara otomatis
                        Toastify({
                            text: "Data berhasil disimpan",
                            duration: 3000, // Durasi tampilan pesan (dalam milidetik)
                            gravity: "bottom", // Posisi pesan (top, bottom, center)
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)" // Warna latar belakang pesan
                        }).showToast();
                    },
                    error: function(xhr){
                        Toastify({
                            text: "Data Gagal Disimpan",
                            duration: 3000, // Durasi tampilan pesan (dalam milidetik)
                            gravity: "bottom", // Posisi pesan (top, bottom, center)
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)" // Warna latar belakang pesan
                        }).showToast();
                    }
                });
            });
            
            
        });
        
        
    </script>
    
    
    @endsection
    