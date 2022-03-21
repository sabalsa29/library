

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="breadcrumb" >
                <h1>Usuarios</h1>
            </div>
            <a href="/usuarios/create" class="btn btn-primary">Nuevo Usuario</a>
            <div>
                <br>

            </div>
            <div class="card text-left">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaUsuarios" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tipo</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>

<script>
    $('#tablaUsuarios').DataTable({
      processing: true,
      serverSide: true,
      lengthChange: false,
      pageLength:5,
      stateSave: true,
      ajax: "{!!URL::to('usuarios/datatable')!!}",
      columnDefs: [{
            "defaultContent": "N/D",
            "targets": "_all"
        }],
      columns: [
          {data: 'id', name: 'id'},
          {data: 'tipo', name: 'tipo'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
      ],
      order: [],
      language: {
                   "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
      }

      });

</script>

@endsection
