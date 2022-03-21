@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card-body">
            <div>
                <br>
                <hr>
                <h4>Bienvenido a tu Biblioteca</h4>
                <br>

            </div>
                    <div class="table-responsive">
                        <table id="tablaLibrosDisponibles" class="display table table-striped table-bordered" style="width:100%">
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
                                <tr>
                                    <td></td>
                                    <td>123421</td>
                                    <td>terrror</td>
                                    <td>Gas</td>
                                    <td> Arturo</td>
                                    <td>443</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
