<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Kampus Jaya</a>
    </div>
    <ul class="nav navbar-nav navbar-left">
      <li class="active"><a href="/">Home</a></li>
      @if (auth()->check() && auth()->user()->role == 'Admin')
    <li><a href="{{ url('/mahasiswa') }}">Mahasiswa</a></li>
    <li><a href="{{ url('/dosen') }}">Dosen</a></li>
@endif
      <li><a href="{{ url('/jurusan') }}">Jurusan</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
  @auth
  <li>
  <form method="post" action="{{ url('/logout') }}" class="navbar-form">
          @csrf
          <button type="submit" class="btn btn-link">Logout</button>
    </form>
  </li>
  <li class="dropdown">
    <a class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ auth()->user()->name }}
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      <li><a href="{{ url('/profile') }}">Profile</a></li>
      @if (auth()->user()->role == 'Admin') 
      <li><a href="{{ url('/dashboard') }}">Dasboard</a></li>
      @endif
    </ul>
  </li>
  @else
  <li><a href="{{ url('/login') }}">Login</a></li>
  @endauth
</ul>
  </div>
</nav>
  <h1>Selamat Datang Di Kampus Jaya</h1>
    </body>
</html>