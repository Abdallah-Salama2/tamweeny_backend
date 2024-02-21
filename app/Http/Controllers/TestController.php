<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Http\Requests\StoretestRequest;
use App\Http\Requests\UpdatetestRequest;
    use Illuminate\Http\Request;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $test=test::all();
        return $test;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Transform incoming request data to match expected format (lowerCamelCase)
        $requestData = $request->only(['unitPrice']);

        $request->validate([
            'unitPrice' => 'required|string|max:255',
        ]);

        $test = Test::create([
            'unit_price' => $requestData['unitPrice'],
        ]);

        // You don't need to call $test->save() explicitly if you use create() method


        return response()->json([
            'message' => 'Test created successfully',
            'test' => $test,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetestRequest $request, test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(test $test)
    {
        //
    }
}
