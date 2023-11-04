@extends('master.master')
@section('name')
    <div class="" id="reporte_beni">
        <h4>Listado de todos los Beneficiados</h4>
        <a class="btn btn-success" href="{{Route('descargar_pdf_factura')}}">Descargar <i class="fa fa-download" aria-hidden="true"></i></a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody id="ListadoBeneficiarios">
                        @foreach ($beneficiarios as $beneficiado)
                            <tr style="background: #4B70DD; color: #fff">
                                <td colspan="5">Donante: {{ $beneficiado->nombre }}</td>
                            </tr>
                            <tr>
                                <td>Cod.</td>
                                <td>Nombre</td>
                                <td>Direccion</td>
                                <td>DPI</td>
                                <td>Detalle donación</td>
                            </tr>
                            <tr>
                                @foreach ($asignaciones as $asignacion)
                                    @if ($asignacion->id_donantes == $beneficiado->id_donantes)
                            <tr>
                                <td>{{ $asignacion->id_beneficiarios }}</td>
                                <td>{{ $asignacion->nombre }}</td>
                                <td>{{ $asignacion->direccion }}</td>
                                <td>{{ $asignacion->dpi }}</td>
                                <td>{{$asignacion->detalle}}</td>
                            </tr>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
