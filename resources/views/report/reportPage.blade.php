<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Post - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-post.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$reports['title']}}</h1>

        <!-- Author -->
        <p class="lead">
        @lang('report.by')
          <a href="#">{{$reports['author']['name']}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>@lang('report.posted on') {{$reports['updated_at']}}</p>

        <!-- Preview Image -->
        @isset($reports['thumbnail'])
            <hr>
            <img class="img-fluid rounded" height="400" width="400" src="{{$reports['thumbnail']['url']}}" alt="thumbnail">
        @endisset

        <hr>
        <!-- Post Content -->
        <p class="lead">{{$reports['body']}}</p>
        <hr>

        </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">@lang('report.search')</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="@lang('report.search placeholder')">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Tags</h5>
          <div class="card-body">
            <div class="row">
              @for ($i = 0; $i < count($reports['tags']); $i+=2)
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">{{$reports['tags'][$i]['name']}}</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                      <li>
                          @if (count($reports['tags'])>$i+1 )
                              <a href="#">{{$reports['tags'][$i+1]['name']}}</a>
                          @endif
                      </li>
                  </ul>
                </div>
              @endfor
             </div>
            </div>
        </div>

        <!-- Side Widget -->
        {{-- @isset($report['multimedia']) --}}
            <div class="card my-4">
            <h5 class="card-header">files attached</h5>
            <div class="card-body">
                <div class="column">
                    @foreach ($reports['multimedia'] as $multimedia)
                    <ul class="list-unstyled mb-0">
                        <li>
                        <a href="{{$multimedia['url']}}">{{$multimedia['title']}}</a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
            </div>
        {{-- @endisset --}}

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>


</body>

</html>
