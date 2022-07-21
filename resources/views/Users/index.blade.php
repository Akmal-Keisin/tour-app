@extends('Layouts.mainLayout')
@section('content')
<div class="wa-container">
    @include('Layouts.sidebar')
      <div class="wa-field">
        @include('Layouts.top_navigation')
        <div class="wa-field-container">
          <div class="box">
            <div class="box-head p-4 d-flex justify-content-between">
              <h1>User List</h1>
              <div class="group">
                <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
                <button class="btn wa-btn-success mx-1"><i class='bx bx-check-square'></i></button>
                <button class="btn wa-btn-primary mx-1"><i class='bx bx-user-plus'></i></button>
              </div>
            </div>
            <div class="box-body">
              <table class="wa-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Check</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>img</td>
                    <td>Akmal Keisin Alfateh</td>
                    <td>081390049855</td>
                    <td>Admin</td>
                    <td>
                      <button class="mx-1 btn wa-btn-primary"><i class='bx bx-show-alt'></i></button>
                      <button class="mx-1 btn wa-btn-warning"><i class='bx bx-edit-alt'></i></button>
                      <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
                    </td>
                    <td>
                      <input type="checkbox" value="" class="form-check-input d-block m-auto">
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>img</td>
                    <td>Akmal Keisin Alfateh</td>
                    <td>081390049855</td>
                    <td>Admin</td>
                    <td>
                      <button class="mx-1 btn wa-btn-primary"><i class='bx bx-show-alt'></i></button>
                      <button class="mx-1 btn wa-btn-warning"><i class='bx bx-edit-alt'></i></button>
                      <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
                    </td>
                    <td>
                      <input type="checkbox" value="" class="form-check-input d-block m-auto">
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>img</td>
                    <td>Akmal Keisin Alfateh</td>
                    <td>081390049855</td>
                    <td>Admin</td>
                    <td>
                      <button class="mx-1 btn wa-btn-primary"><i class='bx bx-show-alt'></i></button>
                      <button class="mx-1 btn wa-btn-warning"><i class='bx bx-edit-alt'></i></button>
                      <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
                    </td>
                    <td>
                      <input type="checkbox" value="" class="form-check-input d-block m-auto">
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>img</td>
                    <td>Akmal Keisin Alfateh</td>
                    <td>081390049855</td>
                    <td>Admin</td>
                    <td>
                      <button class="mx-1 btn wa-btn-primary"><i class='bx bx-show-alt'></i></button>
                      <button class="mx-1 btn wa-btn-warning"><i class='bx bx-edit-alt'></i></button>
                      <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
                    </td>
                    <td>
                      <input type="checkbox" value="" class="form-check-input d-block m-auto">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <div class="test">

    </div>
    </div>
@endsection
