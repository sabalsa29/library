<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
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
        return view('book.index');
    }

    public function datatable(){

        $libros = Books::all();


        return DataTables::of($libros)->addColumn('botones',function($libro){
            $aux='';
            $aux .= '<a href="'. url('book/edit/'.Hashids::encode($libro->id)) .'" class="btn btn-outline-primary m-1 btn-sm ul-btn__icon"><i class="fa fa-pen"></i></a>';
            $aux .='<input type="hidden" name="algo" value="'.($libro->id).'" id="pregunta">';
            $aux .= '<button onclick="delete_book()" class="btn btn-outline-danger m-1 btn-sm ul-btn__icon" id="btn_eliminar" data-inputHidden="'. url('book/edit/'.Hashids::encode($libro->id)) .'" data-value="'. url('book/edit/'.Hashids::encode($libro->id)) .'" id ="btn_eliminar"><i class="fa fa-trash"></i></button >';

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
        $categorias =[
            1=>'Categoria 1',
            2=>'Categoria 2'
        ];
        return view('book.create', compact('categorias'));
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
    public function destroy($id)
    {
        //
    }
}
