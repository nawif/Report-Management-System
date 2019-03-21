
<div class="modal fade" id={{$user->id}} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <form style="display:inline-block" method="POST" action={{url('users/'.$user->id)}} accept-charset="UTF-8" >
                @csrf
                @method('PATCH')
        <h5 class="modal-title" id="exampleModalLabel">@lang('user.edit user roles',['name' => $user->name])</h5>
      </div>
      <div class="modal-body">
                <div class="form-group">
                @foreach ($roles as $role)
                @if ($user->roles()->get()->pluck("pivot")->pluck("role_id")->contains($role->id)) <!--Checking if the role is already assigned -->
                    <input name="roles[]" class="form-check-input" type="checkbox" checked value={{$role->id}} id={{$role->name}}>
                @else
                    <input name="roles[]" class="form-check-input" type="checkbox" value={{$role->id}} id={{$role->name}}>
                @endif
                <label class="form-check-label" for={{$role->name}}>
                  {{$role->name}}
                </label>
                <br>
                @endforeach
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
