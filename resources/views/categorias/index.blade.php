

@extends('layouts.master')

@section('content')
    <div class="breadcrumb">
        <h1>Categorias</h1>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <a href="/categorias/create" class="btn btn-primary">Nueva Categoria</a>
            <div>
                <br>

            </div>
            <div class="card text-left">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaCategotias" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>

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

@endsection
@section('script')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script>
    $('#tablaCategotias').DataTable({
      processing: true,
      serverSide: true,
      lengthChange: false,
      pageLength:5,
      stateSave: true,
      ajax: "{!!URL::to('categorias/datatable')!!}",
      columnDefs: [{
            "defaultContent": "N/D",
            "targets": "_all"
        }],
      columns: [
          {data: 'id', name: 'id'},
          {data: 'codigo', name: 'codigo'},
          {data: 'name', name: 'name'},
          {data: 'description', name: 'description'},
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
