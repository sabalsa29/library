

@extends('layouts.master')

@section('content')
    <div class="breadcrumb">
        <h1>Libros</h1>
    </div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <a href="/book/create" class="btn btn-primary">Nuevo Libro</a>
            <div>
                <br>

            </div>
            <div class="card text-left">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaLibros" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Código</th>
                                    <th>Categoria</th>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Fecha Publicaciòn</th>
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
        function delete_bookd() {
           // let id  =  $('#btn_delete').val();
            var id = $(this).data('inputHidden');
            var valor = $(this).data('value');
            console.log(id, valor);
        }
        function delete_book(){

                var id = $('#btn_eliminar').data('inputHidden');
                var valor = $('#btn_eliminar').data('value');

                console.log(id, valor)
               // $('#pregunta-'+id).val(valor);
            }
    </script>
<script>
    $('#tablaLibros').DataTable({
      processing: true,
      serverSide: true,
      pageLength:5,
      stateSave: true,
      ajax: "{!!URL::to('book/datatable')!!}",
      columnDefs: [{
            "defaultContent": "N/D",
            "targets": "_all"
        }],
      columns: [
          {data: 'botones', name: 'botones'},
          {data: 'codigo', name: 'codigo'},
          {data: 'categoria_id', name: 'categoria_id'},
          {data: 'name', name: 'name'},
          {data: 'name_autor', name: 'name_autor'},
          {data: 'date', name: 'date'},
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