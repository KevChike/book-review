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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->bookRepository->update($id, $request->toArray());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'message' => 'Updated successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'message' => 'Deleted successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
        ], 200);
    }
}
