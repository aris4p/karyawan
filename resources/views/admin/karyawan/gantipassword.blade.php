@extends('layout.admin_main')
@section('body')

<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Setting</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Ganti Password</a>
                    </li>
                    
                </ul>
                <div class="card mb-4">
                    
                    <hr class="my-0" />
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('change-password') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="passwordSaatIni" class="form-label">Password Saat ini</label>
                                    <input
                                    class="form-control"
                                    type="password"
                                    id="passwordSaatIni"
                                    name="passwordSaatIni"
                                    autofocus
                                    />
                                    @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                    
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="passwordBaru" class="form-label">Password Baru</label>
                                    <input class="form-control" type="password" name="passwordBaru" id="passwordBaru"  />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="passwordBaru_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input class="form-control" type="password" name="passwordBaru_confirmation" id="passwordBaru_confirmation" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            
            
            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        
        @endsection