<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'title' =>   ['required', 'min:3', 'max:255'],
            'launchDate' => ['required', 'date'],
            'author' => ['required', 'exists:authors,id']
        ];
    }

    /**
     * List All Books
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $listRules = ['author' => ['exists:authors,id']];
        $validator = Validator::make($request->request->all(), $listRules);
        if ($validator->fails()) {
            return new Response(['error' => $validator->errors()], Response::HTTP_FORBIDDEN);
        }
        $author = $request->request->get('author');
        $bookList = array();
        if (!empty($author)) {
            $bookList = Book::with('author')->where(compact('author'))->get();
        } else {
            $bookList = Book::with('author')->get();
        }

        return new Response(['list' => $bookList]);
    }

    /**
     * @param Book $book
     *
     * @return \Illuminate\Http\Response
     */
    public function findSingle(Book $book)
    {
        return new Response(['info' => $book->load('author')]);
    }

    /**
     * @param Book $book
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createBook(Book $book, Request $request)
    {
        $validator = Validator::make($request->request->all(), $this->getRules());
        if ($validator->fails()) {
            return new Response(['error' => $validator->errors()], Response::HTTP_FORBIDDEN);
        }
        $book->title = $request->request->get('title');
        $book->launchDate = $request->request->get('launchDate');
        $book->author = $request->request->get('author');
        $book->save();
        return new Response(['info' => $book->load('author')], Response::HTTP_CREATED);
    }

    /**
     * @param Book $book
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Book $book, Request $request)
    {
        $validator = Validator::make($request->request->all(), $this->getRules());
        if ($validator->fails()) {
            return new Response(['error' => $validator->errors()], Response::HTTP_FORBIDDEN);
        }
        $book->title = $request->request->get('title');
        $book->launchDate = $request->request->get('launchDate');
        $book->author = $request->request->get('author');
        $book->save();
        return new Response(['info' => $book->load('author')]);
    }

    /**
     * @param Book $book
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteBook(Book $book)
    {
        $book->delete();
        return new Response(['message' => 'ok']);
    }
}
