<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Home - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">

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
  @include('shared.alert')


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <br>
        <!-- Blog Post -->
        @foreach ($reports as $report)
            <div class="card mb-4">
            @isset($report['thumbnail'])
                <img id="thumbnail" class="thumb" src={{$report['thumbnail']['url']}} alt="Card image cap">
            @endisset

            <div class="card-body">
                <h2 class="card-title">{{$report['title']}}</h2>
                <p class="card-text">{{str_limit($report['body'],200)}}</p>
                <a href="{{ url('/report/view/' . $report['id']) }}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$report['created_at']}} by
                <a href="{{ url('/report/author/'.$report['author']['name'])}}">{{$report['author']['name']}}</a>
            </div>
            </div>
        @endforeach

        <!-- Pagination -->
        {{$reports->links()}}
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">@lang('report.search')</h5>
          <form method="get" action="/report/search">
            @csrf
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" name="searchVal" placeholder="Search for...">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
            </span>
            </div>
            <select name="searchBy" >
                <option value="author" >@lang('report.author')</option>
                <option value="tag" >@lang('report.tags')</option>
                <option value="content" >@lang('report.report content')</option>
                <option value="title">@lang('report.report name')</option>
                <option value="group" >@lang('report.group')</option>
            </select>
          </form>
          </div>
        </div>

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

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
