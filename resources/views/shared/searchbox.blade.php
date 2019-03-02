<div class="card my-4">
    <h5 class="card-header">@lang('report.search')</h5>
    <form method="get" action="/report/search">
       @csrf
       <div class="card-body">
          <div class="input-group">
             <input type="text" class="form-control" name="searchVal" placeholder="Search for...">
             <span class="input-group-btn">
             <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
             </span>
          </div>
          <select name="searchBy">
             <option value="author" >@lang('report.author')</option>
             <option value="tag" >@lang('report.tags')</option>
             <option value="content" >@lang('report.report content')</option>
             <option value="title">@lang('report.report name')</option>
             <option value="group" >@lang('report.group')</option>
          </select>
    </form>
    </div>
 </div>
