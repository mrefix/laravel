@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Attendance for {{$event->name}}</div>
              <br/>
              <div class="row text-center">
                <div class="col-sm-6"><h4> Did Not Attend </h4></div>
                <div class="col-sm-6"><h4> Attended </h4></div>
              </div>
              <div class="panel-body">
                  <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action='/events/{{$event->id}}/attendance'>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="event" value="{{ $event->id }}"/>

                    <div class="subject-info-box-1">
                      <select multiple="multiple" id='lstBox1' class="form-control" name="didNotAttend[]">
                        @if($didNotAttend != NULL)
                        @foreach($didNotAttend as $user)

                          <option value="{{ $user->id }}">{{$user->first_name}} {{$user->last_name}}</option>

                        @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="subject-info-arrows text-center">
                      <input type='button' id='btnAllRight' value='>>' class="btn btn-default" /><br />
                      <input type='button' id='btnRight' value='>' class="btn btn-default" /><br />
                      <input type='button' id='btnLeft' value='<' class="btn btn-default" /><br />
                      <input type='button' id='btnAllLeft' value='<<' class="btn btn-default" />
                    </div>

                    <div class="subject-info-box-2">
                      <select multiple="multiple" id='lstBox2' class="form-control" name="attended[]">
                        @if($attended != NULL)
                        @foreach($attended as $u)

                          <option value="{{ $u->id }}">{{$u->first_name}} {{$u->last_name}}</option>

                        @endforeach
                        @endif

                      </select>
                    </div>

                    <div class="clearfix"></div>

                  <br/>
                  <br/>
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-5">
                          <button class="btn btn-primary" id="attendanceButton" onClick="selectAll();">
                              Submit
                          </button>
                      </div>
                  </div>
                  <script src="{{asset('/js/attendance.js')}}"></script>
                </form>




              </div>
            </div>
          </div>
      </div>
  </div>
</div>



@endsection
