<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>@lang('report.create report')</title>
  @include('shared.dependencies')
</head>

<body>

        <!-- Navigation -->
      @include('shared.nav')
      <div class="container" >
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form method="post" action="{{url('user/me')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
                    <div class="form-group">
                    @include('shared.errorAlertList')
                    <label for="nameInput">@lang('user.name')</label>
                    <input required name="name" value="{{$user->name}}" type="text" class="form-control" id="nameInput" placeholder="Nawaf alquaid">
                    </div>
                    <div class="form-group">
                    <label for="passwordInput">@lang('user.password')</label>
                    <input required name="password" type="password" placeholder="***********"  class="form-control" id="passwordInput">
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('user.submit changes')</button>
        </form>
      </div>
      @include('shared.footer')
</body>

</html>
