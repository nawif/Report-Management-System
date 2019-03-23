<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@lang('group.manage groups')</title>
    @include('shared.dependencies')
</head>

<body>
    <!-- Navigation -->
    @include('shared.nav')
    <div class="container" style="margin-top: 100px;">
    @include('shared.alert')

    <button type="button" data-toggle="modal" data-target="#create" class="btn btn-primary">
         @lang('group.create group')
        </button>
        @include('group.createGroupModal')

        <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
                <tr>
                    <th scope="col">@lang('group.group id')</th>
                    <th scope="col">@lang('group.name')</th>
                    <th scope="col">@lang('group.created at')</th>
                    <th scope="col">@lang('group.action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                <tr>
                    <td scope="row">{{$group->id}}</td>
                    <td>{{$group->name}}</td>
                    <td>{{$group->created_at}}</td>
                    <td>
                        <form style="display:inline-block" method="POST" action={{url( 'group/'.$group->id)}} accept-charset="UTF-8" > @method("DELETE") @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to Remove?');" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove"></span> @lang('group.remove')
                        </button>
                        </form>
                        <button type="button" data-toggle="modal" data-target={{ "#".$group->id}} class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> @lang('group.edit')
                        </button>
                        @include('group.editGroupModal')
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
