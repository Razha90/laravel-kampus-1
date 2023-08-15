<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css">
    </head>
    <body>
    <form class="form-signin" action="{{url('/register')}}" method="post">
      @csrf
      <h1 class="h3 mb-3 font-weight-normal">Registery Form</h1>
      <label for="name" class="sr-only">Nama</label>
      <input type="text" id="name" name="name" class="form-control  @error('name') is-invalid @enderror"  placeholder="Your Name" required autofocus>
 
      <label for="username" class="sr-only">UserName</label>
      <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"  placeholder="Your Name" required autofocus>

      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required autofocus>
      
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <small>Kamu Sudah Memiliki Akun<a href="{{ route('register') }}"> Log In</a></small>
    </form>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    </body>
    
</html>