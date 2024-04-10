<nav class="navbar fixed-top navbarstyle">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a class="navbar-brand ms-md-3" href="#">
                <img src="{{ asset('default_image/mantantersakiti.jpeg') }}" alt="kafahome.jpeg" width="45" height="50">
            </a>
            <p class="h4 fw-bold text-dark m-0">Kafa Management System</p>
        </div>
        <div class="d-flex align-items-center">
            <img src="{{ asset('default_image/mantantersakiti.jpeg') }}" alt="profile.png" width="45" height="45" class="rounded-circle me-2">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User Name
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>        
    </div>
</nav>
