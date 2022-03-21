
@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
            <div>
                <br>
                <hr>
                <h4>Creando Usuario</h4>
                <br>

            </div>
                    {!! Form::open(array('url'=>'usuarios/store',  'class'=>'form-horizontal','role'=>'form')) !!}

                    <div class="form-group">
                        {!! Form::label('Nombre: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-3 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('name',null,array( 'class' => 'form-control', 'required','onkeypress'=>"return validar(event);")) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Correo Electrónico : ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                            {!! Form::email('email',null,array( 'class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Telefono: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-3 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('phone',null,array( 'class' => 'form-control','maxlength'=>"10",'required','onkeypress'=>"return validNumero(event);")) !!}
                        </div>
                    </div>
                    <div>
                        <br>
                    </div>

                <button  type="submit" class="btn btn-success float-right" id="btn-save-event" > <i class="uil-weight"></i> Guardar </button>

                <a href="{{ url('/usuarios') }}" title="Regresar" class="btn btn-light" style="float: right"><i class="uil-arrow-left "></i> Regresar</a>

            {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
      function validar(e) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla==8) return true; // 3
            patron =/[A-Za-z\s.,-]/; // 4
            te = String.fromCharCode(tecla); // 5
            return patron.test(te); // 6
    }
    </script>
     <script>
        function validNumero(evt) {
               var code = evt.which ? evt.which : evt.keyCode;
               if (code == 8) {
                   //backspace
                   return true;
               } else if (code >= 48 && code <= 57) {
                   //is a number
                   return true;
               } else {
                   return false;
               }
           }
    </script>

@endsection
