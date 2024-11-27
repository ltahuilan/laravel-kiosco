<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return [
            'data' => 'Todo OK desde PedidoController...'
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request['total'];
        $pedido->save();

        //obtener el ID del pedido
        $id = $pedido->id;

        //obtener los productos desde el request
        $productos = $request['productos'];
        
        //formatear correctamente los datos
        $pedido_producto = [];

        foreach ($productos as $producto) {
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        //guardar en la DB
        PedidoProducto::insert($pedido_producto);


        return [
            'message' => 'Muy bien! Tu pedido estará listo muy pronto!'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
