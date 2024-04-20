<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'usuario_id' => $this->usuario_id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'domicilio'=>$this->domicilio,
            'telefono'=>$this->telefono,
            'correo' => $this->email,
            'contenido'=>$this->contenido,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}