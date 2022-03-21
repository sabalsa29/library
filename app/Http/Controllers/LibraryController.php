<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use DataTables;
use Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Twilio\Rest\Client as Twilio;


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
        })->editColumn('date', function($libro){
            $aux    ='';
            if($libro->date != null){
                $aux= date('d-m-Y',strtotime($libro->date));
            }else{
                $aux='N/D';
            }
            return $aux;
        })->editColumn('codigo', function($libro){
            $aux    ='';
            $aux    =str_pad($libro->id, 4, "0", STR_PAD_LEFT);

            return $aux;
        })->escapeColumns([])->make(TRUE);

    }
    public function rentar($hash){
        $id     = Hashids::decode($hash);
        $libro  = Books::find($id[0]);
        $fecha_hoy  = Date::now();
        $usuarios   = Usuarios::where('estatus',1)->pluck('name','id')->toArray();
        return view('book.show', compact('libro', 'fecha_hoy', 'usuarios'));

    }
    public function book_select(Request $req){

        $libro  = Books::find($req->id);
        $libro->estatus=2;
        $libro->usuario_id=$req->usuario_id;
        $libro->save();

        //Esta variable solo es provisional

        $aux=1;

        $this->MessageSender($libro->usuario->name, $libro->name , $libro->usuario->phone, $aux);


        return redirect('/');
       // dd($req->all());
    }
    public function book_select_recuperacion(Request $req){
        $libro  = Books::find($req->id);
        $aux=2;

        $this->MessageSender($libro->usuario->name, $libro->name, $libro->usuario->phone, $aux);

        $libro->estatus     =1;
        $libro->usuario_id  =0;
        $libro->save();



        return redirect('/');
    }
    public function MessageSender($usuario,$libro,$telefono, $aux){
        //Estas variables se encuentran dentro del archivo .env
        //Ojo al trabajar en produccion
        $account_sid    = getenv("TWILIO_ACCOUNT_SID");
        $auth_token     = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number  = getenv("TWILIO_NUMBER");

        if($aux==1){
            $message = 'Hola '.$usuario.' haz solicitado el libro '.$libro;

        }else{
            $message = 'Hola '.$usuario.' haz entregado el libro '.$libro;

        }
        $region = "+52";
        $recipients = $region . $telefono;

        $client = new Twilio($account_sid, $auth_token);

        try {
            $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
        } catch ( \Exception $e ) {
            // echo($e->getMessage());
        }

    }

}
