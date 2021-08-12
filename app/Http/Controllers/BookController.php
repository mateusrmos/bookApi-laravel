<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    //

    /**
     * List All Books
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $bookList = BookModel::all();
        return new Response(['list' => $bookList]);
    }
}
