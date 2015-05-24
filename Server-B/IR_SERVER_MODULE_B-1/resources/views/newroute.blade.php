@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
            <form action="{{url('/route/new')}}" method="POST">
                <div class="form-group">
                    <label>From</label>
                    <input class="form-control" type="text" name="from" value="{{Input::old('from')}}"/>
                </div>
                <div class="form-group">
                    <label>Destination</label>
                    <input class="form-control" type="text" name="to" value="{{Input::old('to')}}"/>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="type" id="type"><option value="requested">I want to request</option><option value="offered">I am a driver</option></select>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input class="form-control" type="date" name="date" placeholder="Date" value="{{Input::old('date')}}"/>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input class="form-control" type="time" name="time" placeholder="Time" value="{{Input::old('time')}}"/>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                <button class="btn btn-primary"><i class="glyphicon glyphicon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
