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
                <h2>Custom Cake > Size</h2>
            </div>

            <div class="pull-right mb-2">
                <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create New</a>
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
                <th>Title</th>
                <th>Price</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($size)
            @foreach($size as $c)
            <tr>
                <!-- <td>{{$c->id}}</td> -->
                <td>{{$c->title}}</td>
                <td>{{$c->price}}</td>
                <td>
                    <a class="btn btn-success" onClick="editFunc({{$c->id}},this)" href="javascript:void(0)">Edit</a>
                    <a class="btn btn-danger" onClick="deleteFunc({{$c->id}}, this)" href="javascript:void(0)">Delete</a>
                </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- boostrap company model -->
<div class="modal fade" id="add-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="AddModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="add-form" name="Form" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" id="add-title" class="form-control" name="title" placeholder="Enter Title" maxlength="50" required="">
                        </div>
                    </div> 

                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" id="add-price" class="form-control" name="price" placeholder="Enter Price" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditModal"></h4>
                <button type="button" class="btn btn-link" data-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="EditForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="size-id"> 
                    <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit-title" name="title" placeholder="Enter Title" maxlength="50" required="">
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
</div>
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
function add(){
    $('#add-form').trigger("reset");
    $('#AddModal').html("Add Size");
    $('#add-modal').modal('show');
}

$('#btn-save').on('click',function(){

var title = $('#add-modal').find('#add-title').val();
var price = $('#add-modal').find('#add-price').val();
var data = new FormData();
data.append('title',title);
data.append('price',price);
data.append('_token','{{csrf_token()}}');
$.ajax({
    method:"POST",
    url: "{{ url('vendor/custom-cake/size/store') }}",
    dataType: 'json',
    processData: false,
    contentType: false,
    data: data,
    success: function(res){
        window.location = '{{ url("vendor/custom-cake/size")}}';
    },
});

});

var sizeId = ''; 
function editFunc(id,obj){
    sizeId = id;
    $('#EditModal').html("Edit Size");
    $('#edit-modal').modal('show');
    $.ajax({
        type:"GET",
        url: "{{ url('vendor/custom-cake/size/edit') }}/" + id, 
        dataType: 'json',
        success: function(res){
            $('#edit-title').val(res.title);
            $('#edit-price').val(res.price);
            $('#size-id').val(res.id);
        }
    })
}

$('#btn-save-edit').on('click',function(){

var id = $('#edit-modal').find('#size-id').val();
var title = $('#edit-modal').find('#edit-title').val();
var price = $('#edit-modal').find('#edit-price').val();
var data = new FormData();
data.append('id',id);
data.append('title',title);
data.append('price',price);
data.append('_token','{{csrf_token()}}');

$.ajax({
    method:"POST",
    url: "{{ url('vendor/custom-cake/size/update') }}/" + sizeId, 
    dataType: 'json',
    processData: false,
    contentType: false,
    data: data,
    success: function(res){
        window.location = '{{ url("vendor/custom-cake/size")}}';
    },
    error: function(res){
        alert("Error in saving data");
    },
});

});

function deleteFunc(id, obj){
    
    if (confirm("Delete Record?") == true) {
    $.ajax({
    type:"GET",
    url: "{{ url('vendor/custom-cake/size/delete') }}/" + id,
    dataType: 'json',
    success: function(res){
        window.location = '{{ url("vendor/custom-cake/size")}}';
    }
    });
    }
}

</script>
@endsection