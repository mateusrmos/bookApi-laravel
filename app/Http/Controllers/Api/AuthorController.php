<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * @return array
     */
    private function getRules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'birthdate' => ['required', 'date']
        ];
    }

    public function list()
    {
        $list = Author::all();
        return new Response(['list' => $list]);
    }

    public function findSingle(Author $author)
    {
        return new Response(['info' => $author]);
    }

    public function createAuthor(Request $request)
    {
        $validator = Validator::make($request->request->all(), $this->getRules());
        if ($validator->fails()) {
            return new Response(['error' => $validator->errors()], Response::HTTP_FORBIDDEN);
        }
        $author = new Author();
        $author->name = $request->request->get('name');
        $author->birthdate = $request->request->get('birthdate');
        $author->save();
        return new Response(['info' => $author]);
    }

    public function updateAuthor(Author $author, Request $request)
    {
        $validator = Validator::make($request->request->all(), $this->getRules());
        if ($validator->fails()) {
            return new Response(['error' => $validator->errors()], Response::HTTP_FORBIDDEN);
        }
        $author->name = $request->request->get('name');
        $author->birthdate = $request->request->get('birthdate');
        $author->save();
        return new Response(['info' => $author]);
    }

    public function deleteAuthor(Author $author)
    {
        $author->delete();
        return new Response(['message' => 'ok']);
    }
}
