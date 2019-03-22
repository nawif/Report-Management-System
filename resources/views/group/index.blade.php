<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@lang('report.create report')</title>
    @include('shared.dependencies')
</head>

<body>
    <!-- Navigation -->
    @include('shared.nav')
    <div class="container" style="margin-top: 100px;">
    @include('shared.alert')
        <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
                <tr>
                    <th scope="col">@lang('user.number')</th>
                    <th scope="col">@lang('user.name')</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                <tr>
                    <th scope="row">{{$group->id}}</th>
                    <td>{{$group->name}}</td>
                    <td>{{$group->created_at}}</td>
                    <td>
                        <form style="display:inline-block" method="POST" action={{url( 'group/'.$group->id)}} accept-charset="UTF-8" > @method("DELETE") @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove"></span> @lang('user.remove')
                        </button>
                        </form>
                        @include('group.editGroupModal')
                        <button type="button" data-toggle="modal" data-target={{ "#".$group->id}} class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> @lang('user.edit roles')
                        </button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div align="center">
            {{ $groups->links() }}
        </div>
    </div>
</body>

</html>
