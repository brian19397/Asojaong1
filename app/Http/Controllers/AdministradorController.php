<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Donante;
use App\Models\Beneficiario;
use App\Models\AsignarBeneficiado;
use App\Models\Post;
use App\Models\PostImage;
use PDF;
use Exception;

class AdministradorController extends Controller
{

    public function obtener()
    {
        $donantes = Donante::where('estado', 1)->get();

        return ['donantes' => $donantes];
    }

    public function donantes()
    {

        $donantes = Donante::where('estado', 1)->get();

        return view('administrador.donantes', ['donantes' => $donantes]);
    }

    public function registro(Request $request)
    {

        if ($request->nombre == null || $request->dpi == null || $request->telefono == null || $request->direccion == null) {
            return ['error' => 1, 'mensaje' => 'uno o cmas campos, no cumplen el formato solicitado'];
        }

        $donantes = new Donante;

        $donantes->nombre = $request->nombre;
        $donantes->telefono = $request->telefono;
        $donantes->dpi = $request->dpi;
        $donantes->direccion = $request->direccion;

        $donantes->save();

        if ($donantes) {
            return ['error' => 0, 'mensaje' => 'Registro guardado correctamante'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo registrar'];
    }

    public function obtenerId_donantes($id_donantes)
    {

        $donantes = Donante::where('id_donantes', $id_donantes)->first();

        return $donantes;
    }

    public function actualizar(Request $request, $id_donantes)
    {
        $donantes = Donante::findOrFail($id_donantes);

        $donantes->nombre = $request->nombre;
        $donantes->telefono = $request->telefono;
        $donantes->dpi = $request->dpi;
        $donantes->direccion = $request->direccion;

        $donantes->save();

        if ($donantes) {
            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo actualizar'];
    }

    public function eliminar($id_donantes)
    {
        $donantes = Donante::findOrFail($id_donantes);


        $donantes->estado = !$donantes->estado;

        $donantes->save();

        if ($donantes) {
            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo actualizar'];
    }

    public function beneficiarios()
    {

        $beneficiarios = Beneficiario::where('estado', 1)->get();

        return view('administrador.beneficiarios', ['beneficiarios' => $beneficiarios]);
    }

    public function obtenerBeneficiario()
    {

        $beneficiarios = Beneficiario::where('estado', 1)->get();

        return ['beneficiarios' => $beneficiarios];
    }

    public function registroBeneficiado(Request $request)
    {

        if ($request->nombre == null || $request->dpi == null || $request->telefono == null || $request->direccion == null) {
            return ['error' => 1, 'mensaje' => 'uno o cmas campos, no cumplen el formato solicitado'];
        }

        $beneficiarios = new Beneficiario;

        $beneficiarios->nombre = $request->nombre;
        $beneficiarios->telefono = $request->telefono;
        $beneficiarios->dpi = $request->dpi;
        $beneficiarios->direccion = $request->direccion;
        $beneficiarios->mayor_edad = $request->mayor_edad;
        $beneficiarios->fecha_nacimiento = $request->fecha_nacimiento;

        $beneficiarios->save();

        if ($beneficiarios) {
            return ['error' => 0, 'mensaje' => 'Registro guardado correctamante'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo registrar'];
    }

    public function obtenerId_beneficiados($id_beneficiados)
    {

        $beneficiarios = Beneficiario::where('id_beneficiarios', $id_beneficiados)->first();

        return $beneficiarios;
    }

    public function actualizarBeneficiarios(Request $request, $id_beneficiados)
    {
        $beneficiarios = Beneficiario::findOrFail($id_beneficiados);

        $beneficiarios->nombre = $request->nombre;
        $beneficiarios->telefono = $request->telefono;
        $beneficiarios->dpi = $request->dpi;
       // $beneficiarios->fecha_nacimiento = $request->fecha_nacimiento;
        $beneficiarios->direccion = $request->direccion;

        $beneficiarios->save();

        if ($beneficiarios) {
            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo actualizar'];
    }

    //actualizarBeneficiarios eliminarBeneficiario
    public function eliminarBeneficiario($id_beneficiados)
    {
        $beneficiarios = Beneficiario::findOrFail($id_beneficiados);


        $beneficiarios->estado = !$beneficiarios->estado;

        $beneficiarios->save();

        if ($beneficiarios) {
            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        }

        return ['error' => 1, 'mensaje' => 'No se pudo actualizar'];
    }

    public function asignar_beneficiados()
    {

        $donantes = Donante::where('estado', 1)->get();
        $beneficiarios = Beneficiario::where('estado', 1)
            ->where('beneficio', 0)
            ->get();

        return view('administrador.asignacionBeneficiario', [
            'donantes' => $donantes,
            'beneficiarios' => $beneficiarios
        ]);
    }

    public function asignacion_beneficiarios(Request $request)
    {

        try {

            DB::beginTransaction();

            for ($i = 0; $i < count($request->beneficiados); $i++) {

                $asignacion = new AsignarBeneficiado;

                $asignacion->id_donantes = $request->donante;
                $asignacion->id_beneficiarios = $request->beneficiados[$i];
                $asignacion->detalle = $request->detalle;

                $asignacion->save();

                $beneficiarios = Beneficiario::findOrFail($request->beneficiados[$i]);

                $beneficiarios->beneficio = 1;

                $beneficiarios->save();
            }

            DB::commit();

            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        } catch (Exception $e) {

            DB::rollback();
            return ['error' => 1, 'mensaje' => 'No se pudo actualizar ' . $e->getMessage()];
        }
    }

    public function reporte_asignaciones_bene(Request $request)
    {

        //$pdf = PDF::loadView('administrador.imprimirReporteAsginaciones');
        //return $pdf->download('ejemplo.pdf');

        $beneficiarios = AsignarBeneficiado::join('donantes', 'donantes.id_donantes', 'asignacion_beneficiarios.id_donantes')
            ->select('donantes.id_donantes', 'donantes.nombre')
            ->distinct()
            ->where('donantes.estado', 1)
            ->get();

        $asignaciones = AsignarBeneficiado::join('beneficiarios', 'beneficiarios.id_beneficiarios', 'asignacion_beneficiarios.id_beneficiarios')
            ->select('beneficiarios.*', 'asignacion_beneficiarios.id_donantes', 'asignacion_beneficiarios.detalle')
            ->get();

        return view('administrador.reporteBeneficiario', [
            'beneficiarios' => $beneficiarios,
            'asignaciones' => $asignaciones
        ]);
    }

    public function descargar_pdf_factura()
    {
        $beneficiarios = AsignarBeneficiado::join('donantes', 'donantes.id_donantes', 'asignacion_beneficiarios.id_donantes')
            ->select('donantes.id_donantes', 'donantes.nombre')
            ->distinct()
            ->where('donantes.estado', 1)
            ->get();

        $asignaciones = AsignarBeneficiado::join('beneficiarios', 'beneficiarios.id_beneficiarios', 'asignacion_beneficiarios.id_beneficiarios')
            ->select('beneficiarios.*', 'asignacion_beneficiarios.id_donantes', 'asignacion_beneficiarios.detalle')
            ->get();

        $pdf = PDF::loadView('administrador.imprimirReporteAsginaciones',  [
            'beneficiarios' => $beneficiarios,
            'asignaciones' => $asignaciones
        ]);

        $fecha = date('Y-m-d');


        return $pdf->download('Reporte Beneficiados ' . $fecha . '.pdf');
    }

    public function post()
    {

        $posts = Post::join('post_imagen', 'post_imagen.IdPost', 'post.IdPost')
            ->select('post.*')
            ->distinct()
            ->where('post.estado', 1)
            ->where('post_imagen.estado', 1)
            ->get();

        $imagenes = Post::join('post_imagen', 'post_imagen.IdPost', 'post.IdPost')
            ->select('post_imagen.IdPost', 'post_imagen.imagen', 'post_imagen.link')
            ->where('post.estado', 1)
            ->where('post_imagen.estado', 1)
            ->get();

        return view('administrador.post', [
            'posts' => $posts,
            'imagenes' => $imagenes
        ]);
    }

    public function post_crear(Request $request)
    {

        try {

            DB::beginTransaction();

            $post = new Post;

            $post->titulo = $request->titulo;
            $post->descripcion = $request->descripcion;
            $post->fecha = $request->fecha;

            $post->save();

            if ($request->ckeck == 'on') {
                $postImagen = new PostImage;

                $postImagen->IdPost = $post->IdPost;
                $postImagen->imagen = $request->imagen;
                $postImagen->link = 0;
                $postImagen->save();
            } else {

                for ($i = 0; $i < count($request->imagen); $i++) {

                    $file = $request->file('imagen')[$i];
                    $extension = $file->getClientOriginalExtension();

                    $postImagen = new PostImage;

                    $postImagen->IdPost = $post->IdPost;
                    $postImagen->imagen = 'link';
                    $postImagen->link = 1;
                    $postImagen->save();

                    $nombre = 'post_' . $post->IdPost . '_' . $postImagen->IdPostImagen . '.' . $extension;

                    $nombreImagen = PostImage::findOrFail($postImagen->IdPostImagen);
                    $nombreImagen->imagen = 'imagen/' . 'post' . '/' . $nombre;
                    $nombreImagen->save();

                    Storage::disk('local')->put('public/imagen/' . 'post' . '/' . $nombre, \File::get($file));
                }
            }
            DB::commit();

            return ['error' => 0, 'mensaje' => 'Registro actualizado correctamente'];
        } catch (Exception $e) {
            DB::rollback();
            return ['error' => 1, 'mensaje' => 'No se pudo actualizar ' . $e->getMessage()];
        }
    }

    public function eliminar_post(Request $request)
    {

        try {

            DB::beginTransaction();

            $eliminarPost = Post::findOrFail($request->IdPost);

            $eliminarPost->estado = 0;

            $eliminarPost->save();

            PostImage::where('IdPost', $request->IdPost)
                ->update(['estado' => 0]);

            DB::commit();

            return ['error' => 0, 'mensaje' => 'Registro eliminado correctamente'];
        } catch (Exception $e) {
            DB::rollback();
            return ['error' => 1, 'mensaje' => 'No se pudo actualizar ' . $e->getMessage()];
        }
    }

    public function donaciones(){

        return view('administrador.donaciones');
    }
}
