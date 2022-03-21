<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $usuarios   = User::active();

        return DataTables::of($usuarios)->editColumn('id', function($usuario){
            $aux='';
            $aux .= '<a href="'. url('usuarios/edit/'.Hashids::encode($usuario->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            $aux .= '<a href="'. url('usuarios/eliminar?'."&id=".Hashids::encode($usuario->id)) . '" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon "><i class="fa fa-trash"></i></a>';

            return $aux;
        })->editColumn('tipo', function($usuario){
            $tipos  =[
                1=>'Administrador',
                2=>'Visitante'
            ];

            $aux='';
            if($usuario->tipo>0){
                $aux    = $tipos[$usuario->tipo];
            }else{
                $aux='N/D';
            }
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

    public function store(Request $req, User $model){

        //dd($req->all());
        $model->create($req->merge(['password' => Hash::make($req->get('password'))])->all());

        return redirect('/usuarios');

    }

    public function edit($id){
        $id         = Hashids::decode($id);
        $usuario    = User::find($id[0]);
        $tipos  =[
            1=>'Administrador',
            2=>'Visitante'
        ];
        return view('usuarios.edit', compact('usuario','tipos'));
        //dd($id);
    }

    public function update(Request $req){


        $usuario = User::find($req->id);

        if(!empty( trim($req->password) )){
            $usuario->password   = Hash::make($req->password);
            $usuario->save();
            }
        $validator = Validator::make($req->all(), [
            'email' => 'required|unique:users,email,'. $usuario->id,
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $usuario->name      = $req->name;
        $usuario->email     = $req->email;
        $usuario->tipo      = $req->tipo;
        $usuario->update();


        return redirect('/usuarios');

    }
    public function eliminar(Request $req){


        if(Auth::user()->tipo==2){
            return redirect('/');
        }

         $id     = Hashids::decode($req->id);

        $usuario            = User::find($id[0]);
        $usuario->estatus   =0;
        $usuario->save();

        return redirect('/usuarios');
    }
}
