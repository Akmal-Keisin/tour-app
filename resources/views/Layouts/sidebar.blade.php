
<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </span>

            <div class="text logo-text">
                <span class="name">TRAVEL</span>
                <span class="profession">Web developer</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
        <div class="menu">

            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
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

        <div class="bottom-content">
            <li class="">
                <a href="#">
                    <i class='bx bx-log-out icon' ></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>

            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>

                {{-- <div class="toggle-switch">
                    <span class="switch"></span>
                </div> --}}
            </li>

        </div>
    </div>
</nav>

<section class="home">
    @yield('content')
</section>

<script>
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
