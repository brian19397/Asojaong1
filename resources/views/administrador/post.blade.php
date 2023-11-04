@extends('master.master')
@section('name')
    <div id="post">
        <h4>Crea los post</h4>
        <button class="btn btn-success" id="btn_mostrar_modal">Crear <i class="fa fa-plus-circle"
                aria-hidden="true"></i></button>

        <div class="modal" tabindex="-1" id="modalPost">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para crear Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" id="formulario_registro">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Titulo</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Descripción</label>
                                    <input type="text" name="descripcion" id="descripcion" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Fecha</label>
                                    <input type="date" name="fecha" id="descripcion" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Youtube</label>
                                    <input type="checkbox" name="ckeck" id="ckeck" class="form-control">
                                </div>
                                <div class="col-md-6" id="fotos_opcion">
                                    <label for="">Fotos</label>
                                    <input type="file" multiple name="imagen[]" id="imagen" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnRegistroPost">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Cod.</th>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th colspan="2">Opciones</th>
                    </thead>
                    <tbody id="ListadoBeneficiarios">
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->IdPost }}</td>
                                <td>{{ $post->titulo }}</td>
                                <td>{{ $post->descripcion }}</td>
                                <td>{{ $post->fecha }}</td>
                                <td>
                                    <button class="btn btn-danger eliminar_post" value="{{ $post->IdPost }}"><i
                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr>
                                @foreach ($imagenes as $imagen)
                                    @if ($post->IdPost == $imagen->IdPost)
                                        @if ($imagen->link == 1)
                                            <td>
                                                <img src="{{ asset('/storage/' . $imagen->imagen) }}" alt=""
                                                    width="100">
                                            </td>
                                        @else
                                        <td>
                                            {!!$imagen->imagen!!}
                                        </td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $('#post').on('click', '#ckeck', function() {
                if (!$('#ckeck').is(':checked')) {

                    var html = `
                    <label for="">Fotos</label>
                    <input type="file" multiple name="imagen[]" id="imagen" class="form-control">
                    `;
                    $('#fotos_opcion').html(html);
                } else {
                    var html = `
                    <label for="">Video</label>
                    <textarea name="imagen" id="imagen" class="form-control"></textarea>
                    `;
                    $('#fotos_opcion').html(html);
                }
            });

            $('#post').on('click', '#btn_mostrar_modal', function() {
                $('#modalPost').modal('show');
            });

            $('#post').on('click', '#btnRegistroPost', function() {

                var formData = new FormData($('#formulario_registro')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'post_crear',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(data) {
                        if (data.error == 0) {
                            swal("Información", "El post fue creado con exito", "success");
                            location.reload();
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            });

            $('#post').on('click', '.eliminar_post', function() {

                var IdPost = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'eliminar_post',
                    type: 'post',
                    data: {
                        IdPost: IdPost
                    },

                    success: function(data) {
                        if (data.error == 0) {
                            swal("Información", "Publicación eliminada correctamente", "success");
                            location.reload();
                        } else {
                            swal("Información", "Se produjo un error al intentar eliminar", "error");
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        swal("Información", "Se produjo un error al intentar eliminar", "error");
                    }
                });


            });
        </script>
    </div>
@endsection
