<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">LSAPP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item {{Request::segment(1)==null ? 'active': null}}">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{Request::segment(1)== 'about' ? 'active': null}}">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item {{Request::segment(1)== 'services' ? 'active': null}}">
            <a class="nav-link" href="/services">Services</a>
        </li>
        <li class="nav-item {{Request::segment(1)== 'posts' ? 'active': null}}">
            <a class="nav-link" href="/posts">Blogs</a>
        </li>
      </ul>
     
    </div>
  </nav>