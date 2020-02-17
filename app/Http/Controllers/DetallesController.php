<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;

class DetallesController extends Controller
{
    public function index ($nombre , Request $request){
		
    	//Convierto el string a buscar a minuscula para evitar fallos en la busqueda.
    	$nombre = strtolower($nombre);

		$pokemon = $this->traerPokemon($nombre);

		//Busco las caracteristicas del pokemon
		$habilidades = $this->buscarHabilidades($pokemon);
		$descripcionPokemon = $this->buscarDescripcion($pokemon);
		$stats = $this->buscarStats($pokemon);
		$moves = $this->buscarMoves($pokemon);
		
		
	    return view('pages/details', compact('pokemon','habilidades','descripcionPokemon','stats','moves'));
	}

	protected function buscarHabilidades($pokemon){
		
		// Declaro el cliente para la conexion a la API
		$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);
		
		//Declaración de variables temporales
		$habilidades = array();
		$i=0;
		//Loop para la busqueda de todos los elementos. 
		//Utilizo una variable "aux" para la temporal descodificación del json de la respuesta de la API
		foreach ($pokemon->abilities as $key) {
				$response = $client->request('GET', "ability/".$key->ability->name);
				$aux =  json_decode($response->getBody()->getContents());
				foreach ($aux->flavor_text_entries as $text ) {
					if($text->language->name=='es')
						$description = $text->flavor_text; 
				}
				$habilidades[$i] = array(
					"name" => $pokemon->abilities[$i]->ability->name,
					"description" => $description,
				);
				$i++;
			}		
		return $habilidades;
	} 

	protected function buscarDescripcion($pokemon){
		
		// Declaro el cliente para la conexion a la API
		$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);

		//Loop para la busqueda de todos los elementos
		//Utilizo una variable "aux" para la temporal descodificación del json de la respuesta de la API
		$response = $client->request('GET', "pokemon-species/".$pokemon->species->name);
		$aux =  json_decode($response->getBody()->getContents());
		foreach ($aux->flavor_text_entries as $text ) {
				if($text->language->name=='es')
					$descripcionPokemon = $text->flavor_text; 
		}
		return $descripcionPokemon;
	} 

	protected function buscarStats($pokemon){
		// Declaro el cliente para la conexion a la API
		$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);
		
		//Declaración de variables temporales
		$stats = array();
		$i=0;

		//Loop para la busqueda de todos los elementos. 
		//Utilizo una variable "aux" para la temporal descodificación del json de la respuesta de la API
		foreach ($pokemon->stats as $key) {
			$response = $client->request('GET', "stat/".$key->stat->name);
			$aux =  json_decode($response->getBody()->getContents());
			$stats[$i] = array(
				"name" => $aux->names[3]->name,
				"statBase" => $key->base_stat,
				"effort" => $key->effort,
			);
			$i++;
		}
		return $stats;
	}

	protected function buscarMoves($pokemon){

		// Declaro el cliente para la conexion a la API
		$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);
		
		//Declaración de variables temporales
		$moves = array();
		$i=0;

		//Loop para la busqueda de todos los elementos. 
		//Utilizo una variable "aux" para la temporal descodificación del json de la respuesta de la API
		foreach ($pokemon->moves as $key) {
			$response = $client->request('GET', "move/".$key->move->name);
			$aux =  json_decode($response->getBody()->getContents());
			foreach ($aux->flavor_text_entries as $text ) {
				if($text->language->name=='es')
					$description = $text->flavor_text; 
			}
			$moves[$i] = array(
				"name" => $aux->names[4]->name,
				"accuracy" => $aux->accuracy,
				"description" => $description,
				"power" => $aux->power,
				"pp" => $aux->pp,
				"priority" => $aux->priority,
				"type" => $aux->type->name,
			);
			$i++;
		}
		return $moves;
	}

    public function traerPokemon($nombre){
    	$client = new Client([
		   	'base_uri' => env('API_URL'),
		    'exceptions' => false,
			]);
		//Busco al pokemon
		$response = $client->request('GET', 'pokemon/'.$nombre);
        $contenido = $response->getBody()->getContents();

        $resultado = json_decode($contenido);
        return $resultado;
    }	
}
