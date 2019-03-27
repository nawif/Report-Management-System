<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content={{$reports->title}}>
      <meta name="author" content={{$reports->title}}>
      <title>{{$reports->title}}</title>
      @include('shared.dependencies')

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
                <div class="row" style="margin-left:0px ;margin-top:65px" >
                        @if (Auth::user()->canEdit())
                        <form method="GET" action={{url('report/edit/'.$reports->id)}}>
                            <button type="submit" class="btn btn-primary btn-lg">@lang('report.edit')</button>
                        </form>
                        @endif
                        @if (Auth::user()->canDelete())
                        <form style="margin-left:15px" method="POST" action={{url('report/'.$reports->id)}}>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg">@lang('report.delete')</button>
                        </form>
                        @endif

                </div>

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
