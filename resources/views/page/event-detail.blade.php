@extends('template.fullwidth')

@section('title', 'Event | Ana Werner Ministries')

@section('content')


    <section class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="row align-middle grid-x">
            <div class="column small-12 medium-12">
              <h2>Upcoming Event</h2>
                <p>
                    {{$event->title}}
                </p>
                <p>
                    <b>When:</b> {{ date("F j, Y", strtotime($event->start_day)) }} - {{ date("F j, Y", strtotime($event->end_day)) }}
                </p>
                <p>
                    <b>Where:</b> {{$event->location}}
                </p>
                <p>
                   <i> {!! $event->description !!}  </i>
                </p>
                
                <div class="cell small-4"><img style="max-width=350px;" src="/storage/{{ $event->featured_image }}">


            </div>
          </div>
          <hr/>
        <div class="grid-x grid-padding-x">

            </div>
        </div>
    </div>
    </section>
   
@endsection