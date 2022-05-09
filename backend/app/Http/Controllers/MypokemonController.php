<?php

namespace App\Http\Controllers;

use App\Models\Mypokemon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MypokemonController extends Controller
{
    public function getFiftyChance()
    {
        try {
            $chance = rand(1,10) > 5 ? true : false;
            $response = [
                'message' => 'Pokemon catch chance',
                'data' => $chance
            ];
        } catch (\Throwable $th) {
            $response = [
                'message' => 'Error',
                'data' => $th
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function getPrimeChance()
    {
        try {
            $chance = rand();
            $response = [
                'message' => 'Pokemon release catched',
                'data' => $chance
            ];
        } catch (\Throwable $th) {
            $response = [
                'message' => 'Error',
                'data' => $th
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function renamePokemon($name){
        
    }
}
