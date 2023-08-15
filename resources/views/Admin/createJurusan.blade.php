<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
<button style="width: 50px; top: 60px; right: 20px;" class="btn btn-light fixed-top shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z"/>
</svg></button>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Kampus Jaya</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

    <div class="dropdown mt-3">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Create New Data
      </button>
      <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{ url('/dashboard/mahasiswa') }}">New Mahasiswa</a></li>
        <li><a class="dropdown-item" href="{{ url('/dashboard/dosen') }}">New Dosen</a></li>
        <li><a class="dropdown-item" href="{{ url('/dashboard/jurusan') }}">New Jurusan</a></li>
      </ul>
    </div>
  </div>
</div>
</div>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kampus Jaya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/mahasiswa')}}">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/dosen')}}">Dosen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/jurusan')}}">Jurusan</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
  @auth
  <li>
  <form method="post" action="{{ url('/logout') }}" class="navbar-form">
          @csrf
          <button type="submit" class="btn btn-primary">Logout</button>
    </form>
  </li>
  <li class="nav-item dropdown">
    <a class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">{{ auth()->user()->name }}
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="dropdown-item"><a href="{{ url('/profile') }}" class="link-light link-underline-opacity-0">Profile</a></li>
      @if (auth()->user()->role == 'Admin') 
      <li class="dropdown-item"><a href="{{ url('/dashboard') }}" class="link-light link-underline-opacity-0">Dasboard</a></li>
      @endif
    </ul>
  </li>
  @else
  <li><a href="{{ url('/login') }}">Login</a></li>
  @endauth
</ul>
    </div>
  </div>
</nav>

<div class="container-sm" style="display: flex; justify-content:center; flex-direction: column; align-items: center;">
<h1>Create New Data Jurusan</h1>
<form class="row g-3" action="{{url('/admin/jurusan')}}" method="POST">
  @csrf
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>New Data Added!</strong> {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
  @endif
  @if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>New Data Added!</strong> Data Baru telah ditambahkan ke database mahasiswa.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
  @endif
  <div class="col-md-4">
    <label for="validationServer01" class="form-label">Nama Jurusan</label>
    <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="validationServer01" placeholder="Sistem Operasi" required name="nama">
    <div class="invalid-feedback">
    Harap isi dengan ketentuan.
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationServer05" class="form-label">Kode Jurusan</label>
    <input type="text" class="form-control  @error('nim') is-invalid @enderror" id="validationServer05" aria-describedby="validationServer05Feedback" required name="kode" placeholder="02323">
    <div id="validationServer05Feedback" class="invalid-feedback">
      Please provide a valid Kode Jurusan.
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Create Data</button>
  </div>
</form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>