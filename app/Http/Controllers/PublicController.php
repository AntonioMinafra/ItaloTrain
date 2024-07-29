<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{

    public function index(){

        return view('trains.index');

    }

    public function getTrainStatus(){

        $response = Http::get('https://italoinviaggio.italotreno.it/api/TreniInCircolazioneService');

        $data = $response->json();

        // ultimo aggiornamento
        $lastUpdate = $data['LastUpdate'] ?? null;

        $trains = $data['TrainSchedules'];

        // vado a togliere i dati che non mi servono
        $trains = array_map(function($train){
            unset($train['Stations']);
            unset($train['Leg']);
            return $train;
        }, $trains);

        return response()->json(['lastUpdate' => $lastUpdate , 'trains' => $trains]);

    }
}
