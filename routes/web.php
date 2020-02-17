<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
	if($request->has('search')){
       $name = $request->get('search');
      return redirect()->action('BuscadorController@index',$name);
   }
	
	return view('pages/index');
});

Route::get('/{nombre}', 'BuscadorController@index' );

Route::get('details/{nombre}', 'DetallesController@index')->name('details');
