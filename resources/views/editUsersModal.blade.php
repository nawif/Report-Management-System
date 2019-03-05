
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form style="display:inline-block" method="POST" action={{url('users/update/'.$user->id)}} accept-charset="UTF-8" >
                @csrf
                @method('PATCH')
                <div class="form-group">
                @foreach ($roles as $role)
                @if ($user->roles()->get()->pluck("pivot")->pluck("role_id")->contains($role->id))
                    <input class="form-check-input" type="checkbox" checked value={{$role->id}} id={{$role->name}}>
                @else
                    <input class="form-check-input" type="checkbox" value={{$role->id}} id={{$role->name}}>
                @endif
                <label class="form-check-label" for={{$role->name}}>
                  {{$role->name}}
                </label>
                <br>
                @endforeach
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
    </form>

      </div>
    </div>
  </div>
</div>
