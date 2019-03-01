@isset($alert)
@switch($alert['type'])
    @case("success")
    <div class="alert alert-success" role="alert">
        @break
    @case("danger")
    <div class="alert alert-danger" role="alert">
        @break
    @case("danger")
      <div class="alert alert-warning" role="alert">
      @break
    @default
    <div class="alert alert-info" role="alert">
@endswitch
{{$alert['message']}}
</div>
@endisset
