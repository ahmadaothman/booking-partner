<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class TransportationBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function bookingList(Request $request){
        $data = array();


        $bookings =  Booking::where('agent_id',auth()->id())->orderBy('id');

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
                'middlename'            =>  $request->input('middlename'),
                'lastname'              =>  $request->input('lastname'),
                'nationality'           =>  $request->input('nationality'),
                'address'               =>  !empty($request->input('address')) ? $request->input('address') : 'No Address',
                'sex'                   =>  $request->input('sex'),
                'date_of_birthday'      =>  $request->input('date_of_birthday'),
                'telephone'             =>  $request->input('telephone'),
                'passport_number'       =>  $request->input('passport_number'),
                'trip_number_main'      =>  $request->input('trip_number'),
                'number_of_people'      =>  $request->input('perssengers'),
                'status'                =>  1,
                'booking_type'          =>  1,
                'id_image'              =>  'no image',
                'trip_id'               =>  $request->input('trip_id'),
                'agent_id'              => auth()->id(),
                'trip_type'             => $request->input('trip_type')
            ];

            $booking_id = Booking::insertGetId($booking_data);

            if($request->input('pessenger')){
          //      dd($request->input('pessenger'));
         
                foreach($request->input('pessenger') as $key => $pessenger){
                    $pessenger_data = [
                        'firstname'         => $request->input('pessenger')[$key]['firstname'],
                        'middlename'        => $request->input('pessenger')[$key]['middlename'],
                        'lastname'          => $request->input('pessenger')[$key]['lastname'],
                        'nationality'       => $request->input('pessenger')[$key]['nationality'],
                        'sex'               => $request->input('pessenger')[$key]['sex'],
                        'passport_number'   => $request->input('pessenger')[$key]['passport_number'],
                        'booking_id'        => $booking_id
                    ];

                    DB::table('booking_people')->insert($pessenger_data);
                }
            }
            
            $vehicles = array();
            $total = 0;
            foreach($request->input('vehivles_price') as $key => $value){
            
                $vehilcle_data = [
                    'vehicle_id'    =>  $key,
                    'price'         =>  $request->input('vehivles_price')[$key]['price'],
                    'booking_id'    =>  $booking_id
                ];
                $total = $total + $request->input('vehivles_price')[$key]['price'];

                DB::table('booking_vehicles')->insert($vehilcle_data);
                $vehicles[] = DB::table('vehicle')->where('id',$key)->first();
            }
            $user = DB::table('users')->where('id',auth()->id())->first();
            $balance = $user->balance;
            $total_balance = $balance - $total; 
            DB::table('users')->where('id',auth()->id())->update(['balance'=>$total_balance]);
            Db::table('user_balance')->insert([
                'user_id'   => auth()->id(),
                'balance'   => $total,
                'action'    => '-'
            ]);

            $data = array();
            $data['from'] = $request->input('pickup_location');
            $data['to'] = $request->input('destination_location');
            $data['type'] = $request->input('trip_type');
            $data['pickup_date'] = $request->input('pickup_date');
            $data['return_date'] = $request->input('return_date');
            $data['perssengers'] = $request->input('perssengers');
            $data['firstname'] = $request->input('firstname');
            $data['middlename'] = $request->input('middlename');
            $data['lastname'] = $request->input('lastname');
            $data['date_of_birthday'] = $request->input('date_of_birthday');
            $data['sex'] = $request->input('sex');
            $data['nationality'] = $request->input('nationality');
            $data['address'] = $request->input('address');
            $data['telephone'] = $request->input('telephone');
            $data['passport_number'] = $request->input('passport_number');
            $data['trip_number'] = $request->input('trip_number');
            $data['pessengers'] = $request->input('pessenger');
            $data['prices'] = DB::table('booking_vehicles')->where('booking_id',$booking_id)->get();
            $data['vehicles'] = $vehicles;
            $data['total'] = $total;
            return view('transportation.vehicle_success',$data);
        }

        $data['image_server'] = 'https://admin.pearltours.com.tr';
        return view('transportation.form',$data);
    }

    public function getTransportaionBooking(Request $request,$booking_id = null){

    }
}
