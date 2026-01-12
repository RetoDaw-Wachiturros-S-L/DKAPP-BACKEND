<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/usuarios', function () {
    return response()->json([
        ['id' => 1, 'nombre' => 'Juan'],
        ['id' => 2, 'nombre' => 'María'],
        ['id' => 3, 'nombre' => 'Carlos'],
    ]);
});
