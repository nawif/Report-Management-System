<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title}}</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
    @include('shared.nav')

  <!-- Page Content -->
  <div class="container">
        <p class="h1">{{$title.":"}}</p>
        @if(is_array($list) || is_object($list))
        <div class="row ">
            @foreach ($list as $item)
            <div class="col-4"> <a href={{ url('report/'.$title.'/'.str_replace(' ','-',$item['name'])) }}>{{$item["name"]}}</a> </div>

            @endforeach
        </div>
        @else
        <blockquote class="blockquote text-center">
            <p class="h1">@lang('report.nothing found') </p>
        </blockquote>
        @endif
        <!-- /.row -->
  </div>
  <!-- /.container -->





</body>

</html>
