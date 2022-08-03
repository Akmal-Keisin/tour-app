@extends('layouts.template')
@section('content')
<div class="lds-facebook d-none" id="loader">
    <div class="cover">
        <div class="load-item"></div>
        <div class="load-item"></div>
        <div class="load-item"></div>
    </div>
</div>
    <div id="app">
        <div class="box mx-4 my-3">
            <div class="box-head d-flex justify-content-between py-1">
                <h1 class="text m-0 p-0">Users List</h1>
                <div class="group">
                    <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#showAdd"><i class='bx bx-user-plus'></i></button>
                            <div class="modal fade" id="showAdd" tabindex="-1" aria-labelledby="#showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" @submit.prevent="addData" id="addForm">
                                        <div class="modal-header">
                                        <h5 class="modal-title text m-0 p-0" id="showModalLabel">Add User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
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
                                                    <label for="phone_number" class="form-label">Phone Number :</label>
                                                    <input type="text" name="phone_number" class="form-control" id="phone_number">
                                                    <div v-if="validationMsg.phone_number" class="text-danger mt-2">
                                                        @{{ validationMsg.phone_number[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password :</label>
                                                    <input type="password" name="password" class="form-control" id="password">
                                                    <div v-if="validationMsg.password" class="text-danger mt-2">
                                                        @{{ validationMsg.password[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password_confirm" class="form-label">Password Confirmation :</label>
                                                    <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                                                    <div v-if="validationMsg.password_confirm" class="text-danger mt-2">
                                                        @{{ validationMsg.password_confirm[0] }}
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
                        <td>User</td>
                        <td>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#showDetail" @click="showDetail(item.id)"><i class="bx bx-show-alt"></i></button>
                            <div class="modal modal-lg fade" id="showDetail" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text m-0 p-0" id="showModalLabel">User Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-4">
                                                <img :src="detailData.image" class="rounded-circle w-75" alt="Avatar">
                                            </div>
                                            <div class="col-8">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="pe-3 key">Nama</td>
                                                            <td class="ps-3">@{{ detailData.name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Phone Number</td>
                                                            <td class="ps-3">@{{ detailData.phone_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-3 key">Role</td>
                                                            <td class="ps-3">user</td>
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
                                        @method('PUT')
                                        <div class="modal-header">
                                        <h5 class="modal-title text m-0 p-0" id="showModalLabel">User Edit</h5>
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
                                                    <div v-if="validationMsg.name" class="text-danger mt-2">
                                                        @{{ validationMsg.name[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_number" class="form-label">Phone Number :</label>
                                                    <input type="text" class="form-control" name="phone_number" id="phone_number" :value="detailData.phone_number">
                                                    <div v-if="validationMsg.phone_number" class="text-danger mt-2">
                                                        @{{ validationMsg.phone_number[0] }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password :</label>
                                                    <input type="password" class="form-control" name="password" id="password" :value="detailData.password">
                                                    <div v-if="validationMsg.password" class="text-danger mt-2">
                                                        @{{ validationMsg.password[0] }}
                                                    </div>
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
            },
            methods: {
                showDetail(id) {
                    const index = this.data.findIndex(item => item.id == id)
                    this.detailData = this.data[index]
                },
                addData() {
                    document.getElementById('loader').classList.remove('d-none')
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
                    this.newData = fetch('http://127.0.0.1:8000/api/user', requestOption)
                    .then((response) => {
                        return response.json()
                    })
                    .then((json) => {
                    if (json.status == 401) {
                        document.getElementById('loader').classList.add('d-none')
                        alert('Anda tidak terautentikasi')
                        window.location = 'http://127.0.0.1:8000/auth/login'
                    }
                    if (json.info == "Validation Error") {
                        document.getElementById('loader').classList.add('d-none')
                        // send validation data
                        this.validationMsg = json.data
                        return
                    }
                    document.getElementById('loader').classList.add('d-none')
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
                    document.getElementById('loader').classList.remove('d-none')
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
                    this.newData = fetch(`http://127.0.0.1:8000/api/user/${itemData.id}`, requestOption)
                    .then((response) => {
                        // convert response
                        return response.json()
                    })
                    .then((json) => {
                        if (json.status == 401) {
                            document.getElementById('loader').classList.add('d-none')
                            alert('Anda tidak terautentikasi')
                            window.location = 'http://127.0.0.1:8000/auth/login'
                        }
                        if (json.info == "Validation Error") {
                            document.getElementById('loader').classList.add('d-none')
                            // send validation data
                            this.validationMsg = json.data
                            return
                        }

                        document.getElementById('loader').classList.add('d-none')
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
                        document.getElementById('loader').classList.add('d-none')
                        alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                        console.log(err)
                    })
                },
                deleteData(itemData) {
                    let check = confirm('Are You Sure?')
                    if (check) {
                        document.getElementById('loader').classList.remove('d-none')
                        let formData = new FormData(document.getElementById('deleteForm'))
                        var myHeaders = new Headers();
                        myHeaders.append("Accept", "application/json");
                        myHeaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);

                        let requestOption = {
                            method: 'POST',
                            headers: myHeaders,
                            body: formData
                        }
                        this.newData = fetch(`http://127.0.0.1:8000/api/user/${itemData.id}`, requestOption)
                        .then((response) => {
                            // convert response
                            return response.json()
                        })
                        .then((json) => {
                            if (json.status == 401) {
                                document.getElementById('loader').classList.add('d-none')
                                alert('Anda tidak terautentikasi')
                                window.location = 'http://127.0.0.1:8000/auth/login'
                            }
                            if (json.info == "Data Not Found") {
                                document.getElementById('loader').classList.add('d-none')
                                // send validation data
                                return alert('Data Not Found')
                            }
                            document.getElementById('loader').classList.add('d-none')
                            this.data = this.data.filter((t) => t !== itemData)
                            alert('Data Berhasil Dihapus')
                        })
                        .catch((err) => {
                            document.getElementById('loader').classList.add('d-none')
                            alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                            console.log(err)
                        })
                        return
                    }
                }
            },
            beforeMount() {
                document.getElementById('loader').classList.remove('d-none')
                this.data = fetch('http://127.0.0.1:8000/api/user', {
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
                        document.getElementById('loader').classList.add('d-none')
                        alert('Anda tidak terautentikasi')
                        window.location = 'http://127.0.0.1:8000/auth/login'
                    }
                    document.getElementById('loader').classList.add('d-none')
                    this.data = json.data
                })
                .catch((error) => {
                    document.getElementById('loader').classList.add('d-none')
                    alert('Ups, ada kesalahan sistem. Kami akan memperbaikinya secepat mungkin')
                    console.log('Error', error)
                })
            }
        }).mount('#app')
    </script>
@endsection
