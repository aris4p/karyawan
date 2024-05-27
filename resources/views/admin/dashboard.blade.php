@extends('layout.admin_main')
@section('body')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

    <section class="section dashboard">


        <!-- Left side columns -->
        <div >
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Karyawan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $karyawan }}</h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


          </div>
        </div><!-- End Left side columns -->




    </section>


@endsection

