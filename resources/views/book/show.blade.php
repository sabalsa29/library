
@extends('layouts.master')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <br>
    <div class="breadcrumb">
        <h4>Detalle del Libro</h4>
    </div>
        <div class="col-md-12">
                <div class="card-body">
                    <div class="card">
                    <div class="card-header">
                        {{ $libro->categoria->name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $libro->name }}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Quisque ultricies vulputate lacus, id sollicitudin nibh lacinia vel.
                            Duis urna felis, facilisis id libero eu, feugiat consectetur dolor.
                            In hac habitasse platea dictumst. Sed vestibulum nec erat in interdum.
                            Pellentesque fringilla lorem eu urna dictum laoreet.
                            Sed consectetur dignissim ligula vitae viverra.
                            Duis vel dignissim elit. Quisque porttitor, dui ac
                            luctus interdum, nulla sem fringilla diam, a feugiat augue ipsum at sem.
                            Nunc quis diam rutrum, dapibus nulla sit amet, porttitor augue.
                            Aliquam mauris ipsum, tristique ut felis sit amet, egestas sagittis ante.
                            Ut nec quam non magna malesuada dapibus sit amet vel quam. Sed placerat
                            elit sit amet sem porttitor mattis. Class aptent taciti sociosqu ad litora
                            torquent per conubia nostra, per inceptos himenaeos. Nunc massa leo, pulvinar
                            sed rutrum nec, maximus at nibh. Aenean in dui ex. Vivamus dictum nisl a
                            lacus ornare, quis lacinia sapien sollicitudin. Donec pellentesque, nunc
                            non pharetra vestibulum, libero urna gravida erat, non condimentum ante
                            sem vitae est. Quisque sodales nisi sit amet ex cursus, eget consequat
                            velit varius. Pellentesque consectetur imperdiet massa ac pulvinar.
                            Aliquam quis dolor non diam imperdiet tincidunt dapibus et justo.
                            Vestibulum pharetra magna libero, a faucibus urna vehicula ut.</p>

                            <footer class="blockquote-footer">{{ $libro->name_autor }} <cite title="Source Title">{{ $libro->date }}</cite></footer>
                            @if ($libro->estatus==1)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Prestar Libro
                                </button>
                            @else
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_ingreso">
                                Recuperar Libro
                                </button>
                            @endif

                    </div>
                    </div>

            <div>
                <br>

            </div>
                <a href="{{ url('/') }}" title="Regresar" class="btn btn-light" style="float: right"><i class="uil-arrow-left "></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aceptación del Libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="card-title">{{ $libro->name }}</h5>
        <p class="card-text">Vestibulum pharetra magna libero, a faucibus urna vehicula ut.</p>
        <hr>
        <br>

        {!! Form::open(array('url'=>'library/book_select',  'class'=>'form-horizontal','role'=>'form')) !!}

        <div class="form-group">
            {!! Form::label('Lector: ', null ,array('class'=>'ul-form__label ul-form--margin col-lg-2 col-form-label')) !!}
            <div class="col-lg-8">
                {!! Form::select('usuario_id',$usuarios, 0 ,array( 'class' => 'form-control', 'required',"placeholder" => "--Seleccione--")) !!}
            </div>
        </div>
      </div>

        {{ Form::hidden('id', $libro->id) }}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_ingreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Recuperación del Libro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="card-title">{{ $libro->name }}</h5>
        <p class="card-text">Vestibulum pharetra magna libero, a faucibus urna vehicula ut.</p>
        <hr>
        <br>
        <footer class="blockquote-footer"> El lector <strong> {{ ($libro->usuario_id >0)?$libro->usuario->name:'' }} </strong>entrega el libro el dia <cite title="Source Title">{{ $fecha_hoy }} en perfectas condiciones.</cite></footer>

        {!! Form::open(array('url'=>'library/book_select_recuperacion',  'class'=>'form-horizontal','role'=>'form')) !!}

      </div>

        {{ Form::hidden('id', $libro->id) }}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
@endsection


@section('script')

@endsection
