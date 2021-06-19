@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container-scroller">
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
<div class="main-panel">
  <div>
          <div class="content-wrapper">

            <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Custom Order #{{$customorder->id}}</h4>
                    <form class="forms-sample">
                    <label for="exampleInputEmail3">Image</label>
                    <img src="{{asset('/'.$customorder->image)}}" width="25%" style="display: block;
                        margin-left: auto;
                        margin-right: auto;">
                      <div class="form-group">
                        <label for="exampleInputName1">Shape</label>
                        <input type="text" class="form-control" value="{{$customorder->shape}}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Size</label>
                        <input type="email" class="form-control"  value="{{$customorder->sizes->title}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Flavor</label>
                        <input type="text" class="form-control"  value="{{$customorder->flavors->type}}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <input type="text" class="form-control" value="{{$customorder->description}}" disabled>
                      </div>  
                      <div class="form-group">
                        <label for="exampleInputName1">Customize Text</label>
                        <input type="text" class="form-control" value="{{$customorder->customize_text}}" disabled>
                      </div>  
                      <br/>
                      <p class="card-description">Customer Details</p>
                    <form class="forms-sample">
                      <div class="form-group row">
                        <h3 class="col-sm-3 col-form-label">Name: {{$customorder->customers->name}} </h3>
                      </div>
                      <div class="form-group row">
                        <h3 class="col-sm-3 col-form-label">Contact No:
                          <span><a href="https://wa.me/<{{$customorder->customers->contact_no}}>" target="_blank"><img src="{{asset('images/portfolio/whatapp.png')}}" width="20px"></a></span>
                          {{$customorder->customers->contact_no}}  </h3>
                      </div>
                      <div class="form-group row">
                        <h3 class="col-sm-3 col-form-label">Email:
                          <span><a href="mailto:{{$customorder->customers->email}}" target="_blank"><img src="{{asset('images/portfolio/email.png')}}" width="20px"></a></span> {{$customorder->customers->email}}  
                          
                        </h3>
                      </div>

                      <div class="form-group row">
                        <h3 class="col-sm-3 col-form-label">Address: {{$customorder->customers->address}}</h3>
                      </div>
                    </form>
                    </form>
                  </div>
                </div>
              </div>
 
@endsection