<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $data = array();
        $balance = DB::table('user_balance')->where('user_id',auth()->id())->orderBy('id','DESC');

        $balance = $balance->paginate(15);

        $data['balances'] = $balance;
        return view('user.balance',$data);
    }
}
