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
    <button type="button" class="btn btn-primary" id="tambahkaryawan">
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
    
    {{-- Edit Karyawan --}}
    
    <div class="modal fade" id="editKaryawan" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" id="karyawan_id">
                            <label for="nameWithTitle" class="form-label">Nama Karyawan</label>
                            <input type="text" id="editnameWithTitle" class="form-control" placeholder="Masukan Nama">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="editemailWithTitle" class="form-label">Email</label>
                            <input type="text" id="editemailWithTitle" class="form-control" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-0">
                            <label for="editdobWithTitle" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="editdobWithTitle" class="form-control" placeholder="DD / MM / YY">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="editalamatWithTitle" class="form-label">Alamat</label>
                            <textarea type="text" id="editalamatWithTitle" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="editfoto" class="form-label">File Foto</label>
                            <input type="file" id="editfoto" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="editstatus" class="form-select">
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
                    <button type="button" id="btnSimpanEditKaryawan" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- AKhir Edit Karyawan --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //Datatables
            $('#data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('karyawan') }}",
                "columns": [
                { "data": 'DT_RowIndex', "searchable": false, "orderable": false},
                { "data": "name" },
                { "data": "tgllahir" },
                { "data": "alamat" },
                { "data": "foto" },
                { "data": "status" },
                // Tambahkan kolom lain di sini jika perlu
                { "data": "action", "searchable": false, "orderable": false }
                ]
            });
            
            //tombol tambah karyawan
            $('#tambahkaryawan').click(function(){
                $('#modalCenter').modal('show');
            });
            
            //simpan data karyawan
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
                        Toastify({
                            text: "Data berhasil disimpan",
                            duration: 3000, // Durasi tampilan pesan (dalam milidetik)
                            gravity: "bottom", // Posisi pesan (top, bottom, center)
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)" // Warna latar belakang pesan
                        }).showToast();
                        $('#modalCenter').modal('hide'); // Menutup modal secara otomatis
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
            
            //getkaryawan untuk edit
            $('body').on('click', '#editbtn', function () {
                
                let karyawan_id = $(this).data('id');
                console.log(karyawan_id);
                //fetch detail post with ajax
                $.ajax({
                    url: `/getkaryawan/`+ karyawan_id,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        
                        //fill data to form
                        $('#karyawan_id').val(response.data.id);
                        $('#editnameWithTitle').val(response.data.name);
                        $('#editemailWithTitle').val(response.data.email);
                        $('#editdobWithTitle').val(response.data.tgllahir);
                        $('#editalamatWithTitle').val(response.data.alamat);
                        $('#editstatus').val(response.data.status);
                        
                        //open modal
                        $('#editKaryawan').modal('show');
                    }
                });
            });
            
            //edit karyawan
            $('body').on('click', '#btnSimpanEditKaryawan', function () {
                let karyawan_id = $('#karyawan_id').val();
                let name = $('#editnameWithTitle').val();
                let email = $('#editemailWithTitle').val();
                let dob = $('#editdobWithTitle').val();
                let alamat = $('#editalamatWithTitle').val();
                let foto = $('#editfoto')[0].files[0];
                let status = $('#editstatus').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                
                let formData = new FormData(); // Buat objek FormData untuk mengirim data termasuk file
                formData.append('_token', csrfToken);
                formData.append('id', karyawan_id);
                formData.append('name', name);
                formData.append('email', email);
                formData.append('tgllahir', dob);
                formData.append('alamat', alamat);
                formData.append('status', status);
                formData.append('foto', foto);
                
                
                // Mengirim data pembaruan dengan AJAX
                $.ajax({
                    url: '/updatekaryawan/' + karyawan_id,
                    type: 'POST',
                    data: formData,
                    processData: false, 
                    contentType: false,  
                    success: function (response) {
                        // Memperbarui tampilan atau melakukan tindakan setelah pembaruan berhasil
                        if (response.success) {
                            $('#data-table').DataTable().ajax.reload(); // Perbarui datatable dengan AJAX
                            Toastify({
                                text: "Data berhasil disimpan",
                                duration: 3000, // Durasi tampilan pesan (dalam milidetik)
                                gravity: "bottom", // Posisi pesan (top, bottom, center)
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)" // Warna latar belakang pesan
                            }).showToast();
                            $('#editKaryawan').modal('hide');
                            // Atau melakukan tindakan lain yang diperlukan
                        } else {
                            // Menampilkan pesan kesalahan jika diperlukan
                            alert('Gagal memperbarui karyawan. Silakan coba lagi.');
                        }
                    },
                    error: function () {
                        // Menampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan AJAX
                        alert('Terjadi kesalahan dalam memperbarui karyawan. Silakan coba lagi.');
                    }
                });
            });
            
            //Hapus Data Karyawan
            function deleteKaryawan(karyawan_id) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                
                // Mengirim permintaan AJAX untuk menghapus data karyawan
                $.ajax({
                    url: '/deletekaryawan/' + karyawan_id,
                    type: 'DELETE',
                    data: {
                        _token: csrfToken,
                        id: karyawan_id
                    },
                    success: function (response) {
                        if (response.success) {
                            // Tindakan jika penghapusan berhasil
                            $('#data-table').DataTable().ajax.reload(); // Perbarui datatable dengan AJAX
                            Toastify({
                                text: "Data karyawan berhasil dihapus",
                                duration: 3000,
                                gravity: "bottom",
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                            }).showToast();
                        } else {
                            // Tindakan jika terjadi kesalahan saat menghapus
                            alert('Gagal menghapus data karyawan. Silakan coba lagi.');
                        }
                    },
                    error: function () {
                        // Tindakan jika terjadi kesalahan dalam permintaan AJAX
                        alert('Terjadi kesalahan dalam menghapus data karyawan. Silakan coba lagi.');
                    }
                });
            }
            
            // Memanggil fungsi deleteKaryawan() saat pengguna mengklik tombol hapus
            $('body').on('click', '#btnHapusKaryawan', function () {
                let karyawan_id = $(this).data('id');
                deleteKaryawan(karyawan_id); // Panggil fungsi deleteKaryawan() dengan ID karyawan yang ingin dihapus
            });
            
        });
        
        
    </script>
    
    
    @endsection
    