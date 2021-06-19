@extends('layouts.admin-main')

@section('content')
<div class="container mt-2">
<h3 class="card-title">Dashboard</h3><br/>
</div>
<div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row report-inner-cards-wrapper">
                      <div class=" col-md -6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Registered Vendor</span>
                          <h4>{{$vendor}}</h4>
                          <!-- <span class="report-count"> 2 Reports</span> -->
                        </div>
                        <div class="inner-card-icon bg-warning">
                          <i class="icon-emotsmile"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Registered Customer</span>
                          
                          <h4>{{$customer}}</h4>
                          
                          <!-- <span class="report-count"> 3 Reports</span> -->
                        </div>
                        <div class="inner-card-icon bg-danger">
                          <i class="icon-people"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection