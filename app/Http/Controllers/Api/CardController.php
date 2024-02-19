<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CardResource;
use Illuminate\Routing\Controller;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cards=Card::all();
        return response()->json(CardResource::collection($cards));
    }

}
