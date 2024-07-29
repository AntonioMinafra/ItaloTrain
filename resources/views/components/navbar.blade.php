<nav class="navbar navbar-expand-lg bg_nav">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="{{route('trains.index')}}">ITALOTRAIN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="{{route('trains.index')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{route('save.trains')}}">Treni salvati</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>