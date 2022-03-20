
@extends('layouts.master')

@section('content')
    <div class="breadcrumb">
        <h4>Agregando nuevo</h4>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
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
                        {!! Form::text('name',null,array( 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre del Autor: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('name_autor',null,array( 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Nombre del Autor: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::date('date',null,array( 'class' => 'form-control', 'required')) !!}
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
