@if($object->lastPage() > 1)
<div aria-label="Page navigation example" class="navigatio_page">
  <ul class="pagination">
    <li class="page-item">
      @if($object->currentPage() != 1)
      <a class="page-link" href="{{ $object->previousPageUrl() }}"><i class="fas fa-chevron-left"></i>
      </a>
      @endif

    </li>
    @for ($i = 1; $i <= $object->lastPage(); $i++)
      @if(($i < $object->currentPage() +3 && $i > $object->currentPage() -3)
        || ($i > $object->currentPage() + 3 && $i < $object->currentPage() + 4))
        <li class="page-item {{$object->currentPage() == $i ? 'active' : ''}}">
          <a class="page-link" href="{{ $object->url($i) }}">{{$i}}
          </a>
        </li>
      @endif
    @endfor
    <li class="page-item">
      @if($object->currentPage() != $object->lastPage())
      <a class="page-link" href="{{ $object->nextPageUrl() }}"><i class="fas fa-chevron-right"></i>
      </a>
      @endif
    </li>
  </ul>
</div>
@endif