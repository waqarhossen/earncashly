<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Missions;
use App\Models\redeems;
use App\Models\redeem_requests;
use App\Models\trackers;
use App\Models\settings;
use App\Models\pages;
use App\Models\Admin;
use App\Models\socialmedia;
use App\Models\Offers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;

class HomeController extends Controller
{

    function rand($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }

    public function index()
    {

    $top_ref_users = User::OrderBy('total_referral', 'DESC')->take(10)->get();
    $user_count = DB::select( DB::raw("SELECT id FROM users"));
    $total_user = count($user_count);
    $today_date = date('Y-m-d');
    $users_join_today = User::where('join_date', '=', $today_date)->count('id');
    $user_points = User::sum('points');
    $total_refferal = User::sum('total_referral');
    $total_withd = redeem_requests::count('id');
    $pending_withd = redeem_requests::where('txn_status', '=', 0)->count('id');

    if(!empty(redeem_requests::first())){
    $all_r = count(redeem_requests::get()); //11
    $pen_r = count(redeem_requests::Where('txn_status',0)->get()); //5
    $apr_r = count(redeem_requests::Where('txn_status',1)->get()); //15
    $rej_r = count(redeem_requests::Where('txn_status',2)->get()); //20
    $com_r = count(redeem_requests::Where('txn_status',4)->get()); //25
    $pen_red = ($pen_r / $all_r) * 100;
    $apr_red = ($apr_r / $all_r) * 100;
    $rej_red = ($rej_r / $all_r) * 100;
    $com_red = ($com_r / $all_r) * 100;
    $t_re = str_replace("0.","",round($pen_red));
    $t_apre = str_replace("0.","",round($apr_red));
    $t_rej = str_replace("0.","",round($rej_red));
    $t_com = str_replace("0.","",round($com_red));
    }else{
    $t_re = str_replace("0.","",round(0));
    $t_apre = str_replace("0.","",round(0));
    $t_rej = str_replace("0.","",round(0));
    $t_com = str_replace("0.","",round(0));
    }

    return view('admin.dashboard', [
    'total_user'=>$total_user,
    'user_points'=>$user_points,
    'total_withd'=>$total_withd,
    'pending_withd'=>$pending_withd,
    'total_refferal'=>$total_refferal,
    'top_ref_users'=>$top_ref_users,
    'users_join_today'=>$users_join_today,
    'total_user' => $total_user,
    't_re' => $t_re,
    't_apre' => $t_apre,
    't_rej' => $t_rej,
    't_com' => $t_com,
    ]);

    }

    public function users(Request $request)
    {

      $usersearch = $request->input('user');
      if(isset($usersearch)){
      $users = User::query()
      ->where('email', 'LIKE', "%{$usersearch}%")
      ->orWhere('name', 'LIKE', "%{$usersearch}%")
      ->orWhere('id', 'LIKE', "%{$usersearch}%")
      ->paginate(10);
      $users->appends($users->all());
      return view('admin.users', compact('users'));
      }
      else
      {
      $users = User::latest()->paginate(15);
      return view('admin.users', ['users'=>$users]);
      }

    }

    public function edit_user($id)
    {
     $user_data = User::find($id);
     return view('admin.edit_user', ['user_data'=>$user_data]);
    }

    public function update_user(Request $request, $id)
    {
       $user = User::find($id);
       $user->name =$request['name'];
       $user->email =$request['email'];
       $user->points =$request['points'];
       $user->status =$request['status'];
       $user->save();
       return redirect(route('admin.useredit', ['id' => $id]))->with('status', 'User Data Has Been updated');
    }


    //offerwalls routes
    public function offerwalls()
    {
       $offers = Offers::paginate(15);
       return view('admin.offerwalls', ['offers'=>$offers]);
    }

    public function edit_offerwalls($id)
    {
      $offerwalls_data = Offers::find($id);
      return view('admin.edit_offers', ['offerwalls_data'=>$offerwalls_data]);
    }

    public function update_offerwalls(Request $request, $id)
    {
       $offer = Offers::find($id);
       $offer->title =$request['title'];
       $offer->image =$request['image'];
       $offer->color =$request['color'];
       $offer->type =$request['type'];
       $offer->rate =$request['rate'];
       
       
       if($offer->id_name=="adget"){
        //ADGET   
        if(env('ADGET_WALL_CODE')!=$request->wall_code){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('ADGET_WALL_CODE');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('ADGET_WALL_CODE='.$code, 'ADGET_WALL_CODE='.$request->wall_code, $enccon));
        }
        }
        
        $of_url = "https://wall.adgaterewards.com/". $request->wall_code ."/USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="adgem"){
        //---------ADGEM------------
        if(env('ADGEM_APPID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('ADGEM_APPID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('ADGEM_APPID='.$code, 'ADGEM_APPID='.$request->app_id, $enccon));
        }
        }
        
        $of_url = "https://api.adgem.com/v1/wall?appid=".$request->app_id."&playerid=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="offertoro"){
        //---------TOROX------------
        if(env('TOROX_APP_ID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('TOROX_APP_ID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('TOROX_APP_ID='.$code, 'TOROX_APP_ID='.$request->app_id, $enccon));
        }
        }
        
        if(env('TOROX_PUB_ID')!=$request->pub_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('TOROX_PUB_ID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('TOROX_PUB_ID='.$code, 'TOROX_PUB_ID='.$request->pub_id, $enccon));
        }
        }        
        
        if(env('TOROX_SECRET_KEY')!=$request->sec_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('TOROX_SECRET_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('TOROX_SECRET_KEY='.$code, 'TOROX_SECRET_KEY='.$request->sec_key, $enccon));
        }
        }
        
        $of_url = "https://torox.io/ifr/show/".$request->pub_id."/USERID/".$request->app_id;
        $offer->slug = $of_url;
        
       }if($offer->id_name=="mmwall"){
        //---------MMWALL------------
        if(env('MM_PUBID')!=$request->pub_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('MM_PUBID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('MM_PUBID='.$code, 'MM_PUBID='.$request->pub_id, $enccon));
        }
        }
        
        $of_url = "https://wall.make-money.top/?p=".$request->pub_id."&u=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="cpx-research"){
        //---------CPX RE------------
        if(env('CPX_APPID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('CPX_APPID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('CPX_APPID='.$code, 'CPX_APPID='.$request->app_id, $enccon));
        }
        }
        
        if(env('CPX_SECURE_HASH')!=$request->s_hash){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('CPX_SECURE_HASH');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('CPX_SECURE_HASH='.$code, 'CPX_SECURE_HASH='.$request->s_hash, $enccon));
        }
        }
        
        $of_url = "https://offers.cpx-research.com/index.php?app_id=".$request->app_id."&ext_user_id=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="bitlabs"){
        //---------BITLABS------------
        if(env('BITLABS_TOKEN')!=$request->token){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('BITLABS_TOKEN');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('BITLABS_TOKEN='.$code, 'BITLABS_TOKEN='.$request->token, $enccon));
        }
        }
        
        if(env('BITLABS_SECRET_KEY')!=$request->sec_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('BITLABS_SECRET_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('BITLABS_SECRET_KEY='.$code, 'BITLABS_SECRET_KEY='.$request->sec_key, $enccon));
        }
        }
        
        $of_url = "https://web.bitlabs.ai/?uid=USERID&token=".$request->token;
        $offer->slug = $of_url;
        
       }if($offer->id_name=="inbrain"){
        //---------INBRAIN------------
        if(env('INBRAIN_CALLBACK_SECRET')!=$request->callback_secret){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('INBRAIN_CALLBACK_SECRET');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('INBRAIN_CALLBACK_SECRET='.$code, 'INBRAIN_CALLBACK_SECRET='.$request->callback_secret, $enccon));
        }
        }
        
        if(env('INBRAIN_PARAMS')!=$request->params){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('INBRAIN_PARAMS');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('INBRAIN_PARAMS='.$code, 'INBRAIN_PARAMS='.$request->params, $enccon));
        }
        }
        
        $of_url = "https://www.surveyb.in/configuration?params=".$request->params."&app_uid=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="ayet"){
        //---------Aye-T------------
        if(env('AYET_ADSLOTID')!=$request->ad_slot){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('AYET_ADSLOTID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('AYET_ADSLOTID='.$code, 'AYET_ADSLOTID='.$request->ad_slot, $enccon));
        }
        }
        
        if(env('AYET_API_KEY')!=$request->api_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('AYET_API_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('AYET_API_KEY='.$code, 'AYET_API_KEY='.$request->api_key, $enccon));
        }
        }
        
        $of_url = "https://www.ayetstudios.com/offers/web_offerwall/".$request->ad_slot."?external_identifier=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="cpa-lead"){
        //---------CpaLEAD------------//
        
        SetEnv('CPALEAD_ID', $request->link_id, true); 
            
        $of_url = $request->link_id."&subid=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="wannads"){
        //---------WannAds------------
        if(env('WANNADS_APIKEY')!=$request->api_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('WANNADS_APIKEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('WANNADS_APIKEY='.$code, 'WANNADS_APIKEY='.$request->api_key, $enccon));
        }
        }
        
        if(env('WANNADS_SECRET')!=$request->secret){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('WANNADS_SECRET');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('WANNADS_SECRET='.$code, 'WANNADS_SECRET='.$request->secret, $enccon));
        }
        }
        
        $of_url = "https://earn.wannads.com/wall?apiKey=".$request->api_key."&userId=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="monlix"){
        //---------Monlix------------
        if(env('MONLIX_APPID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('MONLIX_APPID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('MONLIX_APPID='.$code, 'MONLIX_APPID='.$request->app_id, $enccon));
        }
        }
        
        if(env('MONLIX_SECRET_KEY')!=$request->secret_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('MONLIX_SECRET_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('MONLIX_SECRET_KEY='.$code, 'MONLIX_SECRET_KEY='.$request->secret_key, $enccon));
        }
        }
        
        $of_url = "https://offers.monlix.com/?appid=".$request->app_id."&userid=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="lootably"){
        //---------Lootably------------
        if(env('LOOTABLY_PLACEMENTID')!=$request->placement){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('LOOTABLY_PLACEMENTID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('LOOTABLY_PLACEMENTID='.$code, 'LOOTABLY_PLACEMENTID='.$request->placement, $enccon));
        }
        }
        
        if(env('LOOTABLY_SECRET')!=$request->secret){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('LOOTABLY_SECRET');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('LOOTABLY_SECRET='.$code, 'LOOTABLY_SECRET='.$request->secret, $enccon));
        }
        }
        
        $of_url = "https://wall.lootably.com/?placementID=".$request->placement."&sid=USERID";
        $offer->slug = $of_url;
        
       }if($offer->id_name=="revlum"){
        //---------Revlum------------
        if(env('REVLUM_APIKEY')!=$request->api_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('REVLUM_APIKEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('REVLUM_APIKEY='.$code, 'REVLUM_APIKEY='.$request->api_key, $enccon));
        }
        }        
        
        if(env('REVLUM_SECRET_KEY')!=$request->secret_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('REVLUM_SECRET_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('REVLUM_SECRET_KEY='.$code, 'REVLUM_SECRET_KEY='.$request->secret_key, $enccon));
        }
        }
        
        $of_url = "https://revlum.com/offerwall/".$request->api_key."/USERID";
        $offer->slug = $of_url;
           
        }if($offer->id_name=="notik"){
            
        //---------Notik------------
        if(env('NOTIK_API_KEY')!=$request->api_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('NOTIK_API_KEY');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('NOTIK_API_KEY='.$code, 'NOTIK_API_KEY='.$request->api_key, $enccon));
        }
        }        
        
        if(env('NOTIK_SECRET')!=$request->secret_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('NOTIK_SECRET');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('NOTIK_SECRET='.$code, 'NOTIK_SECRET='.$request->secret_key, $enccon));
        }
        }
        
        if(env('NOTIK_APP_ID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('NOTIK_APP_ID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('NOTIK_APP_ID='.$code, 'NOTIK_APP_ID='.$request->app_id, $enccon));
        }
        }
        
        if(env('NOTIK_PUB_ID')!=$request->pub_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('NOTIK_PUB_ID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('NOTIK_PUB_ID='.$code, 'NOTIK_PUB_ID='.$request->pub_id, $enccon));
        }
        }  
        
        $of_url = "https://notik.me/coins?api_key=".$request->api_key."&pub_id=".$request->pub_id."&app_id=".$request->app_id."&user_id=USERID";
        $offer->slug = $of_url;
           
        }if($offer->id_name=="admantum"){
        //---------AdMantum------------
        if(env('ADMANTUM_APP_ID')!=$request->app_id){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('ADMANTUM_APP_ID');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('ADMANTUM_APP_ID='.$code, 'ADMANTUM_APP_ID='.$request->app_id, $enccon));
        }
        }     
        
        if(env('ADMANTUM_SECRET')!=$request->secret_key){
        $path = base_path('.env');
        $enccon = file_get_contents($path);
        $code = env('ADMANTUM_SECRET');
        if (file_exists($path)) {
          file_put_contents($path, str_replace('ADMANTUM_SECRET='.$code, 'ADMANTUM_SECRET='.$request->secret_key, $enccon));
        }
        }
        
        $of_url = "https://www.admantum.com/offers/?appid=".$request->app_id."&uid=USERID";
        $offer->slug = $of_url;
        
        }
        
        if($offer->id_name=="adscend"){
            
        SetEnv('ADSCEND_WAll_ID', $request->wall_id, false);
        SetEnv('ADSCEND_PUB_ID', $request->pub_id, false); 
            
        $of_url = "https://www.adscendmedia.com/adwall/publisher/". $request->pub_id ."/profile/". $request->wall_id ."/preview?subid1=USERID";
        $offer->slug = $of_url;
           
        }
       
       if($request['offer_dis'] != "+0%"){
       $offer->offer =$request['offer_dis'];
       }else{
        $offer->offer = null;
       }
       $offer->save();
       return redirect(route('admin.edit_offerwalls', ['id' => $id]))->with('status-success', 'Offer Has Been updated');
    }

    public function postbacks()
    {
     return view('admin.postbacks');
    }

    public function status_offers($id)
    {
        $of_data = Offers::find($id);
        if($of_data->status == 1){
        $of_data->status = 0;
        $of_data->save();
        }elseif($of_data->status == 0){
        $of_data->status = 1;
        $of_data->save();
        }else{

        }
        return redirect()->back();
    }

    //Missions functions...
    public function missions()
    {
       $missions = Missions::paginate(15);
       return view('admin.missions', ['missions'=>$missions]);
    }

    public function edit_missions($id)
    {
      $missions_data = Missions::find($id);
      return view('admin.edit_missions', ['missions_data'=>$missions_data]);
    }

    public function update_missions(Request $request, $id)
    {
       $mission = Missions::find($id);
       $mission->m_title =$request['title'];
       $mission->image =$request['image'];
       $mission->max_play =$request['max'];
       $mission->points =$request['point'];
       $mission->status =$request['status'];
       $mission->m_desc =$request['desc'];
       $mission->slug =$request['type'];
       $mission->save();
       return redirect(route('admin.edit_missions', ['id' => $id]))->with('status', 'Mission Has Been updated');
    }

    public function add_missions()
    {
     return view('admin.add_missions');
    }

    public function create_missions(Request $request)
    {
       $randomcode = $this->rand(5);
       $mission = new Missions;
       $mission->m_title =$request['title'];
       $mission->image =$request['image'];
       $mission->max_play =$request['max'];
       $mission->points =$request['point'];
       $mission->status =$request['status'];
       $mission->m_desc =$request['desc'];
       $mission->slug =$request['type'];
       $mission->m_id =$randomcode;
       $mission->save();
       return redirect(route('admin.missions'))->with('status-success', 'Mission Has Been added');
    }

    public function delete_missions($id)
    {
        DB::delete('delete from missions where id = ?',[$id]);
        return redirect(route('admin.missions'))->with('status-alert', 'Mission Has Been deleted');
    }


   //redeem functions...
   public function withdrawals()
   {
      $withdrawals = Redeems::paginate(15);
      return view('admin.withdraw', ['withdrawals'=>$withdrawals]);
   }

   public function edit_withdrawals($id)
   {
      $withdrawals_data = Redeems::find($id);
      return view('admin.edit_withdrawals', ['withdrawals_data'=>$withdrawals_data]);
   }

    public function update_withdrawals(Request $request, $id)
    {
       $redeem = Redeems::find($id);
       $redeem->title =$request['title'];
       
        if($request->hasFile('csmimage')) {
        $avatar = $request->file('csmimage');
        $filename = 'csm-' . time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->save(public_path('images/app/' . $filename));
        $imagePath = '/images/app/'.$filename;
        }
        
       if(!empty($imagePath)){ $redeem->image = $imagePath; }
       
       $redeem->type =$request['type'];
       $redeem->price =$request['price'];
       $redeem->points =$request['points'];
       $redeem->color =$request['color'];
       $redeem->save();
       
       return redirect()->route('admin.edit_withdrawals', $id)->with('status', 'Redeem has been updated!');
    }

    public function add_withdrawals()
    {
     return view('admin.add_withdrawals');
    }

    public function create_withdrawals(Request $request)
    {
       $randomcode = $this->rand(8);
       $redeem = new Redeems;
       $redeem->title =$request['title'];
       
        if($request->hasFile('csmimage')) {
        $avatar = $request->file('csmimage');
        $filename = 'csm-' . time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->save(public_path('images/app/' . $filename));
        $imagePath = '/images/app/'.$filename;
        }
        
       $redeem->image = $imagePath;
       $redeem->type =$request['type'];
       $redeem->price =$request['price'];
       $redeem->points =$request['points'];
       $redeem->color =$request['color'];
       $redeem->txn_id =$randomcode;
       $redeem->save();
       return redirect(route('admin.withdrawals'))->with('status-success', 'Redeem Has Been added');
    }

    public function delete_withdrawals($id)
    {
        DB::delete('delete from redeems where id = ?',[$id]);
        return redirect(route('admin.withdrawals'))->with('status-alert', 'Redeem Has Been deleted');
    }

    //redeem requests functions...
    public function withdrawal_requests(Request $request)
    {

      $search = $request->input('status');
      $usersearch = $request->input('user');

      if(isset($usersearch)){
      $withdrawals = redeem_requests::query()
      ->where('email', 'LIKE', "%{$usersearch}%")
      ->orWhere('name', 'LIKE', "%{$usersearch}%")
      ->orWhere('user_id', 'LIKE', "%{$usersearch}%")
      ->paginate(10);
      $withdrawals->appends($request->all());
      return view('admin.withdraw_req', compact('withdrawals'));
      }
      else
      {
      if(isset($search)){
      $withdrawals = redeem_requests::OrderBy('id', 'DESC')->where('txn_status', $search)->paginate(15);
      }
      else{
      $withdrawals = redeem_requests::OrderBy('id', 'DESC')->paginate(15);
      }
      return view('admin.withdraw_req', ['withdrawals'=>$withdrawals]);
      }

    }

    public function request_view($id)
    {
      $withdrawal_data = redeem_requests::find($id);
      $user_data = User::find($withdrawal_data->user_id);
      return view('admin.request_view', ['withdrawal_data'=>$withdrawal_data, 'user_data'=>$user_data]);
    }

    public function update_request_view(Request $request, $id)
    {
       $redeem_req = redeem_requests::find($id);
       $redeem_req->txn_status =$request['status'];
       $redeem_req->reason =$request['reason'];
       $redeem_req->save();
       return redirect(route('admin.with_reqs_up', ['id' => $id]))->with('status-success', 'User Redeem Has Been updated');
    }

    //tracker routes......
    public function tracker($id)
    {
        $userdata = trackers::OrderBy('id', 'DESC')->where('user_id', $id)->paginate(25);
        return view('admin.tracker', ['userdata'=>$userdata]);
    }

    //referral routes......
    public function referral($id)
    {
        $user_ref_track = User::OrderBy('id', 'DESC')->where('refer_by', $id)->paginate(25);
        return view('admin.referral', ['user_ref_track'=>$user_ref_track]);
    }

    public function settings()
    {
        $social_media = socialmedia::latest()->get();
        $settings = settings::where('id', 1)->first();
        return view('admin.settings', ['settings'=>$settings,'social_media' => $social_media]);
    }
  
    function csm_upload($request, $inputName = 'image', $directory = 'images/app/')
    {
        if ($request->hasFile($inputName)) {
            $avatar = $request->file($inputName);
            $filename = $inputName . '.' . $avatar->getClientOriginalExtension();
    
            // Ensure the directory exists
            $fullDirectory = $directory;
            if (!file_exists($fullDirectory)) {
                mkdir($fullDirectory, 0755, true);
            }
    
            // Full path for saving the image
            $path = $fullDirectory . $filename;
    
            // Create and save the image
            Image::make($avatar)->save(public_path($path));
    
            // Return the relative path
            return '/' . $directory . $filename;
        }
    
        return null;  // Return null if no file was uploaded
    }

    public function update_settings(Request $request)
    {
       //dd($request->all());

       $settings = settings::find(1);
       $settings->site_name =$request['seo_title'];
       $settings->site_desc =$request['seo_desc'];
       $settings->site_url =$request['site_url'];
       $settings->site_keywords =$request['seo_keywords'];
        
       if($request->hasFile('logo')){
        $logoPath = $this->csm_upload($request, 'logo');
        $settings->site_logo = $logoPath;
       }       
       
       if($request->hasFile('favicon')){
        $favPath = $this->csm_upload($request, 'favicon');
        $settings->fav_icon = $favPath;
       }       
       
       if($request->hasFile('app_icon')){
        $iconPath = $this->csm_upload($request, 'app_icon');
        $settings->app_icon = $iconPath;
       }
       
       $settings->short_title =$request['short_title'];
       $settings->app_url =$request['app_url'];
       $settings->contact_email =$request['c_email'];
       $settings->copyright =$request['copyright'];
       $settings->save();
       return redirect(route('admin.settings'))->with('status', 'Settings Has Been updated');
    }

    public function ad_update_settings (Request $request)
    {

        if(!empty($request->new_password)){
            $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
            ]);

            Admin::find(1)->update(['password'=> Hash::make($request->new_password)]);
        }
        
       $user = Admin::find(1);
       
       if($request->hasFile('admin_avatar')){
        $profilePath = $this->csm_upload($request, 'admin_avatar');
        $user->profile = $profilePath;
       }
       
       $user->name =$request['name'];
       $user->email =$request['email'];
       $user->save();
       return redirect(route('admin.settings'))->with('status', 'Settings Has Been updated');
       
    }

    function social_up(Request $request)
    {

    $yt = socialmedia::where('id',$request->Youtube_id)->first();
    if($request->Youtube_st=="on"){ $yt->status = 1; }else{ $yt->status = 0; }
    $yt->url = $request->Youtube_url;
    $yt->save();

    $fb = socialmedia::where('id',$request->Facebook_id)->first();
    if($request->Facebook_st=="on"){ $fb->status = 1; }else{ $fb->status = 0; }
    $fb->url = $request->Facebook_url;
    $fb->save();

    $tg = socialmedia::where('id',$request->Telegram_id)->first();
    if($request->Telegram_st=="on"){ $tg->status = 1; }else{ $tg->status = 0; }
    $tg->url = $request->Telegram_url;
    $tg->save();

    $tw = socialmedia::where('id',$request->Twitter_id)->first();
    if($request->Twitter_st=="on"){ $tw->status = 1; }else{ $tw->status = 0; }
    $tw->url = $request->Twitter_url;
    $tw->save();

    $red = socialmedia::where('id',$request->Reddit_id)->first();
    if($request->Reddit_st=="on"){ $red->status = 1; }else{ $red->status = 0; }
    $red->url = $request->Reddit_url;
    $red->save();

    $in = socialmedia::where('id',$request->Instagram_id)->first();
    if($request->Instagram_st=="on"){ $in->status = 1; }else{ $in->status = 0; }
    $in->url = $request->Instagram_url;
    $in->save();

    return redirect(route('admin.settings'))->with('status', 'Social Media Has Been updated');

    }
    
    //SMTP
    public function smtp_settings_update(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'driver' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'encryption' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
        ]);
        //dd($request->all());

        // Update the .env file with new SMTP details
        SetEnv('MAIL_MAILER', $request->driver, false);
        SetEnv('MAIL_HOST', $request->mail_host, false);
        SetEnv('MAIL_PORT', $request->mail_port, false);
        SetEnv('MAIL_USERNAME', $request->mail_username, false);
        SetEnv('MAIL_PASSWORD', $request->mail_password, true);
        SetEnv('MAIL_ENCRYPTION', $request->encryption, false);
        SetEnv('MAIL_FROM_ADDRESS', $request->from_email, true);
        SetEnv('MAIL_FROM_NAME', $request->from_name, true);

        return redirect(route('admin.settings'))->with('status', 'SMTP details has been updated.');
    }    
    
    //Web Config
    public function config_settings_update(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'app_mode' => 'required|string',
            'debug_mode' => 'required|string',
            'offers_feed' => 'required|string',
            'email_verify' => 'required',
            'google_login' => 'required|string',
            'google_client_id' => 'required|string',
            'google_client_secret' => 'required|string',
            'google_callback' => 'required|string',
        ]);

        // Update the .env file with new SMTP details
        SetEnv('APP_ENV', $request->app_mode, false);
        SetEnv('APP_DEBUG', $request->debug_mode, false);
        SetEnv('DISABLE_HOMEPAGE_ADGET_FEATURED_OFFERS', $request->offers_feed, false);
        SetEnv('EMAILVERIFY', $request->email_verify, false);
        SetEnv('GOOGLE_LOGIN', $request->google_login, false);
        SetEnv('GOOGLE_CLIENT', $request->google_client_id, true);
        SetEnv('GOOGLE_SECRET', $request->google_client_secret, false);
        SetEnv('GOOGLE_CALLBACK', $request->google_callback, true);

        return redirect(route('admin.settings'))->with('status', 'Configuration has been updated.');
    }
    
    //Web Config
    public function financial_settings_update(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'refer_join' => 'required|integer',
            'refer_by' => 'required|integer',
            'dollar_value' => 'required|integer',
        ]);
        
        SetEnv('REFER_JOIN', $request->refer_join, false);
        SetEnv('REFER_BY', $request->refer_by, false);
        
        $set = settings::find(1);
        $set->dollar_value = $request->dollar_value;
        $set->save();

        return redirect(route('admin.settings'))->with('status', 'Financial details has been updated.');
    }

    public function pages()
    {
      $pages = pages::paginate(15);
      return view('admin.pages', ['pages'=>$pages]);
    }

    public function edit_page($id)
    {
     $page_data = pages::find($id);
     return view('admin.edit_page', ['page_data'=>$page_data]);
    }

    public function update_page(Request $request, $id)
    {
       $page = pages::find($id);
       $page->title = $request['title'];
       $page->desc = $request['desc'];
       $page->slug = $request['slug'];
       $page->seo_keywords = $request['tags'];
       $page->seo_title = $request['seo_title'];
       $page->seo_desc = $request['seo_desc'];
       $page->footer = $request['footer_status'];
       $page->status = $request['status'];
       $page->save();
       return redirect(route('admin.pageedit', ['id' => $id]))->with('status', 'Page Has Been updated');
    }

    public function add_page()
    {
     return view('admin.add_page');
    }

    public function create_page(Request $request)
    {
       $page = new pages;
       $page->title = $request['title'];
       $page->desc = $request['desc'];
       $page->slug = $request['slug'];
       $page->seo_keywords = $request['tags'];
       $page->seo_title = $request['seo_title'];
       $page->seo_desc = $request['seo_desc'];
       $page->footer = $request['footer_status'];
       $page->save();
       return redirect(route('admin.pages'))->with('status-success', 'Page has been added');
    }

    public function delete_page($id) {
        DB::delete('delete from pages where id = ?',[$id]);
        return redirect(route('admin.pages'))->with('status-alert', 'Page has been deleted');
    }

    public function tracker_glob(Request $request)
    {
        $user = $request->input('user');
        if(isset($user)){
        $userdata = trackers::where('uid',$user)->latest()->paginate(20);
        return view('admin.tracker',['userdata' => $userdata]);
        }

        $userdata = trackers::Orderby('id', 'DESC')->paginate(20);
        return view('admin.tracker_glob',['userdata' => $userdata]);
    }

    public function license()
    {
       return view('license.csm_license');
    }

    public function activate(Request $request)
    {

	 goto TiaOb; jnuYA: $response = curl_exec($ch); goto sGOdS; Hx24F: $domain = isset($pieces["\x68\157\163\164"]) ? $pieces["\x68\157\x73\164"] : $pieces["\x70\141\164\x68"]; goto X8CKD; o2ojf: curl_setopt($ch, CURLOPT_POSTFIELDS, $post); goto jnuYA; hm4Tj: if ($result->code == 300) { $admin = Admin::find(1); $admin->license = $request->license; $admin->domain = $request->domain; $admin->save(); return redirect(route("\141\144\x6d\x69\156\x2e\x64\141\x73\x68\x62\157\x61\162\144"))->with("\x73\x74\141\x74\165\163\x2d\163\165\143\143\145\163\163", $msg); } else { return redirect(route("\141\144\x6d\x69\156\56\x6c\x69\143\145\156\163\x65"))->with("\163\164\x61\164\x75\x73\x2d\141\154\x65\x72\x74", $msg); } goto J1pHa; X8CKD: if (preg_match("\x2f\x28\x3f\120\x3c\x64\x6f\155\x61\151\156\76\x5b\141\x2d\172\x30\x2d\x39\x5d\133\141\55\x7a\x30\55\x39\x5c\x2d\x5d\173\x31\54\66\63\x7d\134\x2e\x5b\x61\x2d\x7a\x5c\56\x5d\x7b\62\x2c\x36\175\x29\44\x2f\151", $domain, $regs)) { $hostPath = $regs["\144\157\x6d\141\x69\x6e"]; } goto KPsSQ; KPsSQ: $post = array("\x61\160\151\x5f\153\x65\171" => "\145\61\x65\65\x62\x63\x30\x36\x2d\x64\x65\x37\141\55\x34\x62\x35\70\x2d\x38\x39\141\x36\55\x32\x32\144\142\x32\65\x36\142\141\144\x35\71", "\x6c\x69\x63\x65\156\x73\145\137\x6b\145\171" => $request->license, "\x69\x64\x65\x6e\164\151\146\x69\145\x72" => "\x31", "\160\x6f\x73\164\x5f\165\x72\154" => $request->domain); goto eT5GS; NNM5u: $this_url = $this_http_or_https . $this_server_name . $_SERVER["\x52\x45\x51\x55\x45\x53\124\137\x55\122\x49"]; goto YElxc; a_YOi: $this_http_or_https = (isset($_SERVER["\110\124\x54\120\123"]) && $_SERVER["\110\124\124\x50\123"] == "\157\156" or isset($_SERVER["\x48\124\x54\120\x5f\130\137\x46\x4f\122\127\101\x52\104\x45\x44\137\120\x52\117\x54\117"]) and $_SERVER["\110\x54\x54\120\x5f\130\x5f\106\117\122\127\x41\x52\104\105\104\x5f\120\122\x4f\124\x4f"] === "\x68\164\x74\x70\x73") ? "\x68\x74\x74\x70\x73\x3a\57\x2f" : "\150\x74\x74\160\72\57\57"; goto NNM5u; sGOdS: curl_close($ch); goto JFRZg; YElxc: $this_ip = getenv("\123\105\x52\126\105\122\x5f\x41\x44\104\122") ?: $_SERVER["\x53\105\x52\126\x45\122\137\x41\x44\x44\x52"] ?: $this->get_ip_from_third_party() ?: gethostbyname(gethostname()); goto zbsO3; bpH5U: curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); goto o2ojf; TiaOb: $this_server_name = getenv("\x53\x45\122\126\105\x52\x5f\116\x41\115\105") ?: $_SERVER["\123\x45\x52\x56\x45\x52\137\x4e\101\x4d\105"] ?: getenv("\x48\x54\124\x50\x5f\x48\117\123\x54") ?: $_SERVER["\110\124\124\120\x5f\x48\117\x53\124"]; goto a_YOi; Y6FGv: $result = $data->response; goto NhYXE; zbsO3: $pieces = parse_url($this_url); goto Hx24F; NhYXE: $msg = $result->message; goto hm4Tj; eT5GS: $ch = curl_init("\x68\164\164\160\x73\72\x2f\57\143\x6f\144\145\x78\56\160\x72\x6f\160\145\x72\156\x61\141\x6d\56\x78\x79\172\x2f\x61\160\x69\x2f\x76\x31\57\x61\143\164\x69\x76\141\164\x65"); goto bpH5U; JFRZg: $data = json_decode($response); goto Y6FGv; J1pHa:
	
    }



}
