@extends('master.master')
@section('name')
    <div id="ViewDonates">

        <button class="btn btn-success" id="btnMostrarDonates">Registrar</button>

        <div class="modal" tabindex="-1" id="modalDonantes">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para registro de donantes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formDonante">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="dpi">DPI:</label>
                                    <input type="number" id="dpi" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="telefono">Telefono:</label>
                                    <input type="number" id="telefono" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="direccion">Direción:</label>
                                    <textarea id="direccion" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnRegistrarDonates">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalDonantesEditar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para editar registros</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formDonante">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombreEditar" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="dpi">DPI:</label>
                                    <input type="number" id="dpiEditar" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="telefono">Telefono:</label>
                                    <input type="number" id="telefonoEditar" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="direccion">Direción:</label>
                                    <textarea id="direccionEditar" class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="editarDonantes">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        <p></p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Donantes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Cod.</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Dirección</th>
                            <th>DPI</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Cod.</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
                                <th>DPI</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody id="ListadoDonantes">
                            @foreach ($donantes as $donante)
                                <tr>
                                    <td>{{ $donante->id_donantes }}</td>
                                    <td>{{ $donante->nombre }}</td>
                                    <td>{{ $donante->telefono }}</td>
                                    <td>{{ $donante->direccion }}</td>
                                    <td>{{ $donante->dpi }}</td>
                                    <td>
                                        @if ($donante->estado == 1)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>

                                    @if ($donante->estado == 1)
                                        <td class="text-center">
                                            <button class="btn btn-success btn-editar" value="{{ $donante->id_donantes }}"
                                                value="{{ $donante->id_donantes }}">Editar</button>
                                            <button class="btn btn-danger btn-cambiarEstado"
                                                value="{{ $donante->id_donantes }}"
                                                value="{{ $donante->id_donantes }}">Eliminar</button>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-cambiarEstado"
                                                value="{{ $donante->id_donantes }}">Activar</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#ViewDonates').on('click', '#btnMostrarDonates', function() {
            $('#modalDonantes').modal('show');
        });

        function donantes() {
            $.ajax({
                url: 'obtener',
                type: 'get',

                success: function(data) {
                    var lista = '';
                    data.donantes.map(donante => {

                        var estado = donante.estado == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Activo</span>';


                        var opciones = donante.estado == 1 ?
                            ' <button class="btn btn-success btn-editar" value="' + donante
                            .id_donantes + '">Editar</button> ' +
                            '<button class="btn btn-danger btn-cambiarEstado"value="' + donante
                            .id_donantes + '">Eliminar</button>' :
                            ' <button class="btn btn-primary btn-cambiarEstado" value="' + donante
                            .id_donantes + '">Activar</button>';

                        lista +=
                            '<tr> ' +
                            '<td>' + donante.id_donantes + '</td> ' +
                            '<td>' + donante.nombre + '</td> ' +
                            '<td>' + donante.telefono + '</td> ' +
                            '<td>' + donante.direccion + '</td> ' +
                            '<td>' + donante.dpi + '</td> ' +
                            '<td class="text-center">' + estado + '</td>' +
                            '<td class="text-center">' + opciones + '</td>' +
                            '</tr> ';
                    });

                    $('#ListadoDonantes').html(lista)
                },
                error: function(data) {
                    console.log(data);
                    swal("Información", "Se produjo un error al querer actualizar los datos", "error");
                }
            });
        }

        $('#ViewDonates').on('click', '#btnRegistrarDonates', function() {

            const registroDonates = new Object();

            registroDonates.nombre = $('#nombre').val();
            registroDonates.dpi = $('#dpi').val();
            registroDonates.telefono = $('#telefono').val();
            registroDonates.direccion = $('#direccion').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'registro',
                type: 'post',
                data: registroDonates,

                success: function(data) {

                    if (data.error == 0) {
                        donantes();
                        $('#modalDonantes').modal('hide');
                        $('#formDonante')[0].reset();
                        swal("Información", "Registro completado con exito", "success");
                    } else {
                        swal("Información", "Se produjo un error", "error");
                    }
                },
                error: function(data) {
                    console.log(data);
                    swal("Información", "Se produjo un error", "error");
                }
            });
        });

        $('#ViewDonates').on('click', '.btn-editar', function() {
            //$('#modalDonantesEditar').modal('show');

            var id_donantes = $(this).val();

            $.ajax({
                url: 'obtenerId_donantes/' + id_donantes,
                type: 'get',
                data: {
                    id_donantes: id_donantes
                },
                success: function(data) {
                    $('#nombreEditar').val(data.nombre);
                    $('#dpiEditar').val(data.dpi);
                    $('#telefonoEditar').val(data.telefono);
                    $('#direccionEditar').val(data.direccion);
                    $('#modalDonantesEditar').modal('show');
                    $('#editarDonantes').val(data.id_donantes);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        });

        $('#ViewDonates').on('click', '#editarDonantes', function() {

            const registroDonates = new Object();

            registroDonates.nombre = $('#nombreEditar').val();
            registroDonates.dpi = $('#dpiEditar').val();
            registroDonates.telefono = $('#telefonoEditar').val();
            registroDonates.direccion = $('#direccionEditar').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'actualizar/' + $('#editarDonantes').val(),
                type: 'put',
                data: registroDonates,

                success: function(data) {

                    if (data.error == 0) {
                        donantes();
                        $('#modalDonantesEditar').modal('hide');
                        swal("Información", "Registro actualizado con exito", "success");
                    } else {
                        swal("Información", "Se produjo un error", "error");
                    }
                },
                error: function(data) {
                    console.log(data);
                    swal("Información", "Se produjo un error", "error");
                }
            });
        });

        $('#ViewDonates').on('click', '.btn-cambiarEstado', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var estado = 0;

            $.ajax({
                url: 'eliminar/' + $(this).val(),
                type: 'put',
                success: function(data) {

                    if (data.error == 0) {
                        donantes();
                        swal("Información", "Registro eliminado con exito", "success");
                    } else {
                        swal("Información", "Se produjo un error", "error");
                    }
                },
                error: function(data) {
                    console.log(data);
                    swal("Información", "Se produjo un error", "error");
                }
            });
        });
    </script>
@endsection
