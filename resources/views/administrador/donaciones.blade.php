@extends('master.master')
@section('name')
    <div id="donaciones">
        <button class="btn btn-success" id="registrar_donaciones">Registrar</button>

        <div class="modal" tabindex="-1" id="modal_donaciones">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Formulario para registrar donaciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" id="formulario_registro">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nombre</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control">
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
        <script>
            $('#donaciones').on('click', '#registrar_donaciones', function(){
                $('#modal_donaciones').modal('show');
            });
        </script>
    </div>
@endsection
