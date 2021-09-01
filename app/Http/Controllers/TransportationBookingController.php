<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class TransportationBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function bookingList(Request $request){
        $data = array();


        $bookings =  Booking::where('agent_id',auth()->id())->orderBy('id','DESC');

        if($request->get('filter_trip_type')){
            $bookings->where('trip_type',$request->get('filter_trip_type'));
        }
        $data['bookings'] = $bookings->paginate(15);

        return view('transportation.list',$data);
    } 

    public function bookingForm(Request $request){
        $data = array();


        $countries = new Countries();
        //dd($countries->all()->toArray());
        $data['countries'] = $countries->all()->toArray();

        if($request->path() == 'transportation/add'){
            $data['action'] = route('addtransportationBooking');
        }else if($request->path() == 'transportation/edit'){
            $data['action'] = route('addtransportationBooking',['id'=>$request->get('id')]);
        }

        if($request->method() == 'POST'){
            $booking_data = [
                'firstname'             =>  $request->input('firstname'),
                'middlename'            =>  'none',
                'lastname'              =>  'none',
                'nationality'           =>  $request->input('nationality'),
                'address'               =>  !empty($request->input('address')) ? $request->input('address') : 'No Address',
                'sex'                   =>  'none',
                'date_of_birthday'      =>  $request->input('date_of_birthday'),
                'telephone'             =>  $request->input('telephone'),
                'email'                 =>  $request->input('email'),
                'passport_number'       =>  $request->input('passport_number'),
                'trip_number_main'      =>  $request->input('trip_number'),
                'trip_arrival_time'     =>  date("G:i", strtotime($request->input('arrival_time'))),
                'number_of_people'      =>  $request->input('perssengers'),
                'booking_date'          =>  $request->input('pickup_date'),
                'one_way_time'          =>  date("G:i", strtotime($request->input('one_way_time'))),
                'one_way_pickup_note'   =>  $request->input('one_way_pickup_note'),
                'one_way_dropoff_note'  =>  $request->input('one_way_dropoff_note'),
                'return_date'           =>  $request->input('return_date'),
                'return_time'           =>  date("G:i", strtotime($request->input('return_time'))),
                'return_pickup_note'   =>  $request->input('return_pickup_note'),
                'return_dropoff_note'  =>  $request->input('return_dropoff_note'),
                'status'                =>  1,
                'booking_type'          =>  1,
                'id_image'              =>  'no image',
                'trip_id'               =>  $request->input('trip_id'),
                'agent_id'              =>  auth()->id(),
                'trip_type'             =>  $request->input('trip_type'),
                'return_trip_id'        =>  $request->input('round_trip_id') ? $request->input('round_trip_id')  : 0
            ];

            $data['booking_data'] = $booking_data;

            $booking_id = Booking::insertGetId($booking_data);

            if($request->input('pessenger')){
         
                foreach($request->input('pessenger') as $key => $pessenger){
                    $pessenger_data = [
                        'firstname'         => $request->input('pessenger')[$key]['firstname'],
                        'middlename'        => 'none',
                        'lastname'          => 'none',
                        'nationality'       => $request->input('pessenger')[$key]['nationality'],
                        'sex'               => 'none',
                        'passport_number'   => 'none',
                        'booking_id'        => $booking_id
                    ];

                    DB::table('booking_people')->insert($pessenger_data);
                }
            }
            
            $vehicles = array();
            $total = 0;
            // one way vehicles
            foreach($request->input('vehivles_price') as $key => $value){
            
               if($key == $request->input('selected_vehicles')[0]){
                $vehilcle_data = [
                    'vehicle_id'    =>  $key,
                    'price'         =>  $request->input('vehivles_price')[$key]['price'],
                    'booking_id'    =>  $booking_id,
                    'trip_type'     =>  'one_way',
                ];
                $vehicles['one_way']['price'] = $vehilcle_data['price'];
                $vehicles['one_way']['vehicle'] = DB::table('vehicle')->where('id',$key)->first();
                $total = $total + $request->input('vehivles_price')[$key]['price'];
                DB::table('booking_vehicles')->insert($vehilcle_data);
               }
            }
            // return vehicles
            if($request->input('vehivles_price') && $request->input('trip_type') != "one_way"){
               
                foreach($request->input('vehivles_price') as $key => $value){
            
                    if($key == $request->input('selected_vehicles')[0]){
                        $vehilcle_data = [
                            'vehicle_id'    =>  $key,
                            'price'         =>  $request->input('vehivles_price')[$key]['price'],
                            'booking_id'    =>  $booking_id,
                            'trip_type'     =>  'return',
                        ];
                        $vehicles['return']['price'] = $vehilcle_data['price'];
                        $vehicles['return']['vehicle'] = DB::table('vehicle')->where('id',$key)->first();
                        $total = $total + $request->input('vehivles_price')[$key]['price'];
                        DB::table('booking_vehicles')->insert($vehilcle_data);
                    }
                    
                }
            }

            // update balance
            $user = DB::table('users')->where('id',auth()->id())->first();
            $balance = $user->balance;
            $total_balance = $balance - $total;
            DB::table('users')->where('id',auth()->id())->update(['balance'=>$total_balance]);
            Db::table('user_balance')->insert([
                'user_id'       => auth()->id(),
                'balance'       => $total,
                'description'   => 'Transportation Number ' . $booking_id,
                'action'        => '-'
            ]);


            $data['from'] = $request->input('pickup_location');
            $data['to'] = $request->input('destination_location');
            $data['return_from'] = $request->input('round_pickup_location');
            $data['return_to'] = $request->input('round_destination_location');
            $data['type'] = $request->input('trip_type');
            $data['pickup_date'] = $request->input('pickup_date');
            $data['pickup_time'] = $request->input('one_way_time');
            $data['return_date'] = $request->input('return_date');
            $data['return_time'] = $request->input('return_time');
            $data['perssengers'] = $request->input('perssengers');
            $data['firstname'] = $request->input('firstname');
            $data['middlename'] = $request->input('middlename');
            $data['lastname'] = $request->input('lastname');
            $data['date_of_birthday'] = $request->input('date_of_birthday');
            $data['sex'] = 'none';
            $data['nationality'] = $request->input('nationality');
            $data['address'] = $request->input('address');
            $data['telephone'] = $request->input('telephone');
            $data['email'] = $request->input('email');
            $data['passport_number'] = $request->input('passport_number');
            $data['trip_number'] = $request->input('trip_number');
            $data['arrival_time'] = $request->input('arrival_time');
            $data['pessengers'] = DB::table('booking_people')->where('booking_id', $booking_id)->get();
            $data['prices'] = DB::table('booking_vehicles')->where('booking_id',$booking_id)->get();
            $data['vehicles'] = $vehicles;
            $data['total'] = $total;
            $data['booking_number'] = $booking_id;

            $data['one_way_vehicle_price'] = $vehicles['one_way']['price'];
            $data['one_way_vehicle'] = $vehicles['one_way']['vehicle']->name . " " . $vehicles['one_way']['vehicle']->name . " - " . $vehicles['one_way']['vehicle']->max_people . " people";

            $data['round_vehicle_price'] = isset($vehicles['return']['price']) ? $vehicles['return']['price'] : '' ;
            if(isset($vehicles['return'])){
                $data['round_vehicle'] = $vehicles['return']['vehicle']->name . " " . $vehicles['return']['vehicle']->name . " - " . $vehicles['return']['vehicle']->max_people . " people";
            }else{
                $data['round_vehicle'] = '';
            }

            return view('transportation.vehicle_success',$data);
        }
      
        $data['image_server'] = 'https://admin.pearltours.com.tr';
        return view('transportation.form',$data);
    }

    public function getTransportaionBooking(Request $request,$booking_id = null){

    }

    public function viewBooking(Request $request){
        $data = array();

        $booking_data = Booking::where('id',$request->get('id'))

        ->where('agent_id',auth()->id())->first();
        $data['booking_data'] = $booking_data;
        $data['booking_number'] = $booking_data->id;
        $data['from']   = $booking_data->Trip->from_location;
        $data['to']   = $booking_data->Trip->to_location;
        $data['pickup_date'] = $booking_data->booking_date;
        $data['pickup_time'] = $booking_data->one_way_time;

        $data['return_from']   = isset($booking_data->RoundTrip->from_location ) ? $booking_data->RoundTrip->from_location : '';
        $data['return_to']   = isset($booking_data->RoundTrip->to_location) ? $booking_data->RoundTrip->to_location : '';
        $data['return_date'] = $booking_data->return_date;
        $data['return_time'] = $booking_data->return_time;

        $vehicle_price = $booking_data->Vehicle;
        $return_vehicle_price = $booking_data->ReturnVehicle;

        $vehicle = Vehicle::where('id',$vehicle_price->vehicle_id)->first();
        
        if($return_vehicle_price){
            $return_vehicle = Vehicle::where('id',$return_vehicle_price->vehicle_id)->first();
          
            $data['round_vehicle'] = $return_vehicle->name . " - " . $return_vehicle->description . " Max people " . $return_vehicle->max_people;
            $data['round_vehicle_price'] = $return_vehicle_price->price;
        }

        $data['one_way_vehicle'] = $vehicle->name . " - " . $vehicle->description . " Max people " . $vehicle->max_people;
        $data['one_way_vehicle_price'] = $vehicle_price->price;
        $data['pessengers'] = $booking_data->GetPessengers;

        $data['total'] = $vehicle_price->price + ($return_vehicle_price ? $return_vehicle_price->price : 0);
        $data['view'] = true;

        return view('transportation.vehicle_success',$data);
    }
}
