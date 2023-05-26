<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="." class="brand-link text-center">
      <span class="brand-text font-weight"><b>SIGALO</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          @auth
            <a href="#" class="d-block"><b>{{auth()->user()->name}}</b> | Online <i class="fas fa-circle nav-icon" style="color:green"></i></a>
          @else
          <a href="#" class="d-block">Offline <i class="fas fa-circle nav-icon" style="color:red"></i></a>
          @endauth
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!--li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li-->
          <li class="nav-item">
            <a href="{{ route('perfis.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Perfis
                <!--span class="right badge badge-danger">0</span-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('utilizadores.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Utilizadores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('menus.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>