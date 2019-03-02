<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>@lang('report.create report')</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

        <!-- Navigation -->
      @include('shared.nav')
      <div class="container" style="margin-top: 55px;">
        <form method="post" action="{{url('report/create')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                    <div class="form-group">
                    @include('shared.errorAlertList')
                    <label for="titleInput">@lang('report.title')</label>
                    <input required name="title"  class="form-control" id="titleInput" placeholder="title">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">@lang('report.body')</label>
                        <textarea required name="body" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                            <label for="exampleFormControlSelect1">@lang('report.group')</label>
                            <select required name="group" class="form-control" id="exampleFormControlSelect1">
                                @foreach ($groups as $group)
                            <option value="{{$group->id}}" >{{$group->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">@lang('report.tags')</label>
                        <input name="tags" class="form-control form-control-sm" id="tags" type="text" placeholder="@lang('report.tags hint')">
                        <small id="emailHelp" class="form-text text-muted">@lang('report.tags warning')</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">@lang('report.file upload')</label>
                        <input multiple name="attachment[]" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
        </form>
      </div>
</body>

</html>
