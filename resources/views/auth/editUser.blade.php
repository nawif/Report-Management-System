<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>@lang('user.profile page')</title>
  @include('shared.dependencies')
</head>

<body>

        <!-- Navigation -->
      @include('shared.nav')
      <div class="container" >
        <form method="post" action="{{url('user/me')}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
                    <div class="form-group">
                        @include('shared.errorAlertList')
                        <label for="nameInput">@lang('user.name')</label>
                        <input required name="name" value="{{$user->name}}" type="text" class="form-control" id="nameInput" placeholder="Nawaf alquaid">
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">@lang('user.password1')</label>
                        <input  name="password" type="password" placeholder="***********"  class="form-control" id="passwordInput">
                    </div>
                    <div class="form-group">
                        <label for="passwordInput2">@lang('user.password2')</label>
                        <input  name="password_confirmation" type="password" placeholder="***********"  class="form-control" id="passwordInput2">
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('user.submit changes')</button>
        </form>
      </div>
      @include('shared.footer')
</body>

</html>
