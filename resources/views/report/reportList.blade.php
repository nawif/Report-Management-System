<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Blog Home - Start Bootstrap Template</title>
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
         crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">
   </head>
   <body>
      <!-- Navigation -->
      @include('shared.nav')
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
                  <img id="thumbnail" class="thumb" src={{$report[ 'thumbnail'][ 'url']}} alt="Card image cap"> @endisset
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
                @include('shared.searchbox')
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
