<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
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
     * @param  \Illuminate\Http\ReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
    	$review = $this->reviewRepository->create($request->toArray());

    	return new ReviewResource($review);
    }
}
