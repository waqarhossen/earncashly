<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Missions;
use App\Models\Track_missions;
use App\Models\redeem_requests;
use App\Models\Offers;
use App\Models\User;
use App\Models\offer_historys;
use App\Models\trackers;
use DB;
use Auth;
use Image;


class BasicController extends Controller
{

  static function offerwall_check($m_id, $g_max_play)
  {
    $u_id = Auth::user()->id;
    $g_play = Auth::user()->offer_play;
    $qcheck = "";
    if($g_play>=$g_max_play){
    $cm_date = date('Y-m-d');
    $track_m = Track_missions::where('user_id', $u_id)->where('m_id', $m_id)->where('date', $cm_date)->count();
    if($track_m > 0){
    $qcheck = 2;
    }else{
    $qcheck = 1;
    }
    }else{
    $qcheck = 0;
    }
    return $qcheck;
  }

  static function refermission_check($m_id, $r_max_play)
  {
    $u_id = Auth::user()->id;
    $total_ref = Auth::user()->total_referral;
    $r_check = "";
    if($total_ref>=$r_max_play){
    $cm_date = date('Y-m-d');
    $track_m = Track_missions::where('user_id', $u_id)->where('m_id', $m_id)->count();
    if($track_m > 0){
    $r_check = 2;
    }else{
    $r_check = 1;
    }
    }else{
    $r_check = 0;
    }
    return $r_check;
  }

  static function missionglob()
  {

   if(Auth::user())
   {
    $cu_id = Auth::user()->id;
    $u_date = Auth::user()->log_date;
    $t_date = date('Y-m-d');

   if($u_date == $t_date){
   // code
   }else{
    $pageurl = url()->current();
    $dailymission = DB::table('users')->where('id',$cu_id)->update(
    ['log_date' => $t_date, 'offer_play' => 0]
    );

    if($dailymission){
    header("Location: $pageurl");
    }else{

    }
    }
    }
    else
    {

    }

  }

    public function offers_tab($id_name){
    $offer = Offers::where('id_name', $id_name)->first();
    return view('offers_tab', ['offer'=>$offer]);
    }

    public function profile()
    {
        $cu_id = Auth::user()->id;
        $t_offer = offer_historys::where('uid',$cu_id)->count();
        $t_earn = trackers::where('user_id',$cu_id)->sum('points');
        $t_redeem = redeem_requests::where('user_id',$cu_id)->where('txn_status',4)->count();
        $today_date = date('Y-m-d');
        $tod_earn = trackers::select('points')->where('user_id',$cu_id)->where('date',$today_date)->sum('points');
        return view('profile', [
        't_offer'=>$t_offer,
        't_earn'=>$t_earn,
        't_redeem'=>$t_redeem,
        'tod_earn'=>$tod_earn,
    ]);
    }

    public function up_profile(Request $request)
    {
    if($request->hasFile('csm_avatar')){
    $avatar = $request->file('csm_avatar');
    $filename = 'csm-avatar' . time() . '.' . $avatar->getClientOriginalExtension();
    Image::make($avatar)->orientate()->fit(120, 120)->save(public_path('images/avatar/'.$filename));
    $imagePath = '/images/avatar/'.$filename;
    }
    $cu_id = Auth::user()->id;
    $user = User::find($cu_id);
    $user->picture = $imagePath;
    $user->save();
    return redirect(route('profile'));
    }


}
