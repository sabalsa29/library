<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class LibraryController extends Controller
{
    public function index(){


        //dd('dsdsds');
        return view('home');
    }

    public function datatable(){

        $libros_disponibles = Books::Disponibles();
        //dd($libros_disponibles);
        return DataTables::of($libros_disponibles)->editColumn('id', function($libro){
            $aux= '';
            if($libro->estatus==1){
                $aux .= '<a href="'. url('library/rentar/'.Hashids::encode($libro->id)) .'" class="btn btn-outline-success m-1 btn-sm ul-btn__icon"><i class="fa fa-folder"></i></a>';
            }else{
                $aux .= '<a href="'. url('library/rentar/'.Hashids::encode($libro->id)) .'" class="btn btn-outline-warning m-1 btn-sm ul-btn__icon"><i class="fa fa-folder"></i></a>';

            }

            return $aux;
        })->addColumn('usuario', function($libro){
            $aux='';
            if($libro->usuario_id >0){
                $aux.= '<p class="text-warning"> <strong> '.$libro->usuario->name.'</strong></p>';
            }else{
                $aux .='<p class="text-success"> <strong> Disponible</strong></p>';
            }
            return $aux;
        })->editColumn('categoria_id', function($libro){
            $aux    ='';
            if($libro->categoria_id >0){
                $aux= ($libro->categoria)?$libro->categoria->name:'N/D';
            }else{
                $aux='N/D';
            }
            return $aux;
        })->escapeColumns([])->make(TRUE);

    }
    public function rentar($hash){
        $id     = Hashids::decode($hash);
        $libro  = Books::find($id[0]);
        $fecha_hoy  = Date::now();
        $usuarios   = User::where('tipo',2)->pluck('name','id')->toArray();
        return view('book.show', compact('libro', 'fecha_hoy', 'usuarios'));

    }
    public function book_select(Request $req){

        $libro  = Books::find($req->id);
        $libro->estatus=2;
        $libro->usuario_id=Auth::user()->id;
        $libro->save();

        return redirect('/');
       // dd($req->all());
    }
    public function book_select_recuperacion(Request $req){
        $libro  = Books::find($req->id);

        $libro->estatus =1;
        $libro->usuario_id=0;
        $libro->save();

        return redirect('/');
    }

}
