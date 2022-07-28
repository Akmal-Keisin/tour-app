@extends('layouts.template')
@section('content')
<script src="https://unpkg.com/vue@3"></script>
    <div id="app">
        <div class="box mx-4 my-3">
            <div class="box-head d-flex justify-content-between py-1">
                <h1 class="text m-0 p-0">Category List</h1>
                <div class="group">

                    <button class="btn btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showAdd"><i class='bx bx-list-plus'></i></button>
                            <div class="modal fade" id="showAdd" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" @submit.prevent="addData" id="addForm">
                                        <div class="modal-header">
                                        <h5 class="modal-title text m-0 p-0" id="showModalLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name :</label>
                                                    <input type="text" name="name" id="name" class="form-control">
                                                    <div v-if="validationMsg.name" class="text-danger mt-2">
                                                        @{{ validationMsg.name[0] }}
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
                    <button class="btn btn-sm btn-danger mx-1"><i class='bx bx-trash' ></i></button>
                    <button class="btn btn-sm btn-success mx-1"><i class='bx bx-check-square' ></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="wa-table table table-borderless table-striped align-middle">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Check</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in data">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ item.name }}</td>
                        <td>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showDetail" @click="showDetail(item.id)"><i class="bx bx-show-alt"></i></button>
                            <div class="modal modal fade" id="showDetail" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">Category Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Category Name :</label>
                                        <p>@{{ detailData.name }}</p>
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
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title text m-0 p-0" id="showModalLabel">Category Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name :</label>
                                                    <input type="text" name="name" id="name" class="form-control" :value="detailData.name">
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
                    detailData: {},
                    validationMsg: {}
                }
            },methods: {
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
                    this.newData = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/category', requestOption)
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
                    this.newData = fetch(`https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/category/${itemData.id}`, requestOption)
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
                        this.newData = fetch(`https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/category/${itemData.id}`, requestOption)
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
                this.data = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/category', {
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
                    this.data = json.data
                })
                .catch((error) => {
                    console.log('Error', error)
                })
            }
        }).mount('#app')
    </script>
@endsection
