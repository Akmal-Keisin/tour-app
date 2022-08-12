<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">TRAVEL</span>
                <span class="profession">Dashboard</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <form action="">
                    <input type="text" name="search" placeholder="Search..." id="searchBox">
                </form>
            </li>

            <ul class="menu-links m-0 p-0">
                <li class="nav-link {{ Request::is('admin*') ? 'link-active' : '' }}">
                    <a href="{{ url('/admin') }}">
                        <i class='bx bx-chip icon' ></i>
                        <span class="text nav-text">Admins</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('user*') ? 'link-active' : '' }}">
                    <a href="{{ url('/user') }}">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">Users</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('tour*') ? 'link-active' : '' }}">
                    <a href="{{ url('/tour') }}">
                        <i class='bx bx-map icon'></i>
                        <span class="text nav-text">Tours</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('category*') ? 'link-active' : '' }}">
                    <a href="{{ url('/category') }}">
                        <i class='bx bx-list-ul icon' ></i>
                        <span class="text nav-text">Categories</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content" id="logoutApp">
            <li class="nav-link">
                <form @submit.prevent="logout" class="d-block w-100 h-100" id="logoutForm">
                    <button type="submit" class=" border-0">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </button>
                </form>
            </li>

            {{-- <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                {{-- <div class="toggle-switch">
                    <span class="switch"></span>
                </div> --}}
            {{-- </li> --}}
        </div>
    </div>
</nav>

<section class="home">
    @yield('content')
</section>

<script>
    createApp({
            data() {
                return {
                }
            },
            methods: {
                logout() {
                    // create header
                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
                    // create request
                    let requestOption = {
                        method: 'POST',
                        headers: myHeaders,

                    }

                    // create new data
                    this.newData = fetch('https://magang.crocodic.net/ki/kelompok_3/tour-app/public/api/auth-logout-admin', requestOption)
                    .then((response) => {
                        return response.json()
                    })
                    .then((json) => {
                    if (json.status == 401) {
                        alert('Anda tidak terautentikasi')
                        window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                    }
                    localStorage.removeItem('token')
                    window.location = 'https://magang.crocodic.net/ki/kelompok_3/tour-app/public/auth/login'
                    return alert('Anda berhasil logout')
                    })
                }
            }
        }).mount('#logoutApp')


    const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click" , () =>{
        sidebar.classList.toggle("close");
    })

    searchBtn.addEventListener("click" , () =>{
        sidebar.classList.remove("close");
    })

//     modeSwitch.addEventListener("click" , () =>{
//         body.classList.toggle("dark");
//
//         if(body.classList.contains("dark")){
//             modeText.innerText = "Light mode";
//         }else{
//             modeText.innerText = "Dark mode";
//
//         }
//     });
</script>
