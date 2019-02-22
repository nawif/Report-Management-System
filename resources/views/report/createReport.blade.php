<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>@lang('report.create report')</title>
</head>

<body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <form method="post" action="{{url('report/create')}}" accept-charset="UTF-8">
        @csrf
                <div class="form-group">
                  <label for="titleInput">@lang('report.title')</label>
                  <input name="title"  class="form-control" id="titleInput" placeholder="title">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">@lang('report.body')</label>
                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>

                <div class="form-group">
                        <label for="exampleFormControlSelect1">@lang('report.group')</label>
                        <select name="group" class="form-control" id="exampleFormControlSelect1">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="tags">@lang('report.tags')</label>
                    <input name="tags" class="form-control form-control-sm" id="tags" type="text" placeholder="@lang('report.tags hint')">
                    <small id="emailHelp" class="form-text text-muted">@lang('report.tags warning')</small>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">@lang('report.file upload')</label>
                    <input name="files" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>

                <button type="submit" class="btn btn-primary">@lang('report.submit')</button>
</body>

</html>
