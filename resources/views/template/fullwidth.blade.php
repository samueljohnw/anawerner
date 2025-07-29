<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Ana Werner Ministries')</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/foundation.css">
  <link rel="stylesheet" href="/assets/css/slick.css">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/responsive.css">
</head>
<body>
  <!-- Wrapper Starts Here -->
  <div class="secondary wrapper">
    <!-- Header Start Here -->
    <header class="header home">
      <div class="grid-container flex-container align-middle align-justify">
        <div class="logo">
          <a href="/">
            <img src="/assets/images/logo.png" alt="Logo">
          </a>
        </div>
        @include('template.menu')
      </div>
      
    </header>
    <!-- Header Ends Here -->
    @include('template.topbar')

    <section class="content">
        @yield('content')
    </section>  


  </div>
  @include('template.footer')
  <!-- Wrapper Ends Here -->
  @include('template.scripts')
</body>
</html>