<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\redeems;
use App\Models\redeem_requests;
use App\Models\User;
use App\Models\trackers;
use App\Models\settings;
use Session;
use Auth;
use DB;
use Redirect;


class AppController extends Controller
{


public function rewards()
{
$redeemlist = Redeems::all();
if(empty(Auth::user())){
$u_id = 0;
$u_po = 0;
}else{
$u_id = Auth::user()->id;
$u_po = Auth::user()->points;
}
$requests_data = Redeem_requests::where('user_id', $u_id)->orderBy('id','desc')->get();
return view('reward', ['redeemlist'=>$redeemlist, 'requests_data'=>$requests_data,'u_po'=>$u_po,'u_id'=>$u_id]);
}

public function rewardrequests($txn_id)
{

$redeem_data = Redeems::where('txn_id', $txn_id)->first();
if(is_null($redeem_data)){
return abort(404);
}
else
{
$redeem_point  = $redeem_data->points;
if(!Auth::user()->points == 0){
if(Auth::user()->points >= $redeem_point)
{
return view('rewardrequests', ['redeem_data'=>$redeem_data]);
}
else
{
return Redirect::back()->withErrors(['msg' => 'You do not have enough points']);
}
}else{
return redirect()->to('/cashout');
}
}

}

public function send_rewardRequests(Request $request)
{

$r_addr = $request['reward_details'];
$getrew = request()->path();
$reward_id = str_replace('cashout/', '', $getrew);
$reward_txn = str_replace('cashout/', '', $getrew);
if(!$r_addr == "")
{
$name = $request->name;
$addr = $request->reward_details;
$loged_id = Auth::user()->id;
$loged_email = Auth::user()->email;
$user_name = Auth::user()->name;
$ip = $request->ip();
$date = date("Y-m-d h:i:s");
$reward_data = Redeems::where('txn_id', $reward_id)->first();
$reward_type  = $reward_data->type;
$reward_price  = $reward_data->price;
$reward_point  = $reward_data->points;
$reward_image  = $reward_data->image;
$reward_id  = $reward_data->id;
$aval_points = Auth::user()->points;
$calc_val_points = $aval_points - $reward_point;
$time = time();

DB::statement("UPDATE `users` SET points = points - $reward_point WHERE id = $loged_id");

DB::insert('insert into redeem_requests (title, user_id, email, payment_address, request_type, request_amount, ip_address, points_used, corrent_points, txn_status, date, txn, image, name, time, redeem_id)
values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
[$reward_data->title, $loged_id, $loged_email, $addr, $reward_type, $reward_price, $ip, $reward_point, $calc_val_points, "0", $date, $reward_id, $reward_image, $user_name, $time, $reward_id]);

$add_track = new trackers;
$add_track->user_id = $loged_id;
$add_track->transation = $reward_data->title;
$add_track->type = 0;
$add_track->points = $reward_point;
$add_track->time = time();
$add_track->ip = $ip;
$add_track->save();

return Redirect::route('cashout_', $reward_data->txn_id)
    ->with('status-success', '🎉 Congratulations! Cashout request sent successfully.');

}
else
{
  return Redirect::route('cashout_', $reward_txn)
    ->with('status-alert', '⚠️ Please enter Cashout details!');
}

}


public function referjoin($referID)
{
    if (!User::where('refer_id', '=', $referID)->exists()) {
        return redirect()->to('/');
    }
    $user_ref_code = User::select('id')->where('refer_id', $referID)->first();
    $user_id = $user_ref_code->id;
    Session::put('referby', $user_id);
    return redirect()->to('/');
}


public function web_pages($slug)
{
  $pages = pages::where('status', 1)->where('slug', $slug)->first();
  if(empty($pages)){ abort(404); }
  DB::table('pages')->where('id', $pages->id)->increment('views');
  return view('pages', ['pages'=>$pages]);
}


}
