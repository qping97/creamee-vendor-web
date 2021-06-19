@extends('layouts.main')
@section('content')
<div class="container mt-2">
<h3 class="card-title">My Profile</h3><br/>
            @if(session('profile'))
            <div class="alert alert-success">
              <strong>Success!</strong> Vendor Profile updated successfully!.
            </div>
            @endif
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">  
                    <!-- <p class="card-description"> </p> -->
                    <br/>
                    <form action="{{url('myprofile-update')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                      <img src="{{asset('/'.$vendor['profile_img'])}}" width="70" class="img-thumbnail"/>
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" name="profile_img" placeholder="Image" value="{{$vendor->profile_img}}">
                      </div>
                      <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" placeholder="Fullname" value="{{$vendor->fullname}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="vendor_name">Business Name</label>
                        <input type="text" class="form-control" name="vendor_name" placeholder="Business Name" value="{{$vendor->vendor_name}}">
                      </div>

                      <div class="form-group">
                        <label for="vendor_address">Address</label>
                        <input type="text" class="form-control" name="vendor_address" placeholder="Address" value="{{$vendor->vendor_address}}">
                      </div>

                      <div class="form-group">
                        <label for="registration_no">Business Registration No</label>
                        <input type="text" class="form-control" placeholder="Business Registration No" value="{{$vendor->registration_no}}" disabled>
                      </div>
                      
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Email" value="{{$vendor->email}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="contact_no">Contact No</label>
                        <input type="text" class="form-control" name="contact_no" placeholder="Email" value="{{$vendor->contact_no}}">
                      </div>

                      <div class="form-group">
                      <img src="{{asset('/'.$vendor['image'])}}" width="70" class="img-thumbnail"/>
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Image" value="{{$vendor->image}}">
                      </div>

                      <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="New Password">
                      </div>

                      <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </form>
                  </div>
                </div>
              </div>
</div>
<script>

</script>
@endsection