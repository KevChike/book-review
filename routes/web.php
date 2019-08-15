<?php

Route::fallback(function(){
    return response()->json([
        'message' => 'Not Found.'
    ], 404);
});
