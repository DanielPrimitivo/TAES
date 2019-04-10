@extends('layouts.layout')

@section('content')

<div>
	<form method="POST" action="{{ route('crearaviso') }}">
		{{ csrf_field() }}
		
		<div class="form-group">
			<label for="latitud">Latitud</label>
			<input type="text" class="form-control" name="latitud" id="latitud" placeholder="Latitud">
		</div>
		<div class="form-group">
			<label for="longitud">Longitud</label>
			<input type="text" class="form-control" name="longitud" id="longitud" placeholder="Longitud">
		</div>
		<div class="form-group">
			<label for="notice_id">Aviso</label>
			<input type="text" class="form-control" name="notice_id" id="notice_id" placeholder="Aviso">
		</div>

		<button type="submit" class="btn btn-primary">Enviar</button>
	</form>
</div>

@endsection