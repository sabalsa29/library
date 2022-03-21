<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
use Auth;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{


    public function index(){

        return view('categorias.index');
    }

    public function create(){

        return view('categorias.create');
    }

    public function datatable(){

        $categorias = Categorias::active();

        return DataTables::of($categorias)->editColumn('id', function($categoria){
            $aux='';
            $aux .= '<a href="'. url('categorias/edit/'.Hashids::encode($categoria->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            $aux .= '<a href="'. url('categorias/eliminar?'."&id=".Hashids::encode($categoria->id)) . '" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon"><i class="fa fa-trash"></i></a>';

            return $aux;
        })->editColumn('codigo', function($categoria){
            $aux    ='';
            $aux    =str_pad($categoria->id, 4, "0", STR_PAD_LEFT);

            return $aux;
        })->escapeColumns([])->make(TRUE);
    }

    public function store(Request $req){
       // dd($req->all());

        $categoria                  = new Categorias();
        $categoria->name            = $req->name;
        $categoria->description     = $req->description;
        $categoria->save();

        return redirect('/categorias');
    }

    public function edit($id){
        $id     =Hashids::decode($id);
        $categoria      = Categorias::find($id[0]);

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $req){


        $categoria  = Categorias::find($req->id);
        $categoria->update($req->all());

        return redirect('/categorias');

    }
    public function eliminar(Request $req){

        if(Auth::user()->tipo==2){
            return redirect('/');
        }

        $id     = Hashids::decode($req->id);

        $categoria   = Categorias::find($id[0]);
        $categoria->estatus  =0;
        $categoria->save();

        return redirect('/categorias');
    }
}
