@extends('master.master')
@section('name')
    <div id="ViewBeneficiario">

        <button class="btn btn-success" id="btnMostrarBeneficiado">Registrar</button>

        <div class="modal" tabindex="-1" id="modalBeneficiado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para registro de beneficiados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formBeneficiado">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                                    <input type="date" id="fecha_nacimiento" class="form-control">
                                </div>
                                <div class="col-sm-6 col-md-6" id="verifica_edad">

                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <label for="dpi">DPI:</label>
                                    <input type="number" id="dpi" class="form-control">
                                    <input type="text" name="mayor_edad" id="mayor_edad" value="" hidden>
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
                        <button type="button" class="btn btn-primary" id="btnRegistrarBeneficiado">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalBeneficiadoEditar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para editar registros</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formBeneficiado">
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
                        <button type="button" class="btn btn-primary" id="editarBeneficiado">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        <p></p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Beneficiados</h6>
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
                            <th>Nacimiento</th>
                            <th>Estado</th>
                            <th>Mayor</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </thead>

                        <tbody id="ListadoBeneficiarios">
                            @foreach ($beneficiarios as $beneficiario)
                                <tr>
                                    <td>{{ $beneficiario->id_beneficiarios }}</td>
                                    <td>{{ $beneficiario->nombre }}</td>
                                    <td>{{ $beneficiario->telefono }}</td>
                                    <td>{{ $beneficiario->direccion }}</td>
                                    <td>{{ $beneficiario->dpi }}</td>
                                    <td>{{ $beneficiario->fecha_nacimiento }}</td>
                                    <td>
                                        @if ($beneficiario->estado == 1)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($beneficiario->mayor_edad == 1)
                                            <span class="badge badge-success">SI</span>
                                        @else
                                            <span class="badge badge-danger">NO</span>     
                                        @endif
                                    </td>

                                    @if ($beneficiario->estado == 1)
                                        <td class="text-center">
                                            <button class="btn btn-success btn-editar"
                                                value="{{ $beneficiario->id_beneficiarios }}"
                                                value="{{ $beneficiario->id_beneficiarios }}">Editar</button>
                                        </td>
                                        <td><button class="btn btn-danger btn-cambiarEstado"
                                                value="{{ $beneficiario->id_beneficiarios }}"
                                                value="{{ $beneficiario->id_beneficiarios }}">Eliminar</button>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-cambiarEstado"
                                                value="{{ $beneficiario->id_beneficiarios }}">Activar</button>
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
        $('#ViewBeneficiario').on('click', '#btnMostrarBeneficiado', function() {
            $('#modalBeneficiado').modal('show');
            $('#verifica_edad').html('');
        });

        function getEdad(dateString) {
            let hoy = new Date()
            let fechaNacimiento = new Date(dateString)
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear()
            let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth()
            if (diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--
            }
            return edad
        }

        $('#ViewBeneficiario').on('change', '#fecha_nacimiento', function() {

            var fecha = $('#fecha_nacimiento').val();
            var replace = fecha.replace("-", "/").replace("-", "/");
            var edad = getEdad(replace);

            if (edad < 18) {
                var datos = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Nota!</strong> El DPI debe ser del tutor o encargado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;
                $('#verifica_edad').html(datos);
                $('#mayor_edad').val(0);
            } else {
                $('#verifica_edad').html('');
                $('#mayor_edad').val(1);
            }
        });

        function beneficiados() {
            $.ajax({
                url: 'obtenerBeneficiario',
                type: 'get',

                success: function(data) {
                    var lista = '';
                    data.beneficiarios.map(beneficiario => {

                        var estado = beneficiario.estado == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Activo</span>';

                        var edad = beneficiario.mayor_edad == 1 ?
                            '<span class="badge badge-success">SI</span>' :
                            '<span class="badge badge-danger">NO</span>';


                        var opciones = beneficiario.estado == 1 ?
                            '<td> <button class="btn btn-success btn-editar" value="' + beneficiario
                            .id_beneficiarios + '">Editar</button> ' +
                            '<button class="btn btn-danger btn-cambiarEstado"value="' + beneficiario
                            .id_beneficiarios + '">Eliminar</button></td>' :
                            '<td><button class="btn btn-primary btn-cambiarEstado" value="' +
                            beneficiario
                            .id_beneficiarios + '">Activar</button></td>';

                        lista +=
                            '<tr> ' +
                            '<td>' + beneficiario.id_beneficiarios + '</td> ' +
                            '<td>' + beneficiario.nombre + '</td> ' +
                            '<td>' + beneficiario.telefono + '</td> ' +
                            '<td>' + beneficiario.direccion + '</td> ' +
                            '<td>' + beneficiario.dpi + '</td> ' +
                            '<td>' + beneficiario.fecha_nacimiento + '</td> ' +
                            '<td class="text-center">' + estado + '</td>' +
                            '<td>' + edad + '</td>' +
                            '<td class="text-center">' + opciones + '</td>' +
                            '</tr> ';
                    });

                    $('#ListadoBeneficiarios').html(lista)
                },
                error: function(data) {
                    console.log(data);
                    swal("Información", "Se produjo un error al querer actualizar los datos", "error");
                }
            });
        }

        $('#ViewBeneficiario').on('click', '#btnRegistrarBeneficiado', function() {

            const registroBeneficiados = new Object();

            registroBeneficiados.nombre = $('#nombre').val();
            registroBeneficiados.dpi = $('#dpi').val();
            registroBeneficiados.telefono = $('#telefono').val();
            registroBeneficiados.fecha_nacimiento = $('#fecha_nacimiento').val();
            registroBeneficiados.direccion = $('#direccion').val();
            registroBeneficiados.mayor_edad = $('#mayor_edad').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'registroBeneficiado',
                type: 'post',
                data: registroBeneficiados,

                success: function(data) {

                    console.log(data);
                    if (data.error == 0) {
                        beneficiados();
                        $('#modalBeneficiado').modal('hide');
                        $('#formBeneficiado')[0].reset();
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

        $('#ViewBeneficiario').on('click', '.btn-editar', function() {
            //$('#modalDonantesEditar').modal('show');

            var id_beneficiarios = $(this).val();

            $.ajax({
                url: 'obtenerId_beneficiados/' + id_beneficiarios,
                type: 'get',
                success: function(data) {
                    $('#nombreEditar').val(data.nombre);
                    $('#dpiEditar').val(data.dpi);
                    $('#telefonoEditar').val(data.telefono);
                    $('#direccionEditar').val(data.direccion);
                    $('#fecha_nacimientoEditar').val(data.fecha_nacimiento);
                    $('#modalBeneficiadoEditar').modal('show');
                    $('#editarBeneficiado').val(data.id_beneficiarios);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        });

        $('#ViewBeneficiario').on('click', '#editarBeneficiado', function() {

            const registroBeneficiados = new Object();

            registroBeneficiados.nombre = $('#nombreEditar').val();
            registroBeneficiados.dpi = $('#dpiEditar').val();
            registroBeneficiados.telefono = $('#telefonoEditar').val();
            registroBeneficiados.direccion = $('#direccionEditar').val();
            registroBeneficiados.fecha_nacimiento = $('#fecha_nacimientoEditar').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'actualizarBeneficiarios/' + $('#editarBeneficiado').val(),
                type: 'put',
                data: registroBeneficiados,

                success: function(data) {

                    if (data.error == 0) {
                        beneficiados();
                        $('#modalBeneficiadoEditar').modal('hide');
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

        $('#ViewBeneficiario').on('click', '.btn-cambiarEstado', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'eliminarBeneficiario/' + $(this).val(),
                type: 'put',
                success: function(data) {

                    if (data.error == 0) {
                        beneficiados();
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
