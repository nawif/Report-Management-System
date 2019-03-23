<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form style="display:inline-block" method="POST" action={{url( 'group/create')}} accept-charset="UTF-8">
                    @csrf
                    <h5 class="modal-title" id="exampleModalLabel">@lang('group.create group')</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@lang('group.name')</span>
                        </div>
                        <input required name="group_name" type="text" class="form-control" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('group.edit group cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('group.edit group submit')</button>
                </form>

            </div>
        </div>
    </div>
</div>
