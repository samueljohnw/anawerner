<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Page - Ana Wener Ministries</title>
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
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
  <div class="wrapper">
    <!-- Header Start Here -->
    <header class="header home">
      <div class="grid-container flex-container align-middle align-justify">
        <div class="logo">
          <a href="/">
            <img src="/assets/images/logo.png" alt="Logo">
          </a>
        </div>
        <button class="hamburger">
          <span class="lines"></span>
          <span class="lines"></span>
          <span class="lines"></span>
        </button>
        @include('template.menu')
      </div>
    </header>
    <!-- Header Ends Here -->
    <!-- Banner Section Start Here -->
      <section class="banner">
        @foreach($sliders as $items => $slider)
          <div class="hree banner-slide slide-{{$slider->id}} align-center-middle" style="background-image:url('/storage/{{$slider->image}}');background-size: cover;background-repeat: no-repeat;background-position: center center;">
            <div class="container">
              <h1>{{$slider->title}}<span class="sub-head">{{$slider->subtitle}}<br/><a class="btn" href="{{$slider->button_link}}">{{$slider->button_text}}</a></span></h1>
            </div>
          </div>
        @endforeach
      </section>
    <!-- Banner Section Ends Here -->
    <!-- Ana Info Section Starts Here -->
    <section class="ana-info">
      <div class="container">
        <div class="row">
          <div class="row align-middle grid-x">
            <div class="column small-12 medium-9">
              <h2>About Ana</h2>
              <h3>
                Heaven is for people to grow more in love with Jesus, step
                into freedom, and live life to it's fullest for Him.
              </h3>
            </div>
          </div>
          <div class="grid-x large-flex-dir-row-reverse align-justify large-cell-block-container ana-content">
            <div class="column small-12 large-5 para-wrap large-cell-block-container align-top">
              <p>
                Ana moves in prophetic and healing gifts, teaching on the
                supernatural worldwide. As a Seer, author, and speaker, her
                transparent sharing of heavenly experiences brings Holy
                Spirit's power, leading to healing and wonders. Ana's passion
                is to deepen people's love for Jesus, bringing them into
                freedom and joy through intimacy with Him.
              </p>
              <a href="/about" class="btn">Learn more about Ana</a>
            </div>
            <div class="column small-12 large-5 cell-block-container">
              <img src="/assets/images/ana.jpg" alt="Ana Werner.">
              <a href="#" class="btn">Learn more about Ana</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Ana Info Section Starts Here -->
    <!-- Event Section Starts Here -->
    <section class="event">
      <div class="container">
        <div class="row align-middle grid-x heads-wrap">
          <div class="column small-12 medium-9">
            <h2>The Event</h2>
            <h3 class="dark">
              Join us on our event to unlock miracles and deepen your
              spiritual connection.
            </h3>
          </div>
          <div class="medium-3 grid-x">
            <a href="/events/" class="btn">View More</a>
          </div>
        </div>

        <div class="row grid-x elementor-grid">
 
        @foreach($events as $event)


          <div class="column small-12 large-4">
            <div class="card">
              <div class="card-body">
                <img src="/storage/{{ $event->featured_image }}" alt="Card-@php echo $card;$card++; @endphp">
              </div>
              <div class="card-footer">
                {{ date("F j, Y", strtotime($event->start_day)) }} - {{ date("F j, Y", strtotime($event->end_day)) }}
                <a class="about-card" href="/event/{{$event->id}}">{{$event->title}}</a>
                {{$event->location}}
              </div>
            </div>
          </div>          
        @endforeach
</div>
        <!-- Third Section with Loop Grid (Events) -->

        <!-- Button Section -->
        <div class="row">
          <div class="column small-12 text-center">
            <a href="/events/" class="btn">View More</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Event Section Ends Here -->
    <!-- Rise Up Section Starts Here -->
    <section class="rise-up">
      <div class="container">
        <div class="row align-middle">
          <div class="column small-12 medium-6">
            <h2>Rise up with</h2>
            <h3>Eagles Network</h3>
            <p>
              The Eagles Network creates a community of believers that connect
              mainly online through social media to help each other navigate
              through the difficulties of being a Seer in today's spiritual
              climate.
            </p>
          </div>
        </div>
        <div class="row grid-x align-justify images-block">
          <div class="column small-12 medium-5 large-6 images-wrap iceland">
            <a href="{{route('page.eaglesnetwork')}}"><img src="/assets/images/iceland.jpg" alt="Iceland">
              <div class="content-wrap">
                <i class="arrow-right"></i>
                <span class="content-head">Iceland</span>
              </div>
            </a>
          </div>
          <div class="column small-12 medium-5 large-6 images-wrap respite">
            <a href="{{route('page.eaglesnetwork')}}"><img src="/assets/images/chair.jpg" alt="Chair">
              <div class="content-wrap">
                <i class="arrow-right"></i>
                <span class="content-head">The Respite</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Rise Up Section Ends Here -->
    <!-- Online Trainings Starts Here -->
    <section class="online-trainings">
      <div class="container">
        <h2>Online Trainings</h2>
        <h3>
          We will take you into deeper relationshop with God and learn how to
          operate in the miracualous.
        </h3>
        <div class="row">
          <div class="column">
            <ul>
              <li><a href="/training/schools">Online Schools</a><i class="list-icon"></i></li>
              <li>
                <a href="/training/mentorships">The Eagle's spot</a><i class="list-icon"></i>
              </li>
              <li><a href="/training/e-courses">E-Course</a><i class="list-icon"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- Online Trainings end Here -->
    <!-- Newsletter Section Starts Here -->
    <section class="newsletter" style="display:none;">
      <div class="container">
        <div class="row grid-x">
          <div class="columns small-12 medium-8">
            <p>Get free digital content and weekly newsletters from Ana.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Newsletter Section Ends Here -->
    @include('template.footer')
  </div>
  <!-- Wrapper Ends Here -->
@include('template.scripts')
</body>
</html>