<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReviewResource::collection(Review::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request = array_merge($validated_request, ['review_date' => now()]);
        $review = Review::create($validated_request);

        return response(new ReviewResource($review), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->all());

        return new ReviewResource($review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        
            return response()->json(['message' => 'Deleted'], 201);
    }
}
