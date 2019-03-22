<div class="modal fade" id={{$group->
    id}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form style="display:inline-block" method="POST" action={{url( 'group/'.$group->id)}} accept-charset="UTF-8" > @csrf @method('PATCH')
                    <h5 class="modal-title" id="exampleModalLabel">@lang('user.edit user roles',['name' => $group->name])</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Group name</span>
                        </div>
                        <input required name="group_name" value={{$group->name}} type="text" class="form-control" aria-describedby="basic-addon1">
                    </div>


                    <h5>Users in group</h5>
                    <select name="users[]" multiple data-live-search="true">
                        @foreach ($users as $user)
                        @if ($user->groups()->get()->pluck("pivot")->pluck("group_id")->contains($group->id)) <!--Checking if the role is already assigned -->
                            <option value={{$user->id}} selected>{{$user->name}}</option>
                        @else
                            <option value={{$user->id}} >{{$user->name}}</option>
                        @endif
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('user.edit roles cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('user.edit roles submit')</button>
                </form>

            </div>
        </div>
    </div>
</div>
