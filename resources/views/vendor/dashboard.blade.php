@extends('layouts.main')
@section('content')
<div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header">
                          <h5 class="font-weight-semibold"> Summary</h5>
                        </div>
                      </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                      <div class=" col-md -6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Total Orders</span>
                          <h4>{{$order}}</h4>
                          <!-- <span class="report-count"> 2 Reports</span> -->
                        </div>
                        <div class="inner-card-icon bg-success">
                          <i class="icon-note"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Total Product</span>
                          
                          <h4>{{$product}}</h4>
                          
                          <!-- <span class="report-count"> 3 Reports</span> -->
                        </div>
                        <div class="inner-card-icon bg-danger">
                          <i class="icon-briefcase"></i>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">Total Earning</span>
                          <h4>RM {{$total}}</h4>
                          <!-- <span class="report-count"> 5 Reports</span> -->
                        </div>
                        <div class="inner-card-icon bg-warning">
                          <i class="icon-diamond"></i>
                        </div>
                      </div>
                      <!-- <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                          <span class="report-title">RETURN</span>
                          <h4>25,542</h4>
                          <span class="report-count"> 9 Reports</span>
                        </div>
                        <div class="inner-card-icon bg-primary">
                          <i class="icon-diamond"></i>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection