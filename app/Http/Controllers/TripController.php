<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getPickappLocations(Request $request){
        $trips = Trip::select('id','from_location')
        ->where('from_location','LIKE','%' . $request->get('query') . '%')
        ->where('from_location','!=',$request->get('to_location'))
        ->skip(0)
        ->take(15)
        ->get();
        return $trips;
    }

    public function getDestinations(Request $request){
        $trips = Trip::select('id','to_location')
        ->where('to_location','LIKE','%' . $request->get('query') . '%')
        ->where('to_location','!=',$request->get('from_location'))
        ->skip(0)
        ->take(15)
        ->get();
        return $trips;
    }

    public function getVehicle(Request $request){
        $data = array();

        $trip = Trip::where('from_location',$request->get('from_location'))->where('to_location',$request->get('to_location'))->first();

        if($trip){
            $trip_id = $trip->id;
        
            $trpi_vehicles = DB::table('trip_vehicle_pricing')
            ->join('vehicle','trip_vehicle_pricing.vehicle_id','=','vehicle.id')
            ->where('trip_vehicle_pricing.trip_id',$trip_id)->select('*')
            ->where('trip_vehicle_pricing.private_price','>',0)
            ->get();
    
            $trpi_vehicles = $trpi_vehicles->toArray();
    
    
            $found_vehicle = false;
    
            foreach($trpi_vehicles as $key => $value){
                if($value->max_people >= $request->get('perssengers') ){
                    $trpi_vehicles[$key]->selected = true;
                }else{
                    $trpi_vehicles[$key]->selected = false;
                }
            }
            $data = array();
            $data['trip_id'] = $trip->id;
            $data['is_airport'] = $trip->is_airport;
            $data['vehicles'] = $trpi_vehicles;
            return $data;
        }else{
            return array();
        }
       
        /*$data['trip_vehicles'] = $trpi_vehicles;


        return view('vehicles',$data);*/
    }

    public function calculateTotal(Request $request){
        $total = 0;
        foreach($request->input('selected_vehicles') as $id){

            $trpi_vehicles = DB::table('trip_vehicle_pricing')->where('trip_id',$request->input('trip_id'))->where('vehicle_id',$id)->first();
            $total = $total + $trpi_vehicles->private_price;
        }
        $data = array();
        $data['totals']['one_way'] = $total;
        $data['totals']['round_trip'] = false;
        if($request->input('trip_type') != 'one_way'){
            $data['totals']['round_trip'] = $total;
            $total = $total*2;
        }
        $data['totals']['total']  = $total;
        return $data;
    }
}
