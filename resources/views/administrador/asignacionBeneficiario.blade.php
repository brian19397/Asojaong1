@extends('master.master')
@section('name')
    <div class="" id="Asignacion_beneficiario">
        <div class="row">
            <div class="col-md-6">
                <h3>Donantes</h3>
            </div>
            <div class="col-md-6">
                <h3>Beneficiados</h3>
                <button class="btn btn-success align-self-end" id="boton_asignar">Asignar</button>
            </div>
            <div class="col-md-12">
                <label for="">Detalle donación</label>
                <textarea name="detalle" id="detalle" class="form-control"></textarea>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>Cod.</th>
                                <th>Nombre</th>
                                <th>DPI</th>
                                <th></th>
                            </thead>
                            <tbody id="ListadoBeneficiarios">
                                @foreach ($donantes as $donante)
                                    <tr>
                                        <td>{{ $donante->id_donantes }}</td>
                                        <td>{{ $donante->nombre }}</td>
                                        <td>{{ $donante->dpi }}</td>
                                        <td>
                                            <input type="radio" name="donante" id=""
                                                value="{{ $donante->id_donantes }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>Cod.</th>
                                <th>Nombre</th>
                                <th>DPI</th>
                                <th></th>
                            </thead>
                            <tbody id="ListadoBeneficiarios">
                                @foreach ($beneficiarios as $beni)
                                    <tr>
                                        <td>{{ $beni->id_beneficiarios }}</td>
                                        <td>{{ $beni->nombre }}</td>
                                        <td>{{ $beni->dpi }}</td>
                                        <td><input type="checkbox" name="asignar_beni[]" id=""
                                                value="{{ $beni->id_beneficiarios }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#Asignacion_beneficiario').on('click', '#boton_asignar', function() {

                var beneficiados = [];

                const asignar = new Object();

                $("input[type=checkbox]:checked").each(function() {
                    beneficiados.push(this.value);
                });

                asignar.donante = $('input:radio[name=donante]:checked').val();
                asignar.beneficiados = beneficiados;
                asignar.detalle = $("#detalle").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'asignacion_beneficiarios',
                    type: 'post',
                    data: asignar,
                    success: function(data) {

                        if (data.error == 0) {
                            swal("Información", "Asignacion completada con exito", "success");
                            location.reload();
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
    </div>
@endsection
