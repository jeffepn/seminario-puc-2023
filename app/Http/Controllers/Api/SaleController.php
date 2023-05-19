<?php

namespace App\Http\Controllers\Api;

use App\Events\SaleCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SaleResourceCollection;
use App\Models\ItemSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new SaleResourceCollection(Sale::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleStoreRequest $request)
    {
        $sale = Sale::create($request->only(['user_id', 'client_id']));

        $items = collect($request->input('items'));

        $sale->items()->saveMany(
            $items->map(fn($currentItem) => new ItemSale($currentItem))
        );

        // Emitir um evento de criação de venda
        event(new SaleCreated($sale->id));

        return response([
            'message' => "A venda foi cadastrada com sucesso!!",
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return new SaleResource($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response([
            'message' => "A venda foi deletada com sucesso!!",
        ], Response::HTTP_OK);
    }
}
