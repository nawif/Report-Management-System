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
      @include('shared.alert')
      <div class="container" style="margin-top: 100px;">
         <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">name</th>
                  <th scope="col">email</th>
                  <th scope="col">Account Type</th>
                  <th scope="col">Registered at</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
               <tr>
               <th scope="row">{{$user->id}}</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                      @if ($user->is_admin)
                        <span class="label label-danger">Admin</span>
                      @else
                        <span class="label label-primary">User</span>
                      @endif
                  </td>
                  <td>{{$user->created_at}}</td>
                  <td>
                     <form style="display:inline-block" method="POST" action={{url('users/delete/'.$user->id)}} accept-charset="UTF-8" >
                        @method("DELETE")
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                     </form>
                        @include('editUsersModal')
                        <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Edit Roles
                        </button>
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
