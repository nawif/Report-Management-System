@if(count($reports->multimedia))
<div class="card my-4">
   <h5 class="card-header">@lang('report.files')</h5>
   <div class="card-body">
      <div class="column">
         @foreach ($reports->multimedia as $multimedia)
         <ul class="list-unstyled mb-0">
            <li>
               <a href="{{$multimedia->getURL()}}">{{$multimedia->title}}</a>
            </li>
         </ul>
         @endforeach
      </div>
   </div>
</div>
@endif
