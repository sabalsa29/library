<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categorias;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->tipo==2){
            return redirect('/');
        }

        return view('book.index');
    }

    public function datatable(){

        $libros = Books::where('estatus','<>',0)->get();

        return DataTables::of($libros)->addColumn('botones',function($libro){
            $aux='';
            $aux .= '<a href="'. url('book/edit/'.Hashids::encode($libro->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            $aux .= '<a href="'. url('book/eliminar?'."&id=".Hashids::encode($libro->id)) . '" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon"><i class="fa fa-trash"></i></a>';

            //$aux .= '<input onclick="delete_book()" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon" id="btn_eliminar" data-inputHidden="'. url('book/edit/'.Hashids::encode($libro->id)) .'" data-value="'. url('book/edit/'.Hashids::encode($libro->id)) .'" id ="btn_eliminar"><i class="fa fa-trash"></i></input >';

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->tipo==2){
            return redirect('/');
        }
        $fecha_hoy= Date::now();

        $categorias = Categorias::active()->pluck('name','id')->toArray();
        return view('book.create', compact('categorias','fecha_hoy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request->all());

        $book   = new Books();
        $book->categoria_id     = $request->category;
        $book->name             = $request->name;
        $book->name_autor       = $request->name_autor;
        $book->date             = $request->date;
        $book->save();

        return redirect('/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->tipo==2){
            return redirect('/');
        }

        $id         = Hashids::decode($id);
        $libro      = Books::find($id[0]);

        $categorias =[
            1=>'Categoria 1',
            2=>'Categoria 2',
            3=>'Categoria 3',
            4=>'Categoria 4'
        ];

        return view('book.edit', compact('libro','categorias'));
        //dd($id, $libro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $libro  =Books::find($request->id);
        $libro->categoria_id    = $request->category;
        $libro->name            = $request->name;
        $libro->name_autor      = $request->name_autor;
        $libro->date            = $request->date;
        $libro->save();

        return redirect('/book');
        //dd($request->all(),$libro);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $req)
    {
        if(Auth::user()->tipo==2){
            return redirect('/');
        }

        $id     = Hashids::decode($req->id);

        $book   = Books::find($id[0]);
        $book->estatus  =0;
        $book->usuario_id  =0;
        $book->save();

        return redirect('/book');

    }
}
