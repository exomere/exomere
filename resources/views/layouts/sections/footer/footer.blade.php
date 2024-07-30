<footer class="footer bg-light">
  <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
    <div>
     
    </div>
    <div>
      <div class="dropdown dropup footer-link me-3">
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if (app()->getLocale() == 'ko')
            한국어
          @else
            English
          @endif
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="{{route('setLanguage','ko')}}">한국어</a>
          <a class="dropdown-item" href="{{route('setLanguage','en')}}">English</a>
        </div>
      </div>
      <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger"><i class='bx bx-log-out-circle me-1'></i>Logout</a>
    </div>
  </div>
</footer>
