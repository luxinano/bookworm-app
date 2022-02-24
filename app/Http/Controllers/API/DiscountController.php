<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Discount::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DiscountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        $validated_request = $request->validated();
        $discount = Discount::create($validated_request);

        return response($discount, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return $discount;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
//        $discount = Discount::find($id);
//        if ($discount) {
//            $discount->update($request->all());
//            return response()->json(['message' => 'Updated'], 200);
//        } else {
//            return response()->json(['message' => 'Failed'], 200);
//        }
        $discount->update($request->all());

        return response()->json(['message' => 'Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
