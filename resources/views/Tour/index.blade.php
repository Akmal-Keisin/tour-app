@extends('layouts.template')
@section('content')
<script src="https://unpkg.com/vue@3"></script>
    <div id="app">
        <div class="box mx-4 my-3">
            <div class="box-head d-flex justify-content-between py-1">
                <h1 class="text m-0 p-0">Tour List</h1>
                <div class="group">
                    <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#showAdd"><i class='bx bx-layer-plus'></i></button>
                            <div class="modal fade" id="showAdd" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Add Tour</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form @submit.prevent="addData" id="addForm">

                                        <div class="modal-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image :</label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name :</label>
                                                    <input type="text" name="name" id="name" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category" class="form-label">category :</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option value="1">Nature</option>
                                                        <option value="2">Park</option>
                                                        <option value="3">All</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="information" class="form-label">Information :</label>
                                                    <textarea name="information" id="information" cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address :</label>
                                                    <textarea name="address" id="address"  cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="latitude" class="form-label">Latitude :</label>
                                                    <input type="text" class="form-control"  name="latitude" id="latitde">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="longitude" class="form-label">Longitude :</label>
                                                    <input type="text" class="form-control"  name="longitude" id="latitde">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Add Now!</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>

                                </div>
                                </div>
                            </div>
                    <button class="btn btn-sm btn-danger mx-1"><i class='bx bx-trash'></i></button>
                    <button class="btn btn-sm btn-success mx-1"><i class='bx bx-check-square' ></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="wa-table table table-borderless table-striped align-middle">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Information</th>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Action</th>
                        <th>Check</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in data">
                        <td>@{{ index + 1 }}</td>
                        <td><img src="@{{ item.image }}" alt=""></td>
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.category_id }}</td>
                        <td>@{{ item.information }}</td>
                        <td>@{{ (item.address.length > 20) ? item.address.substr(0,20) + '...' : item.address }}</td>
                        <td>@{{ item.latitude }}</td>
                        <td>@{{ item.longitude }}</td>
                        <td>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showDetail"><i class="bx bx-show-alt"></i></button>
                            <div class="modal modal-lg fade" id="showDetail" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Tour Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-4">
                                                <img :src="item.image" class="rounded-circle w-75" alt="Image">
                                            </div>
                                            <div class="col-8">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pe-3 key">Nama</td>
                                                            <td class="ps-3">@{{ item.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Category</td>
                                                            <td class="ps-3">@{{ item.category_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Information</td>
                                                            <td class="ps-3">@{{ item.information }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Address</td>
                                                            <td class="ps-3">@{{ item.address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Latitude</td>
                                                            <td class="ps-3">@{{ item.latitude }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Longitude</td>
                                                            <td class="ps-3">@{{ item.longitude }}</td>
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
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Tour Edit</h5>
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
                                                <label for="phone_number" class="form-label">Category :</label>
                                                <select name="category_id" class="form-control" id="category_id">
                                                    <option value="1">Nature</option>
                                                    <option value="2">Park</option>
                                                    <option value="3">All</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="information" class="form-label">Information :</label>
                                                <textarea name="information" id="information" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address :</label>
                                                <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Latitude :</label>
                                                <input type="text" id="latitude" class="form-control" :value="item.latitude">
                                            </div>
                                            <div class="mb-3">
                                                <label for="longitude" class="form-label">Longitude :</label>
                                                <input type="text" id="longitude" class="form-control" :value="item.longitude">
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
                this.data = fetch('http://127.0.0.1:8000/api/tour', {
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
