@extends('template.fullwidth')
@section('title', 'Online Courses | Ana Werner Ministries')
@section('content')
    <section class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="row align-middle grid-x">
            <div class="column small-12 medium-12">
                <h2>
                @isset($courses)
                  {{$courses->first()->type}}
                @endisset
                @isset($course)
                  {{$course->title}}
                @endisset
                </h2>
              <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                @isset($courses)
                  <li><a href="/training/">Training</a></li>
                  <li class="show-for-sr">{{$courses->first()->type}}</li>

                @endisset
                @isset($course)
                  <li><a href="/training/">Training</a></li>  
                  <li><a href="/training/{{$course->type}}">{{$course->type}}</a></li>
                @endisset

                </ul>
              </nav>


              <div class="grid-x grid-margin-x" style="justify-content: center;">
                <div class="cell small-12 medium-12 large-12">
              </div>
              @isset($course)
                @php
                  $sessionCount = $course->assets->count();
                  $sessionColumnClass = $sessionCount == 2 ? 'medium-6 large-6' : 'medium-6 large-4';
                @endphp
                @foreach($course->assets as $session)
                  <div class="cell small-12 {{ $sessionColumnClass }}">
                    <a href="/training/{{$course->type}}/{{$course->slug}}/{{$session->slug}}" class="thumbnail"><img src="{{ $session->featuredImage ? asset('/storage/' . $session->featuredImage) : 'https://placehold.co/600x400/orange/white' }}" alt="{{$session->title}}"></a>
                  </div>
                @endforeach
              @endisset

              @if (isset($courses))
                @php
                  $courseCount = $courses->count();
                  $columnClass = $courseCount == 2 ? 'medium-6 large-6' : 'medium-6 large-4';
                @endphp
                @foreach($courses as $course)
                  <div class="cell small-12 {{ $columnClass }}">
                    <a href="/training/{{ $course->type}}/{{$course->slug }}" class="thumbnail"><img src="{{ $course->featured_image ? asset('/storage/' . $course->featured_image) : 'https://placehold.co/600x400/orange/white' }}" alt="{{$course->title}}"></a>
                  </div>
                @endforeach
              @endif

             
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection