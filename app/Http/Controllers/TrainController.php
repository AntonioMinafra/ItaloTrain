<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrainController extends Controller
{

    public function index(Request $request)
    {
        $query = Train::query();

        if ($request->has('creation_date') && $request->creation_date != '') {
            $query->whereDate('created_at', $request->creation_date);
        }

        if ($request->has('train_number') && $request->train_number != '') {
            $query->where('TrainNumber', $request->train_number);
        }

        $trains = $query->OrderBy('DepartureDate', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());;

        $trains_id = $trains['id'];

        echo $trains_id;

        return view('savetrains.index', ['trains' => $trains , '$trains_id' => $trains_id]);
    }

    public function store(Request $request)
    {
        /* mi serve per la data corrente */
        $currentData = Carbon::today()->toDateString();

        /* Cerca un record con il TrainNumber e created_at uguale a oggi */
        $train = Train::where('TrainNumber', $request->input('TrainNumber'))
        ->whereDate('created_at', $currentData)
        ->first();

        if ($train) {

            $train->update([
                'DepartureDate' => $request->input('DepartureDate'),
                'DepartureStationDescription' => $request->input('DepartureStationDescription'),
                'ArrivalStationDescription' => $request->input('ArrivalStationDescription'),
                'ArrivalDate' => $request->input('ArrivalDate'),
            ]);
        } else {

            Train::create([
                'TrainNumber' => $request->input('TrainNumber'),
                'DepartureDate' => $request->input('DepartureDate'),
                'DepartureStationDescription' => $request->input('DepartureStationDescription'),
                'ArrivalStationDescription' => $request->input('ArrivalStationDescription'),
                'ArrivalDate' => $request->input('ArrivalDate'),
            ]);
        }

        }

        public function destroy(Train $train)
        {
            $train->delete();

            return redirect()->route('save.trains')->with('success', 'Treno eliminato con successo.');
        }

        public function deleteAll(Train $train)
        {
            $train->truncate();

            return redirect()->route('save.trains')->with('success', 'Treni eliminati con successo.');
        }
    }
