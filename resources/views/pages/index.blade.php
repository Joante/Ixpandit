@extends('layouts.default')
@section('content')

<div class="page-header">
  <h1>Pokemon Finder<small>
<br>
  Tu pokedex virtual.</small></h1>
<br>
@isset($statusCode)
    @if ($statusCode == 404)
		<h4>Pokemon no encontrado.</h4>
	@elseif ($statusCode== 500)
		<h4>Problemas de conexion, por favor reitente.</h4>
	@endif
@endisset

</div>


@stop