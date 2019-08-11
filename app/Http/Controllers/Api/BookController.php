<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(Book $book)
	{
		$this->book = $book;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$books = $this->book->all();
    	
    	return response()->json([
    		'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'message' => 'Done successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
    		'data' => $books
    	]);
    }
}
