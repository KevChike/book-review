<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\BookRepositoryInterface as BookRepository;

class BookController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(BookRepository $bookRepository)
	{
		$this->bookRepository = $bookRepository;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$books = $this->bookRepository->all();

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
