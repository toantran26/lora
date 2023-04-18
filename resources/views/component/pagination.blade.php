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
<style>
  .navigatio_page {
    padding-top: 20px;
  }

  @media only screen and (max-width: 768px) {
    .navigatio_page {
      padding-top: 0px;
    }
  }

  .pagination {
    display: block;
    text-align: end
  }

  .page-item {
    display: inline-block
  }

  .page-link {
    font-family: 'Google Sans';
    border: none;
    outline: none;
    font-size: 20px;
    font-weight: 400;
    background: none;
    color: #666666;
    /*padding: 20px;*/
  }

  .page-item:first-child .page-link,
  .page-item:last-child .page-link {
    color: #DADADA;
  }

  .page-link:hover {
    border: none;
    background: none;
    color: #02B3AC !important;
  }

  .page-link:focus {
    box-shadow: none;
  }

  .page-item.active .page-link {
    font-weight: 400;
    font-family: 'Google Sans';
    /* font-size: 14px; */
    background: none;
    color: #02B3AC;
  }

  .page-item .page-link i {
    color: #666666;
    margin: auto;
    text-align: center;
  }
</style>