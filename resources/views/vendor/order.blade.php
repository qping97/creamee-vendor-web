@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Order</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered ajax-crud-datatable">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>PickUp Date</th>
                <th>Customer</th>
                <th>Contact No</th>
                <th>Delivery Method</th>
                <th>Amount (RM)</th>
                <th>Status</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $a)
            <tr>
                <td>{{$a->id}}</td>
                <td>{{$a->pickup_date}}</td>
                <td>{{$a->customer->name}}</td>
                <td>{{$a->customer->contact_no}}</td>
                <td>{{$a->delivery_method}}</td>
                <td>{{$a->amount}}</td>
                <td>{{$a->order_status}}</td>
                <td>
                    <a class="btn btn-success" href="{{url('/vendor/order-details/'.$a->id)}}">Details</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="OrderDetailModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="edit-form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" id="pro-id"> 
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-type" name="type" placeholder="Enter Type" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-price" name="product_price" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>
                    <label for="name" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-type" name="type" placeholder="Enter Type" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-price" name="product_price" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>
                    <label for="name" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-type" name="type" placeholder="Enter Type" maxlength="50" required="">
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-price" name="product_price" placeholder="Enter Name" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save-edit">Save changes</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div> -->
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
$('.ajax-crud-datatable').DataTable();
});
// function edit(){
//     $('#edit-form').trigger("reset");
//     $('#OrderDetailModal').html("Add Product");
//     $('#edit-modal').modal('show');
// }
</script>
@endsection