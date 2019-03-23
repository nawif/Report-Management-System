<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@lang('user.users list')</title>
    @include('shared.dependencies')
</head>

<body>
    <!-- Navigation -->
    @include('shared.nav')
    <div class="container">
        @include('shared.alert')
        <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
                <tr>
                    <th scope="col">@lang('user.number')</th>
                    <th scope="col">@lang('user.name')</th>
                    <th scope="col">@lang('user.email')</th>
                    <th scope="col">@lang('user.account type')</th>
                    <th scope="col">@lang('user.registered at')</th>
                    <th scope="col">@lang('user.action')</th>
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
                            <span class="label label-danger">@lang('user.admin')</span>
                        @else
                            <span class="label label-primary">@lang('user.user')</span>
                        @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <form style="display:inline-block" method="POST" action={{url( 'user/'.$user->id)}} accept-charset="UTF-8" > @method("DELETE") @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-remove"></span> @lang('user.remove')
                                </button>
                        </form>
                        @include('user.editUsersModal')
                        <button type="button" data-toggle="modal" data-target={{ "#".$user->id}} class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-edit"></span> @lang('user.edit roles')
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display: table; margin-right: auto; margin-left: auto;">
            {{ $users->links() }}
        </div>
    </div>
</body>

</html>
