<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content={{$reports->title}}>
      <meta name="author" content={{$reports->title}}>
      <title>{{$reports->title}}</title>
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/blog-post.css') }}" rel="stylesheet">
   </head>
   <body>
      <!-- Navigation -->
      @include('shared.nav')
      <!-- Page Content -->
      <div class="container">
         <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
               <!-- Title -->
               <h1 class="mt-4">{{$reports->title}}</h1>
               <!-- Author -->
               <p class="lead">
                  @lang('report.by')
                  <a href="{{ url('/report/author/'.str_replace(' ','-',$reports->author->name))}}">{{$reports->author->name}}</a>
               </p>
               <hr>
               <!-- Date/Time -->
               <p>@lang('report.posted on',['date' => $reports->updated_at]) </p>
               <!-- Preview Image -->

               @if($reports->getThumbnail())
               <hr>
               <img class="img-fluid rounded" height="400" width="400" src="{{$reports->getThumbnail()}}" alt="thumbnail">
               @endif
               <hr>
               <!-- Post Content -->
               <p class="lead">{{$reports->body}}</p>
               <hr>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
               <!-- Search Widget -->
               @include('shared.searchbox')
               <!-- Tags Widget -->
               @include('shared.tagsContainer')
               <!-- Side Widget -->
               @include('shared.multimediaList')
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- Footer -->
      @include('shared.footer')

   </body>
</html>
