@extends('template.fullwidth')

@section('title', 'Session | Ana Werner Ministries')

@section('content')
    <section class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="row align-middle grid-x">
            <div class="column small-12 medium-12">
                <h2>
                {{$course->title}} / {{$session->title}}
                </h2>

              <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">

                  <li><a href="/training/">Training</a></li>  
                  <li><a href="/training/{{$course->type}}">{{$course->type}}</a></li>
                  <li><a href="/training/{{$course->type}}/{{$course->slug}}">{{$course->title}}</a></li>
                  @if(auth()->check() && auth()->user()->id == 1)
                    <li><a href="/nova/resources/assets/{{$session->id}}/edit" target="_blank">Edit</a></li>
                  @endif

                </ul>
              </nav>

              <div style="position:relative; width:100%; height:0px; padding-bottom:56.250%">
                <iframe allow="fullscreen" allowfullscreen height="100%" src="{{ $url }}" width="100%" style="border:none; width:100%; height:100%; position:absolute; left:0px; top:0px; overflow:hidden;"></iframe>
                @php
                  $hasAccess = false;
                  if (auth()->check()) {
                      if ($course->type === 'seers-soaring' || $course->type === 'the-eagles-spot') {
                          $hasAccess = auth()->user()->canAccessCourseSession($course);
                      } else {
                          $hasAccess = auth()->user()->hasCourse($course->id);
                      }
                  }
                @endphp
                @if(!$hasAccess)
                  <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.8); color: white; padding: 10px; border-radius: 5px; font-size: 14px;">
                    🔒 No Longer Available
                  </div>
                @endif
              </div>
              <p>
               {!! strip_tags($session->description, '<p><br><strong><em><ul><ol><li>') !!}

              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection