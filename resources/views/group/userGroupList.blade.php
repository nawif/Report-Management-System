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
    <div class="container">
    @include('shared.alert')
    <form method="POST" action={{url( 'user/'.$user->id)}} accept-charset="UTF-8" > @csrf @method('PATCH')
        <button type="submit" data-toggle="modal" data-target="#create" class="btn btn-success">
         @lang('group.save')
    </button>

        <table class="table table-hover">
            <!-- TABLE HEADERS -->
            <thead>
                <tr>
                    <th scope="col">@lang('group.group id')</th>
                    <th scope="col">@lang('group.name')</th>
                    <th scope="col">@lang('group.created at')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                <tr>
                    <td scope="row">{{$group->id}}</td>
                    <td>
                        <div class="form-check form-check-inline">
                            <!--Checking if the role is already assigned -->
                            @if ($user->groups()->get()->pluck("pivot")->pluck("group_id")->contains($group->id))
                            <input name="groups[]" class="form-check-input" type="checkbox" checked value={{$group->id}} id={{$group->name}}>
                            @else
                            <input name="groups[]" class="form-check-input" type="checkbox" value={{$group->id}} id={{$group->name}}>
                            @endif
                            <label class="form-check-label" for={{$group->name}}>
                                {{$group->name}}
                            </label>
                            </div>
                    </td>
                    <td>{{$group->created_at}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </form>
        <div style="display: table; margin-right: auto; margin-left: auto;">
                {{ $groups->links() }}
        </div>
    </div>
</body>

</html>
