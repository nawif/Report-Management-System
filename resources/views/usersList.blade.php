<!DOCTYPE html>
<html lang="en" >
   <head>
      <meta charset="UTF-8">
      <title>@lang('report.create report')</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </head>
   <body>
      <!-- Navigation -->
      @include('shared.nav')
      <div class="container" style="margin-top: 100px;">
         <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">name</th>
                  <th scope="col">email</th>
                  <th scope="col">Roles</th>
                  <th scope="col">Registered at</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
               <tr>
                  <th scope="row">1</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                     <span class="label label-danger">Admin</span>
                     <span class="label label-primary">Author</span>
                     <span class="label label-success">Viewer</span>
                  </td>
                  <td>{{$user->created_at}}</td>
                  <td>
                     <form style="display:inline-block" method="POST" action="{{url('users/delete/1')}}" accept-charset="UTF-8" >
                        @method("DELETE")
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                     </form>
                     <form style="display:inline-block" method="GET" action="{{url('users/delete/1')}}" accept-charset="UTF-8" >
                        @csrf
                        <button type="submit" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                     </form>
                  </td>
               </tr>
               @endforeach

            </tbody>
         </table>
         <div align="center">
                {{ $users->links() }}
            </div>
      </div>
    </body>
</html>
