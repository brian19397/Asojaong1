<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        /**
            Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
            puede ser de altura y anchura completas.
         **/
        @page {
            margin: 0cm 0cm;
        }

        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            text-align: center;

        }

        .imagen {
            text-align: right;
            margin-top: -2%;
        }
    </style>
</head>

<body>
    <div class="imagen">
        <img src="https://scontent.fgua3-4.fna.fbcdn.net/v/t1.6435-9/83241285_784921278658226_5640564001327808512_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=j5KPKxvP8cQAX8Zhg4g&_nc_ht=scontent.fgua3-4.fna&oh=00_AT9PngGh6XjaNYSY0aBvY1xo1Wx2ZUY1cumzwUH4GyBEFA&oe=635FCB2D"
            alt="" width="100">
    </div>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>

        <h3>Reporte de Beneficiarios</h3>
    </header>

    <footer>
        Copyright &copy; <?php echo date('Y'); ?>
    </footer>

    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main>
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
    </main>
</body>

</html>
