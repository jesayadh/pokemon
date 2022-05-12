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
        } catch (QueryException $e) {
            $response = [
                'message' => 'Error',
                'data' => $e->errorInfo
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
        } catch (QueryException $e) {
            $response = [
                'message' => 'Error',
                'data' => $e->errorInfo
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    public function getFiboName($num){
        try {
            $temp = $this->fibo($num);
            $response = [
                'message' => 'Pokemon name fibo',
                'data' => $temp
            ];
        } catch (QueryException $e) {
            $response = [
                'message' => 'Error',
                'data' => $e->errorInfo
            ];
        }
        return response()->json($response, Response::HTTP_OK);
    }

    private function fibo($num){
        if ($num <= 1)
            return $num;
        return $this->fibo($num - 1) + $this->fibo($num - 2);
    }
}
