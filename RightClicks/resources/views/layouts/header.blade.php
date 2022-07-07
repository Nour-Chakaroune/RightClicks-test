<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/dashboard" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" title="Full screen" data-widget="fullscreen" href="#" role="button">
            <box-icon name='expand'></box-icon>
          </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" title="Logout"  data-toggle="modal" data-target="#logout">
          <box-icon name='log-out'></box-icon>
        </a>
        </li>
      </ul>
    </nav>
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          Are you sure you want logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <a href="/signout" type="button" class="btn btn-danger">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar mt-1">
        <!-- Sidebar user (optional) -->

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                 <li class="nav-item">
                  <a href="/dashboard" class="nav-link  @if(Route::currentRouteName()=='dashboard') active @endif"">
                    <i class="fas fa-chart-line"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                @if (Auth::User()->role =='Admin')
                <li class="nav-item">
                    <a href="/register/user" class="nav-link  @if(Route::currentRouteName()=='registeruser') active @endif"">
                      <i class="fas fa-user-plus"></i>
                      <p>
                        Registration
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/list/users" class="nav-link  @if(Route::currentRouteName()=='listusers') active @endif"">
                      <i class="fas fa-users"></i>
                      <p>
                        Users
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/list/departments" class="nav-link  @if(Route::currentRouteName()=='listDepartment') active @endif"">
                      <i class="fas fa-boxes"></i>
                      <p>
                        Departments
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/list/tasks" class="nav-link  @if(Route::currentRouteName()=='listTask') active @endif"">
                      <i class="fas fa-tasks"></i>
                      <p>
                        Tasks
                      </p>
                      <span class="right badge bg-gradient-primary badge-primary text-white">{{ DB::table('tasks')->count() }}</span>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="/assign/task" class="nav-link  @if(Route::currentRouteName()=='assigntask') active @endif"">
                      <i class="fas fa-plus-circle"></i>
                      <p>
                        Assign Task
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/pending/task" class="nav-link  @if(Route::currentRouteName()=='pendingtask') active @endif"">
                        <i class="far fa-pause-circle"></i>
                      <p>
                        Pending Task
                      </p>
                    </a>
                  </li>
                @endif
                @if (Auth::User()->role =='User')
                <li class="nav-item">
                    <a href="/account/user" class="nav-link  @if(Route::currentRouteName()=='accountuser') active @endif"">
                        <i class="fas fa-user-edit"></i>
                      <p>
                        Account
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/user/task" class="nav-link  @if(Route::currentRouteName()=='usertask') active @endif"">
                        <i class="fas fa-tasks"></i>
                      <p>
                        User Tasks
                      </p>
                    </a>
                  </li>
                @endif
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>

    </aside>

