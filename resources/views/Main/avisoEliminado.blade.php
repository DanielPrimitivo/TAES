@extends('layouts.layout')

@section('content')
<div class="container text-center" style="margin-top:12%; margin-bottom: 11%;">
<div class="alert alert-success">
  <strong>Buenas noticias</strong> el aviso ha sido borrado satisfactoriamente<i class="fas fa-check-circle ml-2"></i>
</div>
<br>
        <a href="{{route('dashboard')}}" class="btn btn-primary"><i class="fas fa-arrow-circle-left mr-2"></i> Volver al dashboard</a>
</div>
@endsection
