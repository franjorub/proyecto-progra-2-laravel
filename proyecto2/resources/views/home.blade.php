@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido {{Auth::user()->nombre}}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(Auth::user()->tipo == 'usuario')
                        
                            <form action='' method='post'>
                                {{ csrf_field() }}
                                <legend>Registrar Boleto</legend>
                                <table>
                                    <tr>
                                        <td><label for='nombre'>Evento</label></td><td><input type='text' name='nombre'></td>
                                    </tr>
                                    <tr>
                                        <td><label for='serial'>Serial</label></td><td><input type='number' name='serial'></td>
                                    </tr>
                                    <tr>
                                        <td><label for='fecha'>Fecha</label></td><td><input type='date' name='fecha'></td>
                                    </tr>
                                    <tr>
                                        <td><label for='nombre'>Ubicacion</label></td><td><select name='ubicacion' id='ubicacion'>
                                                                                            <option value=''>--seleccione--</option>
                                                                                            <option value='altos'>Altos</option>
                                                                                            <option value='medios'>Medios</option>
                                                                                            <option value='vip'>VIP</option>
                                                                                            <option value='planito'>Bajos</option>
                                                                                        </select></td>
                                    </tr>
                                </table>
                                <input type='hidden' name='id' value={{Auth::user()->id}}>
                                <input class='button' type='submit' value='Registrar'>
                            </form>
                            <hr>

                        @isset($boleto)
                                <h3>Boleto Guardado exitosamente</h3>
                                <table>
                                    <tr>
                                        <td>Nombre</td><td>Fecha</td><td>Ubicacion</td><td>Serial</td>
                                    </tr>
                                    <tr>
                                        <td>{{$boleto->nombre}}</td><td>{{$boleto->fecha}}</td><td>{{$boleto->ubicacion}}</td><td>{{$boleto->serial}}</td>
                                    </tr>


                                </table>
                        @endisset
                    @endif




                    @if(Auth::user()->tipo == 'administrador')

                        @foreach($usuarios as $user)
                            <table align='center'>
                                <tr><td>{{'Nombre'}}</td><td>{{'Apellido'}}</td> <td>{{'Cedula'}}</td></tr>
                                <tr><td>{{$user->nombre}}</td><td>{{$user->apellido}}</td> <td>{{$user->cedula}}</td></tr>

                                <tr><td>Evento</td><td>Ubicacion</td><td>Serial</td><td>Fecha</td></tr>
                                @foreach($boleto as $b)
                                    @if($b->id_usuario == $user->id)
                                        <tr><td>{{$b->nombre}}</td><td>{{$b->ubicacion}}</td><td>{{$b->serial}}</td><td>{{$b->fecha}}</td></tr>
                                    @endif
                                @endforeach

                            </table>
                            <p align='center'><a href="/home/editar?{{$user->nombre}}&{{$user->apellido}}&{{$user->cedula}}">editar</a></p>
                        @endforeach

                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
