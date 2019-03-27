  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">@lang('report.app name')</a>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            @if (Auth::user()->canView())
            <li class="nav-item">
                <a class="nav-link" href={{url('/report/home')}}>@lang('nav.home')
                </a>
            </li>
            @endif

          @if (Auth::user()->canCreate())
           <li class="nav-item">
            <a class="nav-link" href={{url('/report/create')}}>@lang('nav.create report')</a>
            </li>
          @endif

          @if (Auth::user()->is_admin)
          <li class="nav-item">
            <a class="nav-link" href={{url('/user')}}>@lang('nav.users')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{url('/group')}}>@lang('nav.groups')</a>
          </li>
          @endif

          @auth
           <li class="nav-item">
            <a class="nav-link" href={{url('/user/me')}}>@lang('nav.edit account')</a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href={{url('/user/logout')}}>@lang('nav.logout')</a>
          </li>
          @endauth


        </ul>
      </div>
    </div>
  </nav>
