@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

<div class="container-scroller">
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
<!-- <div class="main-panel"> -->
  <div>
          <div class="content-wrapper">

            <div class="row">
          
          @if(session('status'))
            <div class="alert alert-success">
              <strong>Success!</strong> Order status updated successfully!.
            </div>
            @endif
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Order #{{$order->id}}</h4>
                    <p class="card-description">Customer Details</p>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" value="{{$order->customers->name}}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email</label>
                        <input type="email" class="form-control"  value="{{$order->customers->email}}" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Contact Number</label>
                        <input type="text" class="form-control" value="{{$order->customers->contact_no}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Address</label>
                        <input type="text" class="form-control"  value="{{$order->customers->address}}" disabled>
                      </div>
                      <br/>
                      <p class="card-description">Order Details</p>
                    <form class="forms-sample">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Pick Up Date</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control"   value="{{$order->pickup_date}}" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Order Date</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control"  value="{{$order->order_date}}" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Shipping Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$order->shipping_address}}" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$order->amount}}" disabled>
                        </div>
                      </div>

                      
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Payment</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$order->payment}}" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Delivery Method</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$order->delivery_method}}" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Delivery Fee</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$order->delivery_fee}}" disabled>
                        </div>
                      </div>

                    </form>
                    </form>
                  </div>
                </div>
              </div>
              @php
        $i = 1;
    @endphp
              @foreach($order->product as $b)
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product #{{ $i }}</h4>
                    <!-- <p class="card-description"> Horizontal form layout </p> -->
                   
                    <form class="forms-sample">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputUsername2" value="{{$b->name}}" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Image</label>
                        <div class="col-sm-9">
                        <img src="{{asset($b->product_img)}}" width="70" class="img-thumbnail"/>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputEmail2" value="{{$b->pivot->quantity}}" disabled>
                        </div>
                      </div>
                    </form>
                    
                  </div>
                </div>
              </div>
              @php
              $i++;
                  @endphp
              @endforeach   
              
            
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                <form action="{{url('vendor/orderstatus-update/' .$order->id)}}" method="POST" >
                {{ csrf_field() }}

                  <div class="card-body">
                    <h4 class="card-title">Order Status</h4>
                    <div class="form-group">

                    <div class="col-md-6">
                        <input type="radio" name="order_status" id="Pending" value="Pending" @if($order->order_status =='Pending') checked @endif> Pending<br>
                        <input type="radio" name="order_status" id="Processing" value="Processing" @if($order->order_status =='Processing') checked @endif > Processing<br>              
                        <input type="radio" name="order_status" id="Delivery" value="Delivery" @if($order->order_status =='Delivery') checked @endif > Out For Delivery<br>              
                        <input type="radio" name="order_status" id="Cancelled" value="Cancelled" @if($order->order_status =='Cancelled') checked @endif > Cancelled<br>                               
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>

                   </div>

                  </form>
                </div>
              </div>
</div>
</div>
</div>
</div>
@endsection