<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>@lang('report.edit report')</title>
  @include('shared.dependencies')
</head>

<body>

        <!-- Navigation -->
      @include('shared.nav')
      <div class="container" >
          {{-- {{dd($report)}} --}}
        <form method="post" action="{{url('report/edit/'.$report->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
                    <div class="form-group">
                    @include('shared.errorAlertList')
                    <label for="titleInput">@lang('report.title')</label>
                    <input required name="title" value="{{$report->title}}" class="form-control" id="titleInput" placeholder="title">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">@lang('report.body')</label>
                        <textarea required name="body"  class="form-control" id="exampleFormControlTextarea1" rows="15">{{$report->body}}</textarea>
                    </div>

                    <div class="form-group">
                            <label for="exampleFormControlSelect1">@lang('report.group')</label>
                            <select required name="group" class="form-control" id="exampleFormControlSelect1">
                                @foreach (Auth::user()->groups as $group)
                                @if ($group->id == $report->group->id)
                                    <option selected value="{{$group->id}}" >{{$group->name}}</option>
                                @else
                                    <option value="{{$group->id}}" >{{$group->name}}</option>
                                @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">@lang('report.tags')</label>
                    <input name="tags" value="{{$report->tagsToString()}}" class="form-control form-control-sm" id="tags" type="text" placeholder="@lang('report.tags hint')">
                        <small id="emailHelp" class="form-text text-muted">@lang('report.tags warning')</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">@lang('report.file upload')</label>
                        <input multiple name="attachment[]" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
        </form>
      </div>
      @include('shared.footer')
</body>

</html>
