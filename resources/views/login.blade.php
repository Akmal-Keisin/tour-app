<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/vue@3"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-6">
            <div class="login-box">
              <div class="box-head">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
