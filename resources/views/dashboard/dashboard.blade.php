@extends('layouts.app')

@section('content')
<div class="container py-5">
<form class="row g-3" action="{{ route('register.post') }}" name='frm' id='frm' method="post">
@csrf
<div class="col-md-4">
    <label class="form-label">First Name</label>
    <input id="first_name" type="text" name="first_name" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Last Name</label>
    <input id="last_name" type="text" name="last_name" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label  class="form-label">Date of Birth</label>
    <input id="dob" type="text" name="dob" class="form-control" placeholder="DD/MM/YYYY" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="col-md-6">
    <label  class="form-label">Mobile No</label>
    <input id="mobile" type="number" name="mobile" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label  class="form-label">User Name</label>
    <input id="suer_name" type="text" name="user_name" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>
  <div class="col-12">
    <label class="form-label">Address</label>
    <input type="text" id="address" name="address" class="form-control" placeholder="1234 Main St">
  </div>
  <div class="col-md-5">
    <label for="inputCity" class="form-label">State</label>
    <input type="text" id="state" name="state" class="form-control">
  </div>
  <div class="col-md-5">
    <label for="inputCity" class="form-label">City</label>                            
    <input type="text" id="city" name="city" class="form-control">
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip Code</label>
    <input type="number" id="zip" name="zip" class="form-control">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Register Account</button>
  </div>
</form>
</div> 
</div>
@endsection