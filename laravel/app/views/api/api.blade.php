@extends("layout.base")

@section("content")

	<h3>Pievienot dzēšana</h3>	
	{{ Form::open(array("route" => array("social_remav", "356938035643809", "3840639ccb0fdef9df29d24c3ded52daebf1f061"), "method" => "post")) }}
	
		{{ Form::label("keyword", "Atslēgasvārds") }}
		{{ Form::text("keyword") }}

		{{ Form::submit("Let's GO") }}

	{{ Form::close() }}

	<h3>Pievienot atslēgasvārdu</h3>
	{{ Form::open(array("route" => array("social_addav", "356938035643809", "d622297188004ba2a3f7fa3a91b9751a317c4ad3"), "method" => "post")) }}
	
		{{ Form::label("keyword", "Atslēgasvārds") }}
		{{ Form::text("keyword") }}

		{{ Form::submit("Let's GO") }}

	{{ Form::close() }}



	<br><br><br><br><br><br><br><br><br><br><br><br><br>

	<b>Hello World :)</b><br>

	@if(isset($name))
		Vards: {{ $name }}<br>
	@endif

	<br><br>{{ $random }}

	<br><br><a href="{{ action("ApiController@sayHello", array("name"=>$random)) }}/">{{ $random }}</a>

	<br><br>{{ mb_strtoupper(trans("reminders.password")) }}

	<br><br>
	{{ $small_text }}
	<br><br>
	{{ $text }}
@stop