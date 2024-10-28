<?php

namespace App\Http\Controllers\api\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;


class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

      return   Source::all();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
     
      


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //\
        $request->validate([
            'name' => 'required|string'
        ]);
        Source::create([
            'name' => $request->name
        ]);
     return response()->json('Successfuly Add Source', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
