<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$title}}</title>

  @include('shared.dependencies')

</head>

<body>

  <!-- Navigation -->
    @include('shared.nav')

  <!-- Page Content -->
  <div class="container">
        <p class="h1">{{$title.":"}}</p>
        @if($list)
        <div class="row ">
            @foreach ($list as $item)
            <div class="col-4"> <a href={{ url('report/'.$title.'/'.str_replace(' ','-',$item->name)) }}>{{$item->name}}</a> </div>

            @endforeach
        </div>
        @else
        <blockquote class="blockquote text-center">
            <p class="h1">@lang('report.nothing found') </p>
        </blockquote>
        @endif
        <!-- /.row -->
                       <!-- Pagination -->
                    {{ $list->appends(['searchVal' => app('request')->input('searchVal'), 'searchBy' => app('request')->input('searchBy')])->links() }}
        </div>
  <!-- /.container -->





</body>

</html>
