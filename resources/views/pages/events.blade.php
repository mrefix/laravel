@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.jpg') }}'); background-position: center;">
        <h1>EVENTS</h1>
    </div>
    	<div class="row">
		<div class="col-xs-12">
      <a href="createEvent"><button class="btn btn-warning" type=
          "button">Create New Event</button></a>
			<h1>All Events</h1>

      @foreach ($events as $event)
        <div>
          {{ $event->eventName }}
        </div>

      @endforeach

		</div>
	</div>
@stop
