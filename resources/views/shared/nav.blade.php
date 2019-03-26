  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">@lang('report.app name')</a>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href={{url('/report/home')}}>Home
              {{-- <span class="sr-only">(current)</span> --}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{url('/report/create')}}>Create Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{url('/user')}}>Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{url('/group')}}>Groups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Account</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
