<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ReviewRepositoryInterface as ReviewRepository;

class ReviewController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(ReviewRepository $reviewRepository)
	{
		$this->reviewRepository = $reviewRepository;
		$this->middleware('auth:api')->except(['index']);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$review = $this->reviewRepository->create($request->toArray());

    	return response()->json([
    		'status' => 'success',
            'code' => 201,
            'title' => 'Created',
            'message' => 'Done successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'data' => $review
    	], 201);
    }
}
