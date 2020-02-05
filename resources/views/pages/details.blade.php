@extends('layouts.default')
@section('content')


<!------ Include the above in your HEAD tag ---------->
<h2>Caracteristicas:</h2>
 <div class="container">
        <div class="row">
            <div class="">
                <!-- Nav tabs -->
                <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#descripcion" aria-controls="descripcion" role="tab" data-toggle="tab">Descripcion</a></li>
                        <li role="presentation"><a href="#habilidades" aria-controls="habilidades" role="tab" data-toggle="tab">Habilidades</a></li>
                        <li role="presentation"><a href="#movimientos" aria-controls="movimientos" role="tab" data-toggle="tab">Movimientos</a></li>
                        <li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="h-75 tab-content">
                        <div role="tabpanel" class="tab-pane active" id="descripcion">
                            <legend>Descripcion:</legend>
                            <div class="col-md-8">
                                <h4>{{ $descripcionPokemon }}</h4>
                            </div>
                             <div class=" col-md-4 col-lg-4 ">

                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img alt="User Pic" src="{{ $pokemon->sprites->front_default}}" class="sprites"> 
                                            </td>
                                            <td>
                                                <img alt="User Pic" src="{{ $pokemon->sprites->back_default}}" class="sprites">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Experiencia Base:</td>
                                            <td>{{ $pokemon->base_experience }}</td>
                                        </tr>
                                        <tr>
                                            <td>Altura:</td>
                                            <td>{{ $pokemon->height }}</td>
                                        </tr>
                                        <tr>
                                           <td>Peso:</td>
                                           <td>{{ $pokemon->weight }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                          </div>
                        <div role="tabpanel" class="tab-pane" id="habilidades">
                            <legend>Habilidades:</legend>
                            <table class="table table-hover">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Descripcion</th> 
                                </thead>
                                <tbody>
                                    @foreach ($habilidades as $habilidad)
                                        <tr>
                                            <td>{{ $habilidad['name'] }}</td>
                                            <td>{{ $habilidad['description']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="movimientos">
                            <legend>Movimientos:</legend>
                            <table class="table table-hover">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Poder</th>
                                    <th>PP</th>
                                    <th>Prioridad</th>
                                    <th>Tipo</th>
                                </thead>
                                <tbody>
                                    @foreach ($moves as $move)
                                        <tr>
                                            <td>{{ $move['name'] }}</td>
                                            <td>{{ $move['description'] }}</td>
                                            <td>{{ $move['power'] }}</td>
                                            <td>{{ $move['pp'] }}</td>
                                            <td>{{ $move['priority'] }}</td>
                                            <td>{{ $move['type'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="stats">
                            <legend>Stats:</legend>
                            <table class="table table-hover">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Stat Base</th>
                                    <th>Esfuerzo</th>
                                </thead>
                                <tbody>
                                    @foreach ($stats as $stat)
                                        <tr>
                                            <td>{{ $stat['name'] }}</td>
                                            <td>{{ $stat['statBase'] }}</td>
                                            <td>{{ $stat['effort'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

                 body {
            background: #EDECEC;
        }
        .nav-tabs {
        display: inline-flex;
        width: 100%;
        overflow-x: auto;
        border-bottom: 2px solid #DDD;
        -ms-overflow-style: none; /*// IE 10+*/
        overflow: -moz-scrollbars-none;/*// Firefox*/}
        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            border-width: 0;
        }
        .nav-tabs>li>a {
            border: none;
            color: #666;
        }
        .nav-tabs>li.active>a,
        .nav-tabs>li>a:hover {
            border: none;
            color: #4285F4 !important;
            background: transparent;
        }
        .nav-tabs>li>a::after {
            content: "";
            background: #4285F4;
            height: 2px;
            position: absolute;
            width: 100%;
            left: 0px;
            bottom: 1px;
            transition: all 250ms ease 0s;
            transform: scale(0);
        }
        .nav-tabs>li.active>a::after,
        .nav-tabs>li:hover>a::after {
            transform: scale(1);
        }
        .tab-nav>li>a::after {
            background: #21527d none repeat scroll 0% 0%;
            color: #fff;
        }
        .tab-pane {
            padding: 15px 0;
        }
        .tab-content {
            padding: 20px;
            display: flex !important;
        }

        .nav-tabs::-webkit-scrollbar {
            display: none; /*Safari and Chrome*/
        }
        .card {
            background: #FFF none repeat scroll 0% 0%;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
</style>


@stop