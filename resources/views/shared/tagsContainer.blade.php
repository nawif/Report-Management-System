<div class="card my-4">
    <h5 class="card-header">Tags</h5>
    <div class="card-body">
       <div class="row">
          @for ($i = 0; $i < count($reports['tags']); $i+=2)
          <div class="col-lg-6">
             <ul class="list-unstyled mb-0">
                <li>
                   <a href="#">{{$reports['tags'][$i]['name']}}</a>
                </li>
             </ul>
          </div>
          <div class="col-lg-6">
             <ul class="list-unstyled mb-0">
                <li>
                   @if (count($reports['tags'])>$i+1 )
                   <a href="#">{{$reports['tags'][$i+1]['name']}}</a>
                   @endif
                </li>
             </ul>
          </div>
          @endfor
       </div>
    </div>
 </div>