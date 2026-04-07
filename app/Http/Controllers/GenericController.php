<?php

namespace App\Http\Controllers;

use App\Models\Generic;
use App\Http\Requests\StoreGenericRequest;
use App\Http\Requests\UpdateGenericRequest;

class GenericController extends Controller
{
    public function index()
    {
        $generics = Generic::latest()->paginate(10);

        return response()->json($generics);
    }

    public function store(StoreGenericRequest $request)
    {
        $generic = Generic::create($request->validated());

        return response()->json($generic, 201);
    }

    public function show(Generic $generic)
    {
        return response()->json($generic);
    }

    public function update(UpdateGenericRequest $request, Generic $generic)
    {
        $generic->update($request->validated());

        return response()->json($generic);
    }

    public function destroy(Generic $generic)
    {
        $generic->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}