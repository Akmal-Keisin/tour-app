@extends('layouts.template')
@section('content')

    <div id="app">
        <div class="box mx-4 my-3">
            <div class="box-head d-flex justify-content-between py-1">
                <h1 class="text m-0 p-0">Admin List</h1>
                <div class="group">
                    <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#showAdd"><i class='bx bx-user-plus'></i></button>
                            <div class="modal fade" id="showAdd" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Add Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image :</label>
                                                <input type="file" id="image" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name :</label>
                                                <input type="text" id="name" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone Number :</label>
                                                <input type="text" class="form-control" id="phone_number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password :</label>
                                                <input type="password" class="form-control" id="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Add Now!</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    <button class="btn btn-sm btn-danger mx-1"><i class='bx bx-trash'></i></button>
                    <button class="btn btn-sm btn-success mx-1"><i class='bx bx-check-square' ></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="wa-table table table-borderless table-striped align-middle table-responsive">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Check</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in data">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.phone_number }}</td>
                        <td>@{{ (item.role_id == 1) ? 'Admin' : 'User' }}</td>
                        <td>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showDetail"><i class="bx bx-show-alt"></i></button>
                            <div class="modal modal-lg fade" id="showDetail" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Admin Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-4">
                                                <img src="{{ asset('img/logo.png') }}" class="rounded-circle w-75" alt="Avatar">
                                            </div>
                                            <div class="col-8">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pe-3 key">Nama</td>
                                                            <td class="ps-3">@{{ item.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Phone Number</td>
                                                            <td class="ps-3">@{{ item.phone_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Role</td>
                                                            <td class="ps-3">@{{ (item.role_id == 1) ? 'Admin' : 'User' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <button class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#showEdit"><i class="bx bx-edit-alt"></i></button>
                            <div class="modal fade" id="showEdit" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Admin Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image :</label>
                                                <input type="file" id="image" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name :</label>
                                                <input type="text" id="name" class="form-control" :value="item.name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone Number :</label>
                                                <input type="text" class="form-control" id="phone_number" :value="item.phone_number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password :</label>
                                                <input type="password" class="form-control" id="password" :value="item.password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-warning">Save Changes</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                          <button class="mx-1 btn btn-danger"><i class='bx bx-trash'></i></button>
                        </td>
                        <td >
                          <input type="checkbox" value="" class="form-check-input">
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const {createApp} = Vue

        createApp({
            data() {
                return {
                    data: [],
                }
            },
            methods: {
                showDetail(id) {
                    const detail = this.data.find(item => item.id = id)
                    console.log(detail)
                },
                addData() {
                    let formData = new FormData(addForm)

                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");


                    let requestOption = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formData

                    }
                    this.newData = fetch('http://127.0.0.1:8000/api/tour', requestOption)
                    .then(response => response.json())
                    .then((json) => {
                        this.data.push(json.data)

                    })
                    var myModalEl = document.getElementById('showAdd');
                    var modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();
                    alert('Data Berhasil Ditambahkan')
                }
            },
            mounted() {
                this.data = fetch('http://127.0.0.1:8000/api/admin', {
                    method: 'get',
                    headers: {
                        'Content-Type': 'Application/json'
                    }
                })
                .then(response => response.json())
                .then((json) => {
                    this.data = json.data
                })
                .catch((error) => {
                    console.log('Error', error)
                })
            }
        }).mount('#app')
    </script>
@endsection
