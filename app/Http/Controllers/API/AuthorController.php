<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Author::orderBy('author_name')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        $validated_r = $request->validated();
        $author = Author::create($validated_r);

        return response()->json(['Successfully' => $author], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $author = Author::find($id);
        if ($author)
            return response()->json(['Found' => $author], 201);
        else
            return response()->json(['Message' => 'Not Found'], 404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->update($request->all());
            return response()->json(['message' => 'Updated'], 200);
        } else {
            return response()->json(['message' => 'Failed'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
        $author->delete();
        return response()->json(['message' => 'Deleted'], 200);

    }
}
