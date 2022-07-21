@extends('Layouts.mainLayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <div class="login-box">
          <div class="box-head">
            <img src="../../assets/img/logo.png" alt="logo" class="">
            <h1 class="text-center">TRAVEL</h1>
          </div>
          <div class="box-body">
            <form>
              <div class="mb-3">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-5">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="mb-3 d-flex justify-content-end">
                <router-link to="/admin" type="button" class="btn wa-btn-primary">Login</router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
