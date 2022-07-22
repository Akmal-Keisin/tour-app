@extends('layouts.template')
@section('content')
<script src="https://unpkg.com/vue@3"></script>
    <div id="app">
        <div class="box mx-4 my-3">
            <div class="box-head d-flex justify-content-between py-1">
                <h1 class="text m-0 p-0">Admins List</h1>
                <div class="group">
                    <button class="btn btn-sm wa-btn-danger mx-1"><i class='bx bx-trash'></i></button>
                    <button class="btn btn-sm wa-btn-success mx-1"><i class='bx bx-check-square' ></i></button>
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
                        <td>@{{ item.address }}</td>
                        <td>@{{ item.latitude }}</td>
                        <td>@{{ item.longitude }}</td>
                        <td>
                          <button class="mx-1 btn wa-btn-primary"><i class='bx bx-show-alt'></i></button>
                          <button class="mx-1 btn wa-btn-warning"><i class='bx bx-edit-alt'></i></button>
                          <button class="mx-1 btn wa-btn-danger"><i class='bx bx-trash'></i></button>
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
