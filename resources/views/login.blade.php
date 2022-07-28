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
    <div class="container" id="app">
        <div class="row justify-content-center">
          <div class="col-sm-6">
            <div class="login-box">
              <div class="box-head">
                <img src="{{ asset('img/logo.png') }}" alt="logo" class="">
                <h1 class="text-center">TRAVEL</h1>
              </div>
              <div class="box-body">
                <p v-if="msg" class="text-center text-danger">Email atau password salah, silahkan cek kembali email dan password anda</p>
                <form action="" @submit.prevent="login" id="loginForm" method="post">
                  <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number :</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Your Phone Number">
                    <div v-if="validationMsg.phone_number" class="text-danger mt-2">
                        @{{ validationMsg.phone_number[0] }}
                    </div>
                  </div>
                  <div class="mb-5">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Your password">
                    <div v-if="validationMsg.password" class="text-danger mt-2">
                        @{{ validationMsg.password[0] }}
                    </div>
                  </div>
                  <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
    const {createApp} = Vue
    createApp({
        data() {
            return{
                validationMsg: {},
                msg: ''
            }
        },
        methods: {
            login() {
                let formData = new FormData(document.getElementById('loginForm'))
                var myHeaders = new Headers();
                myHeaders.append("Accept", "application/json");


                let requestOption = {
                    method: 'POST',
                    headers: myHeaders,
                    body: formData
                }
                console.log(formData.get('email'))
                fetch(`https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/auth-admin`, requestOption)
                .then((response) => {
                    // convert response
                    return response.json()
                })
                .then((json) => {
                    if (json.info == "Login Failed") {
                        // send validation data
                        this.msg = json.data
                        return
                    } else if (json.info == "Validation Error") {
                        this.validationMsg = json.data
                        return
                    }
                    this.validationMsg = {}
                    document.getElementById('loginForm').reset()
                    localStorage.setItem('token', json.token)
                    window.location = "https://magang.crocodic.net/ki/kelompok_3/tour-app/public/admin"

                })
                .catch((err) => {
                    alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                    console.log(err)
                })
            }
        }
    }).mount('#app')
</script>
</body>
</html>
