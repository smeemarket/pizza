<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Pizza Order System</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="{{ asset('customer/assets/favicon.ico') }}" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="{{ asset('customer/css/styles.css') }}" rel="stylesheet" />
  <style>
    html {
      scroll-behavior: smooth;
    }

    #pizza-image {
      filter: brightness(70%);
      transition: 0.3s;
    }

    #pizza-image:hover {
      filter: brightness(100%);
    }

    #code-lab-pizza {
      animation: shake 5s infinite linear;
    }

    @keyframes shake {
      from {
        transform: scale(0.2);
      }

      to {
        transform: scale(1);
      }
    }

  </style>
</head>

<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container px-5">
      <a class="navbar-brand" href="#!">Pizza Order System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#pizza">Pizza</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

          <li class="nav-item"><span class="nav-link text-primary">{{ Auth()->user()->name }}</span></li>
          <form action="{{ route('logout') }}" method="post" class="d-flex">
            @csrf
            <button class="btn btn-sm btn-outline-danger" type="submit">
              Logout
            </button>
          </form>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content-->
  @yield('content')

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="{{ asset('customer/js/scripts.js') }}"></script>
</body>

</html>
