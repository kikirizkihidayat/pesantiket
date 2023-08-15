<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Login · pesanTiket</title>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form action="/login" method="post">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Login psnTiket</h1>
      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    <div class="form-floating">
      <input type="input" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name='email' placeholder="name@example.com" required value="{{ old('email') }}">
      <label for="floatingInput">Email address</label>  
      @error('email')    
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name='password' placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">Belum punya akun? <a href="/" class=""> Registery</a></p>
    <p class="mt-5 mb-3 text-muted">&copy; <a href="/" class=""> psnTiket 2023</a></p>
  </form>
  </main>

    
  </body>
</html>
