<?php

namespace App\Http\Controllers;

use App\Boleto;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->tipo=='administrador'){
            $usuarios = DB::table('users')->where('tipo','=','usuario')->get();
            $boleto = DB::table('boletos')->get();
            return view('home', compact('boleto',$boleto))->with('usuarios',$usuarios);

        }else{

            return view('home');
        }

    }


    public function cargarBoletos(Request $request){
        $nuevo_boleto = new Boleto();
        $nuevo_boleto->serial =$request->serial;
        $nuevo_boleto->nombre =$request->nombre;
        $nuevo_boleto->fecha =$request->fecha;
        $nuevo_boleto->ubicacion = $request->ubicacion;
        $nuevo_boleto->id_usuario =$request->id;
        $nuevo_boleto->save();
        return view('home')->with('boleto',$nuevo_boleto);

    }
}
