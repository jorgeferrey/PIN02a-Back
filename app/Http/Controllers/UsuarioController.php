<?php
namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    public function __construct(
        protected UsuarioService $usuarioService
    ){

    }

  
    public function index()
    {
        //
        return $this->usuarioService::getAllUsuarios();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(usuarioRequest $request)
    {
        //
        return $this->usuarioService::createNewUsuario($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
        return $this->usuarioService::getUsuariosById($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        //
        return $this->usuarioService::updateUsuario($request, $usuario);
    }


    public function destroy(Usuario $usuario)
    {
        return $this->usuarioService::deleteUsuario($usuario);
    }

    public function getOnlyTrashed()
    {
        return $this->usuarioService::onlyTrashedUsuario();
    }

    public function restoreTrashed(Usuario $usuario, int $id)
    {
        return $this->usuarioService::restoreTrashedUsuario($usuario, $id);
    }

}
