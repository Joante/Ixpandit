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

@isset($pokemons)
	<table class="table table-striped">
		<thead>
	    	<th>Nombre</th>
	        <th>Imagen</th>
	        <th>Tipo</th> 
	    </thead>
	    <tbody>
	    	@foreach ($pokemons as $pokemon)
		        <tr>
		            <td><a href ="{{ route('details', ['nombre' => $pokemon['nombre'] ]) }}"> {{ $pokemon['nombre'] }}</a></td>
		            <td><img alt="User Pic" src="{{ $pokemon['imagen_front'] }}" class="sprites"></td>				
		            @foreach ($pokemon['tipo'] as $tipo)
	              		<td class="tipos"> {{ $tipo->type->name }} </td>
			        @endforeach
		    @endforeach
	    </tbody>
	</table>
@endisset
<style>
	body {
        }
    .tipos{
    	display: block;	
    }
@stop