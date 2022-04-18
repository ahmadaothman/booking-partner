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
        ->where('status', true)
        ->skip(0)
        ->take(15)
        ->get()->unique('from_location');
        return $trips;
    }

    public function getDestinations(Request $request){
        $trips = Trip::select('id','to_location')
        ->where('to_location','LIKE','%' . $request->get('query') . '%')
        ->where('to_location','!=',$request->get('from_location'))
        ->where('status', true)
        ->skip(0)
        ->take(15)
        ->get()->unique('to_location');
        return $trips;
    }

    public function getVehicle(Request $request){
        $data = array();

        // one way trip
        $trip = Trip::where('from_location',$request->get('from_location'))
        ->where('to_location',$request->get('to_location'))
        ->where('status',1)
        ->first();
       
        if($trip){
            $trip_id = $trip->id;
        
            $trpi_vehicles = DB::table('trip_vehicle_pricing')
            ->join('vehicle','trip_vehicle_pricing.vehicle_id','=','vehicle.id')
            ->where('vehicle.status',true)
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

            $data['trip_id'] = $trip->id;
            $data['is_airport'] = $trip->is_airport;
            $data['vehicles'] = $trpi_vehicles;
           
        }

        // return trip
        $trip = Trip::where('from_location',$request->get('round_from_location'))
        ->where('to_location',$request->get('round_to_location'))
        ->where('status',1)
        ->first();

        if($trip){
            $trip_id = $trip->id;
        
            $trpi_vehicles = DB::table('trip_vehicle_pricing')
            ->join('vehicle','trip_vehicle_pricing.vehicle_id','=','vehicle.id')
            ->where('vehicle.status',true)
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

            $data['return_trip_id'] = $trip->id;
            $data['return_is_airport'] = $trip->is_airport;
            $data['return_vehicles'] = $trpi_vehicles;

            if(!$data['is_airport'] ){
                $data['is_airport'] = $trip->is_airport;
            }
        }
        return $data;
    }

    public function calculateTotal(Request $request){
        $total = 0;
        $data = array();
        
        foreach($request->input('selected_vehicles') as $id){

            $trpi_vehicles = DB::table('trip_vehicle_pricing')
            ->where('trip_id',$request->input('trip_id'))
            ->where('vehicle_id',$id)->first();

            $data['one_way_vehicle'] = DB::table('vehicle')
            ->where('id',$trpi_vehicles->vehicle_id)->first();

            $data['one_way_vehicle_price'] = $trpi_vehicles;
            
            $data['one_way_price'] = $trpi_vehicles->private_price;
            $total = $total + $trpi_vehicles->private_price;
        }

        $trip = $trpi_vehicles = DB::table('trip')
        ->where('id',$request->input('trip_id'))->first();

       $data['airport_note'] = $trip->airport_note;

        $data['pessengers'] = $request->input('pessenger');

       

        if($request->input('trip_type') == "one_way"){
            $data['total'] = $total;
        }else{
            $data['total'] = $total*2;
        }
        return $data;
    }
}
