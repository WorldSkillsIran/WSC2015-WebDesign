@extends('app')

@section('content')
<div class="container">
<div class="row">
<?php
$message = Session::get('message');
?>
<div class="col-lg-12">
@if($message)
<div class="alert alert-success">{{$message}}</div>
@endif
</div>
<div class="col-md-12">
    <ul class="list-group">
    @foreach($routes as $route)
        <li class="list-group-item">
        <h4 class="list-group-item-heading">{{$route->from}} <i class="glyphicon glyphicon-arrow-right"></i> {{$route->to}}</h4>
        <p>
        <strong>{{ucfirst($route->type)}} </strong>route<br>
        {{$route->type === 'offered' ? 'Driver' : 'Requested by'}}: {{$route->user->name}}<br/>
        <?php
        $time = new DateTime($route->time);
        $isFuture = $time > new DateTime();
        $stars = round($route->user->rate);
        ?>
        Due Date and Time : <span style="font-weight: {{$isFuture ? 'bold' : 'normal'}}">{{$time->format('Y M d, hA')}}</span><br/>
        Rate : <span style="color: goldenrod;" title="{{$route->user->rate}} of 5">
        @for($i = 0; $i < $stars; $i++)
        <i class="glyphicon glyphicon-star"></i>
        @endfor
        @for($i = $stars; $i < 5; $i++)
        <i class="glyphicon glyphicon-star-empty"></i>
        @endfor
        </span>
        @if($route->booked)
        <form method="POST" class="form-inline" action="{{url("/route/{$route->id}/rate")}}">
        <label>Rate for this route</label>
        <select name="rate" class="form-control input-sm">
        <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
        </select>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <button class="btn btn-default btn-sm">Submit</button>
        </form>
        @endif
        @if(! $route->booked)
        <a class="btn btn-primary btn-xs pull-right" href="{{url('/book', $route->id)}}"><i class="glyphicon glyphicon-bookmark"></i> Book</a>
        @endif
        <span class="clearfix"></span>
        </p>
        </li>
        @endforeach
    </ul>
    </div>
</div>
</div>
@endsection
