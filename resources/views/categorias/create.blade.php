
@extends('layouts.master')

@section('content')
    <div class="breadcrumb">
        <h4>Agregando nueva</h4>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    {!! Form::open(array('url'=>'categorias/store',  'class'=>'form-horizontal','role'=>'form')) !!}

                    <div class="form-group">
                        {!! Form::label('Nombre de la categoria: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-3 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::text('name',null,array( 'class' => 'form-control', 'required','onkeypress'=>"return validar(event);")) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Descripción: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
                        <div class="col-lg-4">
                        {!! Form::textarea('description',null,array( 'class' => 'form-control', 'required' ,'rows'=>3)) !!}
                        </div>
                    </div>

                    <div>
                        <br>
                    </div>

                <button  type="submit" class="btn btn-success float-right" id="btn-save-event" > <i class="uil-weight"></i> Guardar </button>

                <a href="{{ url('/categorias') }}" title="Regresar" class="btn btn-light" style="float: right"><i class="uil-arrow-left "></i> Regresar</a>

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
