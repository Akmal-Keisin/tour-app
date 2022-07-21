<div class="side-nav">
    <div class="brand">
        <router-link to="/admin" class="">
        <img src="../assets/img/logo.png" class="d-block m-auto" alt="logo">
        <h1 class="text-center mt-3">TRAVEL</h1>
        </router-link>
    </div>
    <ul class="side-nav-body">
        <li class="wa-list-item">
        <i class='bx bx-user'></i>
        <router-link class="ms-2" to="/user">User List</router-link>
        </li>
        <li class="wa-list-item">
        <i class='bx bxs-map'></i>
        <router-link class="ms-2" to="/tour">Tour List</router-link>
        </li>
        <li class="wa-list-item">
        <i class='bx bx-spreadsheet' ></i>
        <router-link class="ms-2" to="/category">Category List</router-link>
        </li>
        <li class="wa-list-item">
        <i class='bx bxs-chip'></i>
        <router-link class="ms-2" to="/admin">Admin List</router-link>
        </li>
    </ul>
    <ul class="side-nav-footer">
        <input class="checkbox" type="checkbox" name="" id="" />
        <li class="wa-list-item">
        <i class='bx bx-log-out'></i>
        <a class="ms-2" href="#">Logout</a>
        </li>
        <li>
        <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
        </li>
    </ul>
</div>
