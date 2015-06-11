
@extends('new_app')


@section('content')

<h1>Contact Me !!</h1>


<ul>

@if($names)
	@foreach($names as $name)
		<li>{{ $name }}</li>
	@endforeach	
@endif
</ul>



@stop