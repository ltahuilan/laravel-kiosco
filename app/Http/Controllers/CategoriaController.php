<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class CategoriaController extends Controller
{
    //
    public function index() {
        // return response()->json(['categorias' => Categoria::all()]);

        /**
         * La definicion de los campos se realiza en el resource CategoriaResource
         * Se retornan creando una instancia de CategoriaResource
         */
        return new CategoriaCollection(Categoria::all());
    }
}
