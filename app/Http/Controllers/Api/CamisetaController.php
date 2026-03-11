<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camiseta;
use Illuminate\Http\Request;

class CamisetaController extends Controller
{
    public function index()
    {
        $camisetas = Camiseta::with('pedido')->get();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Listado de camisetas obtenido correctamente',
            'data' => $camisetas
        ], 200);
    }

    public function show($id)
    {
        $camiseta = Camiseta::with('pedido')->find($id);

        if (!$camiseta) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Camiseta no encontrada',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Camiseta obtenida correctamente',
            'data' => $camiseta
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo' => 'required|string|max:100',
            'temporada' => 'required|string|max:20',
            'talla' => 'required|string|max:5',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'estado' => 'required|string|max:30',
            'fecha_alta' => 'required|date',
            'pedido_id' => 'nullable|integer|exists:pedidos,id'
        ]);

        $camiseta = Camiseta::create($validated);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Camiseta creada correctamente',
            'data' => $camiseta
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $camiseta = Camiseta::find($id);

        if (!$camiseta) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Camiseta no encontrada',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'equipo' => 'required|string|max:100',
            'temporada' => 'required|string|max:20',
            'talla' => 'required|string|max:5',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'estado' => 'required|string|max:30',
            'fecha_alta' => 'required|date',
            'pedido_id' => 'nullable|integer|exists:pedidos,id'
        ]);

        $camiseta->update($validated);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Camiseta actualizada correctamente',
            'data' => $camiseta
        ], 200);
    }

    public function destroy($id)
    {
        $camiseta = Camiseta::find($id);

        if (!$camiseta) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Camiseta no encontrada',
                'data' => null
            ], 404);
        }

        $camiseta->delete();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Camiseta eliminada correctamente',
            'data' => null
        ], 200);
    }
}