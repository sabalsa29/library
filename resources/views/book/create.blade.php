
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
            <div>
                <br>
                <hr>
                <h4>Creando Libro</h4>
                <br>
            </div>
                    {!! Form::open(array('url'=>'book/store',  'class'=>'form-horizontal','role'=>'form')) !!}
                    <div class="form-group">
                        {!! Form::label('Categoria: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                            {!! Form::select('category',$categorias, 0 ,array( 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre del libro: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-3 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('name',null,array( 'class' => 'form-control', 'required','onkeypress'=>"return validar(event);")) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre del Autor: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('name_autor',null,array( 'class' => 'form-control', 'required','onkeypress'=>"return validar(event);")) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre del Autor: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::date('date',$fecha_hoy,array( 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>
                    <div>
                        <br>
                    </div>

                <button  type="submit" class="btn btn-success float-right" id="btn-save-event" > <i class="uil-weight"></i> Guardar </button>

                <a href="{{ url('/book') }}" title="Regresar" class="btn btn-light" style="float: right"><i class="uil-arrow-left "></i> Regresar</a>

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

@endsection
