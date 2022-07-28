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
                                                    <div v-if="validationMsg.name" class="text-danger mt-2">
                                                        @{{ validationMsg.name[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category" class="form-label">category :</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option v-for="category in categories" :value="category.id">@{{ category.name }}</option>
                                                    </select>
                                                    <div v-if="validationMsg.category_id" class="text-danger mt-2">
                                                        @{{ validationMsg.category_id[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="information" class="form-label">Information :</label>
                                                    <textarea name="information" id="information" cols="30" rows="5" class="form-control"></textarea>
                                                    <div v-if="validationMsg.information" class="text-danger mt-2">
                                                        @{{ validationMsg.information[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address :</label>
                                                    <textarea name="address" id="address"  cols="30" rows="5" class="form-control"></textarea>
                                                    <div v-if="validationMsg.address" class="text-danger mt-2">
                                                        @{{ validationMsg.address[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="latitude" class="form-label">Latitude :</label>
                                                    <input type="text" class="form-control"  name="latitude" id="latitde">
                                                    <div v-if="validationMsg.latitude" class="text-danger mt-2">
                                                        @{{ validationMsg.latitude[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="longitude" class="form-label">Longitude :</label>
                                                    <input type="text" class="form-control"  name="longitude" id="latitde">
                                                    <div v-if="validationMsg.longitude" class="text-danger mt-2">
                                                        @{{ validationMsg.longitude[0] }}
                                                    </div>
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
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.category_id }}</td>
                        <td>@{{ (item.information.length > 15) ? item.information.substr(0,15) + '...' : item.information }}</td>
                        <td>@{{ (item.address.length > 15) ? item.address.substr(0,15) + '...' : item.address }}</td>
                        <td>@{{ (item.latitude.length > 15) ? item.latitude.substr(0,15) + '...' : item.latitude }}</td>
                        <td>@{{ (item.longitude.length > 15) ? item.longitude.substr(0,15) + '...' : item.longitude }}</td>
                        <td>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showDetail" @click="showDetail(item.id)"><i class="bx bx-show-alt"></i></button>
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
                                                <img :src="detailData.image" class="rounded-circle w-75" alt="Image">
                                            </div>
                                            <div class="col-8">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pe-3 key">Nama</td>
                                                            <td class="ps-3">@{{ detailData.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Category</td>
                                                            <td class="ps-3">@{{ detailData.category_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Information</td>
                                                            <td class="ps-3">@{{ detailData.information }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Address</td>
                                                            <td class="ps-3">@{{ detailData.address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Latitude</td>
                                                            <td class="ps-3">@{{ detailData.latitude }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Longitude</td>
                                                            <td class="ps-3">@{{ detailData.longitude }}</td>
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
                            <button class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#showEdit" @click="showDetail(item.id)"><i class="bx bx-edit-alt"></i></button>
                            <div class="modal fade" id="showEdit" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" id="editForm" @submit.prevent="editData(detailData)">
                                        @method("PUT")
                                        <div class="modal-header">
                                        <h5 class="modal-title text m-0 p-0" id="showModalLabel">Tour Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image :</label>
                                                    <input type="file" id="image" name="image" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name :</label>
                                                    <input type="text" id="name" name="name" class="form-control" :value="detailData.name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_number" class="form-label">Category :</label>
                                                    <select name="category_id" name="category_id" class="form-control" id="category_id">
                                                        <option v-for="category in categories" :value="category.id">@{{ category.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="information" class="form-label">Information :</label>
                                                    <textarea name="information" id="information" cols="30" rows="5" class="form-control">@{{ detailData.information }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address :</label>
                                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">@{{ detailData.address }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="latitude" class="form-label">Latitude :</label>
                                                    <input type="text" id="latitude" name="latitude" class="form-control" :value="detailData.latitude">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="longitude" class="form-label">Longitude :</label>
                                                    <input type="text" id="longitude" name="longitude" class="form-control" :value="detailData.longitude">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Save Changes</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <form action="" id="deleteForm" @submit.prevent="deleteData(detailData)" class="d-inline-block">
                                @method('DELETE')
                                <button type="submit" class="mx-1 btn btn-danger" @click="showDetail(item.id)"><i class='bx bx-trash'></i></button>
                            </form>
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
                    categories: [],
                    detailData: {},
                    validationMsg: {}
                }
            },
            methods: {
                showDetail(id) {
                    const index = this.data.findIndex(item => item.id == id)
                    this.detailData = this.data[index]
                },
                addData() {
                    // save form data to variable
                    let formData = new FormData(addForm)

                    // create header
                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);

                    // create request
                    let requestOption = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formData

                    }

                    // create new data
                    this.newData = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/tour', requestOption)
                    .then((response) => {
                        return response.json()
                    })
                    .then((json) => {
                    if (json.status == 401) {
                        alert('Anda tidak terautentikasi')
                        window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                    }
                    if (json.info == "Validation Error") {
                        // send validation data
                        this.validationMsg = json.data
                        return
                    }
                    this.data.push(json.data)
                    var myModalEl = document.getElementById('showAdd');
                    var modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();

                    this.validationMsg = {}
                    document.getElementById('addForm').reset()
                    return alert('Data Berhasil Ditambahkan')
                    })
                },
                editData(itemData) {
                    let formData = new FormData(document.getElementById('editForm'))
                    // let formData = new FormData(editForm)
                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);


                    let requestOption = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formData
                    }
                    this.newData = fetch(`https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/tour/${itemData.id}`, requestOption)
                    .then((response) => {
                        // convert response
                        return response.json()
                    })
                    .then((json) => {
                        if (json.status == 401) {
                            alert('Anda tidak terautentikasi')
                            window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                        }
                        if (json.info == "Validation Error") {
                            // send validation data
                            this.validationMsg = json.data
                            return
                        }

                        // find data from list data and update
                        const index = this.data.findIndex(item => item.id == itemData.id)
                        this.data[index] = json.data

                        // close modal
                        var myModalEl = document.getElementById('showEdit')
                        var modal = bootstrap.Modal.getInstance(myModalEl)
                        modal.hide();

                        this.validationMsg = {}
                        document.getElementById('addForm').reset()
                        return alert("Data Berhasil Diupdate")

                    })
                    .catch((err) => {
                        alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                        console.log(err)
                    })
                },
                deleteData(itemData) {
                    let check = confirm('Are You Sure?')
                    if (check) {
                        let formData = new FormData(document.getElementById('deleteForm'))
                        var myHeaders = new Headers();
                        myHeaders.append("Accept", "application/json");
                        myHeaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);

                        let requestOption = {
                            method: 'POST',
                            headers: myHeaders,
                            body: formData
                        }
                        this.newData = fetch(`https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/tour/${itemData.id}`, requestOption)
                        .then((response) => {
                            // convert response
                            return response.json()
                        })
                        .then((json) => {
                            if (json.status == 401) {
                                alert('Anda tidak terautentikasi')
                                window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                            }
                            if (json.info == "Data Not Found") {
                                // send validation data
                                return alert('Data Not Found')
                            }
                            this.data = this.data.filter((t) => t !== itemData)
                            alert('Data Berhasil Dihapus')
                        })
                        .catch((err) => {
                            alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                            console.log(err)
                        })
                        return
                    }
                },
                clearValidationMsg() {
                    this.validationMsg = {}
                }
            },
            beforeMount() {
                this.data = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/tour', {
                    method: 'get',
                    headers: {
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then((response) => {
                    return response.json()
                })
                .then((json) => {
                    if (json.status == 401) {
                        window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                    }
                    this.data = json.data
                })
                .catch((error) => {
                    console.log('Error', error)
                })

                this.categories = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/category', {
                    method: 'get',
                    headers: {
                        'Content-Type': 'Application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then((response) => {
                    return response.json()
                })
                .then((json) => {
                    if (json.status == 401) {
                        alert('Anda tidak terautentikasi')
                        window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                    }
                    this.categories = json.data
                })
                .catch((error) => {
                    console.log('Error', error)
                })
            }
        }).mount('#app')
    </script>
@endsection
