<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
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
		$this->middleware('auth:api')->except(['index']);
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$books = $this->bookRepository->all();

    	return new BookCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $this->bookRepository->create($request->toArray());
        
        return new BookResource($book);
    }
}
