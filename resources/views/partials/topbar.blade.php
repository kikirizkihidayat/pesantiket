
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow align-text-center">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-outline-primary btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
        <div class="sidebar-brand-text mx-3 d-md-none ps-0">pesanTiket</div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span id="userName" class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

<script>
    $( document ).ready(function() {
        id = $('#sessionId').val();            
        axios.get("master-user", {
          params : {
            id : id
          }
        }).then(resp => {          
          dataUser = resp.data[0];
          name = dataUser['name'];
          $('#userName').html(name);
        }).catch(err => {
            alert('error');
        })
    });
</script>
