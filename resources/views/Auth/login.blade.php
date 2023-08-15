<!DOCTYPE html>
<html>
    <head>  
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
      <li><a href="/">Home</a></li>
      <li><a href="{{ url('/mahasiswa') }}">Mahasiswa</a></li>
      <li><a href="{{ url('/dosen') }}">Dosen</a></li>
      <li><a href="{{ url('/jurusan') }}">Jurusan</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @auth
      <li class="dropdown">
  <a class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ auth()->user()->name }}
  <span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="{{ url('/profile') }}">Profile</a></li>
    <li>
      <form method="post" action="{{ url('/logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </li>
  </ul>
</li>
      @else  
      <li><a href="{{ url('/login') }}">Login</a></li>
      @endauth
    </ul>
  </div>
</nav>

<form class="container my-5" action="{{ url('/login') }}" method="post">
     @csrf
    @if (session()->has('success'))
        <div class="alert alert-success">
            <strong>Info!</strong> {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            <strong>Info!</strong> {{ session('error') }}
        </div>
    @endif
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" @if(old('email')) value="{{ old('email') }}" @endif placeholder="Email address" required autofocus>

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" @if(old('password')) value="{{ old('password') }}"@endif  required>

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
    <small>Kamu Belum Daftar<a href="{{ route('register') }}">Registery</a></small>
</form>
    </body>
    
</html>