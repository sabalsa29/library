<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuarios;
use DataTables;
use Illuminate\Http\Request;
use Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index(){


        return view('usuarios.index');

    }

    public function datatable(){
        $usuarios   = Usuarios::active();

        return DataTables::of($usuarios)->editColumn('id', function($usuario){
            $aux='';
            $aux .= '<a href="'. url('usuarios/edit/'.Hashids::encode($usuario->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            $aux .= '<a href="'. url('usuarios/eliminar?'."&id=".Hashids::encode($usuario->id)) . '" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon "><i class="fa fa-trash"></i></a>';

            return $aux;
        })->escapeColumns([])->make(TRUE);

    }
    public function create(){

        $tipos  =[
            1=>'Administrador',
            2=>'Visitante'
        ];
        return view('usuarios.create', compact('tipos'));
    }

    public function store(Request $req, Usuarios $model){

        $validator = Validator::make($req->all(), [
            'email' => 'required|unique:usuarios,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model->create($req->all());

        return redirect('/usuarios');

    }

    public function edit($id){
        $id         = Hashids::decode($id);
        $usuario    = Usuarios::find($id[0]);

        return view('usuarios.edit', compact('usuario'));
        //dd($id);
    }

    public function update(Request $req){


        $usuario = Usuarios::find($req->id);

        $validator = Validator::make($req->all(), [
            'email' => 'required|unique:usuarios,email,'. $usuario->id,
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $usuario->name      = $req->name;
        $usuario->email     = $req->email;
        $usuario->email     = $req->phone;
        $usuario->update();

        return redirect('/usuarios');

    }
    public function eliminar(Request $req){


        if(Auth::user()->tipo==2){
            return redirect('/');
        }

         $id     = Hashids::decode($req->id);

        $usuario            = Usuarios::find($id[0]);
        $usuario->estatus   = 0;
        $usuario->save();

        return redirect('/usuarios');
    }
}
