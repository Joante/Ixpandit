<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;

class BuscadorController extends Controller
{
    public function index ($nombre , Request $request){
	
    	//Convierto el string a buscar a minuscula para evitar fallos en la busqueda.
    	$nombre = strtolower($nombre);

		$pokemons = $this->buscarPokemons($nombre);
		if ($pokemons == 404){
			$statusCode = 404;
			return view('pages/index', compact('statusCode')); 	
		}
		else if(count($pokemons)==1){
			return redirect()->action('DetallesController@index', $pokemons[0]['nombre']);
		}
		return view('pages/index', compact('pokemons'));
	}

	protected function buscarPokemons($nombre){

	 	// Declaro el cliente para la conexion a la API
		$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);

		//Busco al pokemon
		$response = $client->request('GET', 'pokemon/?limit=964');
		$this->chequearErrores($response);
        $contenido = $response->getBody()->getContents();

        $listaPokemon =json_decode($contenido);
        $resultados=array(); 

        $i=0;
        foreach ($listaPokemon->results as $pokemon) {
            if(stristr($pokemon->name, $nombre)){
               $resultados[$i] = $pokemon->url;
               $i++; 
            }
        }
        $pokemonEncontrados = array();

        $i=0;
        if(count($resultados)==0){
        	return 404;
        }
        foreach ($resultados as $url) {
	        $pokemon=$this->traerPokemon($url);
	        $pokemonEncontrados[$i] = array(
	        	'nombre' => $pokemon->name,
	        	'imagen_front' => $pokemon->sprites->front_default,
	        	'tipo' => $pokemon->types
	        );
	        $i++;
        }
        return $pokemonEncontrados;
    }

    protected function traerPokemon($url){
    	$client = new Client([
		   	'base_uri' => $url,
		    'exceptions' => false,
			]);
		//Busco al pokemon
		$response = $client->request('GET');
		$this->chequearErrores($response);
        $contenido = $response->getBody()->getContents();

        $resultado = json_decode($contenido);
        return $resultado;
    }

    public function chequearErrores($response){
    	//Reviso por posibles errores en la conexion
		if($response->getStatusCode()==404 || $response->getStatusCode()==500){
			$statusCode = $response->getStatusCode();
			return view('pages/index', compact('statusCode')); 	
		}

    }

	
}
