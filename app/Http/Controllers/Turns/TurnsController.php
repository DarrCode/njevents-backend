<?php

namespace App\Http\Controllers\Turns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Turn;

class TurnsController extends Controller
{
    function index() {
        $extra = auth('api')->user();

        $turns = Turn::where('extra_id', $extra->extra_id)
            ->where('status', 'pendiente')
            ->with('customer')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $turns,
        ]);
    }
}
