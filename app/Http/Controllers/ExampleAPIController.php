<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\Email\Email;
use Illuminate\Http\Request;

class ExampleAPIController extends Controller
{
    public function getEmail(Request $request)
    {
        $address = $request->input('address');
        $subject = $request->input('subject');
        $email = new Email($address, $subject);
        $domain = $email->getDomain();

        return response()->json([
            'domain' => $domain,
            'email' => $email
        ]);
    }

    public function index()
    {
        return response()->json(Author::all());
    }

    public function store(Request $request)
    {
        $author = Author::create([
            'author_name' => $request->input('name'),
            'author_bio' => $request->input('bio'),
        ]);
        return response()->json(new AuthorResource($author), 201);
    }
}
