<?php

namespace App\Services;

use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Mail\StoreUsuarioEmail;
use App\Models\Usuario;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;

class UsuarioService
{
    public static function getAllUsuarios(): JsonResource
    {
        return UsuarioResource::collection(Usuario::all());
    }

    public static function getUsuariosById(Usuario $usuario): JsonResource
    {
        return new UsuarioResource($usuario);
    }

    public static function createNewUsuario(UsuarioRequest $usuario): JsonResource
    {
        $usuario = Usuario::create([
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'domicilio'=>$usuario->domicilio,
            'telefono'=>$usuario->telefono,
            'email' => $usuario->email,
            'contenido'=>$usuario->contenido,
            
        ]);
        // Cuando se registra un nuevo usuario envia un email confirmando

        self::sendMailCreateUsuario($usuario);

        return new UsuarioResource($usuario);
    }

    public static function updateUsuario(UsuarioRequest $request, Usuario $usuario): JsonResource
    {
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->domicilio=$request->domicilio;
        $usuario->telefono=$request->telefono;
        $usuario->email=$request->email;
        $usuario->contenido=$request->contenido;
        $usuario->save();

        return new UsuarioResource($usuario);
    }

    public static function deleteUsuario(Usuario $usuario): JsonResource
    {
        $usuario->delete();

        return new UsuarioResource($usuario);
    }

    public static function onlyTrashedUsuario(): JsonResource
    {
        return UsuarioResource::collection(UsuarioRequest::onlyTrashed()->get());
    }

    public static function restoreTrashedUsuario(Usuario $usuario, int $id): JsonResource
    {
        // Unlinks the logical deletion constraint and finds the model by its ID,
        // including the logically deleted records.
        $restoredUsuario = $usuario->withTrashed()->findOrFail($id);
        // Check if the deleted model was found
        if ($restoredUsuario) {
            // Restore the model
            $restoredUsuario->restore();

            // Return the restored Person resource
            return new UsuarioResource($restoredUsuario);
        } else {
            // Handle the case where the deleted model was not found.
            throw new \Exception('No se encontró el usuario para restaurar');
        }
    }

    public static function sendMailCreateUsuario(Usuario $usuario)
    {
        $details = [
            'nombre' => 'Se agrego: '.$usuario->nombre.', '.$usuario->apellido,
            'mje' => 'Bienvenido a Tu Viaje, pronto nos pondremos en contacto contigo...',
        ];

        Mail::to('jorgeferrey@gmail.com')->send(new StoreUsuarioEmail($details));
    }
}
