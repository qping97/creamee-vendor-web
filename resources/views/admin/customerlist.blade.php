@extends('layouts.admin-main')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Customer</h2>
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
                <th>Customer Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($customer)
            @foreach($customer as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->email}}</td>
                <td>{{$c->contact_no}}</td>
                <td>
                    <a class="btn btn-primary" onClick="viewFunc({{$c->id}},this)" href="javascript:void(0)">View</a>
                    <!-- <a class="btn btn-dark" onClick="blockFunc({{$c->id}}, this)" href="javascript:void(0)">Block</a> -->
             
               
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- boostrap company model -->
<div class="modal fade" id="view-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewModal"></h5>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="view-form" name="CustomerForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               
                <!-- <input type="hidden" name="cus_id" id="cus-id">  -->
                <div id="profile-img"></div>
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="view-name" class="form-control" name="name" maxlength="50" disabled>
                        </div>
                    </div>  

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Contact No</label>
                        <div class="col-sm-12">
                            <input type="text" id="view-contact-no" class="form-control" name="contact_no" maxlength="50" disabled>
                        </div>
                    </div> 

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" id="view-email" class="form-control" name="email" maxlength="50" disabled>
                        </div>
                    </div> 

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" id="view-address" class="form-control" name="address" maxlength="50" disabled>
                        </div>
                    </div> 

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>

@endsection
<!-- end bootstrap model -->
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

function viewFunc(id,obj){
    $('#view-form').trigger("reset");
    $('#ViewModal').html("Customer Details");
    $('#view-modal').modal('show');
    $.ajax({
        type:"GET",
        url: "{{ url('customer-list/view') }}/" + id, 
        dataType: 'json',
        success: function(res){
            $('#view-name').val(res.name);
            $('#view-contact-no').val(res.contact_no);
            $('#view-email').val(res.email);
            $('#view-address').val(res.address);
            $('#cus-id').val(res.id);

            var path ='{{asset("")}}' + res.profile_pic;
            $('#profile-img').html(`<img src="${path}" width="25%" style="margin-left:auto; margin-right:auto; display:block" class="img-thumbnail"/>`);
     
        }
    })
}

$("#isblock").click(function() {
    if ($(this).attr('class') == 'btn btn-dark') {
        $(this).html('Block');
        $(this).removeClass('btn btn-dark');
        $(this).addClass('btn btn-light');
    } else {
        $(this).html('Unblock');
        $(this).removeClass('btn btn-light');
        $(this).addClass('btn btn-dark');
    }
});

</script>
@endsection