@extends('layouts.admin-main')
@section('content')
<div class="container mt-2">
<h3 class="card-title">My Profile</h3><br/>
    <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">  
                    <!-- <p class="card-description"> </p> -->
                    <br/>
                    <form class="forms-sample" action="{{url('adminprofile-update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}

                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Email" value="{{$admin->email}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" placeholder="New Password" name="password">
                      </div>
            
                      <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection