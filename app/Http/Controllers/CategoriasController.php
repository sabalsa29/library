<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
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

        $categorias = Categorias::all();

        return DataTables::of($categorias)->editColumn('id', function($categoria){
            $aux='';
            $aux .= '<a href="'. url('categorias/edit/'.Hashids::encode($categoria->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            //$aux .='<input type="hidden" name="algo" value="'.($libro->id).'" id="pregunta">';
            $aux .= '<button onclick="delete_book()" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon" id="btn_eliminar" data-inputHidden="'. url('categorias/edit/'.Hashids::encode($categoria->id)) .'" data-value="'. url('book/edit/'.Hashids::encode($categoria->id)) .'" id ="btn_eliminar"><i class="fa fa-trash"></i></button >';

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
}
