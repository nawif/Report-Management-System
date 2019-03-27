<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>@lang('report.app name')</title>
      <!-- Bootstrap core CSS -->
        @include('shared.dependencies')
      <!-- Custom styles for this template -->

   </head>
   <body>
      <!-- Navigation -->
      @include('shared.nav')
      <!-- Page Content -->
      <div class="container">
      @include('shared.alert')
         <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <br>
               <!-- Blog Post -->
               @if(count($reports)==0)
                   <h1>@lang('report.no report')</h1>
               @endif
               @foreach ($reports as $report)
               <div class="card mb-4">
                  @if($report->getThumbnail())
                  <img id="thumbnail" class="thumb" src={{$report->getThumbnail()}} alt="Card image cap"> @endif
                  <div class="card-body">
                     <h2 class="card-title">{{$report->title}}</h2>
                     <p class="card-text">{{str_limit($report->body,200)}}</p>
                     <a href="{{ url('/report/view/' . $report->id) }}" class="btn btn-primary">Read More &rarr;</a>
                  </div>
                  <div class="card-footer text-muted">
                      @lang('report.posted on',['date' => $report->created_at])
                     <a href="{{ url('/report/author/'.str_replace(' ','-',$report->author->name))}}">{{$report->author->name}}</a>
                  </div>
               </div>
               @endforeach
               <!-- Pagination -->
               {{$reports->links()}}
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                @include('shared.searchbox')
            </div>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- Footer -->
      @include('shared.footer')
         <!-- /.container -->
   </body>
</html>
