<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Missions;
use App\Models\Track_missions;
use App\Models\Offers;
use App\Models\User;
use App\Models\trackers;
use App\Models\redeem_requests;
use App\Models\games;
use App\Models\pages;
use Crypt;
use DB;
use Auth;

class HomeController extends Controller
{

    public function csm_offers()
    {
    $data['offers'] = Offers::where('type','0')->paginate(10);
    return view('test',$data);
    }

    public function faqs()
    {
    return view('faqs');
    }


    public function csm_offers_show($id)
    {
    $where = array('id' => $id);
    $user  = Offers::where($where)->first();

    return Response::json($user);
    }

    //API 1
    public function csm_api_offers_show(Request $request,$id)
    {
    if(empty(Auth::user()->id)){
    return "decline";
    }else{
    $user_id = Auth::user()->id;
    }
    $ip = $request->ip();
    $agent = \Request::header('User-Agent');
    $app_id = env('TOROX_APP_ID');
    $pub_id = env('TOROX_PUB_ID');
    $secretkey = env('TOROX_SECRET_KEY');
    $time = time();
    $clientIP = $request->ip();
    $c_code = geo($clientIP)->geoplugin_countryCode;
    $api = "http://www.torox.io/api/";
    $url = "?pubid=$pub_id&appid=$app_id&secretkey=$secretkey&country=$c_code&platform=all&format=json&user_id=$user_id";
    $api_url = str_replace( ' ', '%20', $api.$url);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,// your preferred link
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    ),
    ));
    $resp = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $response = json_decode($resp);
    
    foreach($response->response->offers as $api){
    if($api->offer_id==$id){
    return Response::json($api);
    }
    }
    }

    ///csm cats
    function offer_csm_cat(Request $request,$cat)
    {

    try {

    if(empty(Auth::user()->id)){
      header('Location: /login');
      exit;
    }
    $user_id = Auth::user()->id; 

    $cats = $request->input('cats');

    $ip = $request->ip();
    $agent = \Request::header('User-Agent');
    $app_id = env('TOROX_APP_ID');
    $pub_id = env('TOROX_PUB_ID');
    $secretkey = env('TOROX_SECRET_KEY');
    $time = time();
    $clientIP = $request->ip();
    $c_code = geo($clientIP)->geoplugin_countryCode;
    $api = "http://www.torox.io/api/";
    $url = "?pubid=$pub_id&appid=$app_id&secretkey=$secretkey&country=$c_code&platform=all&format=json&user_id=$user_id";
    $api_url = str_replace( ' ', '%20', $api.$url);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,// your preferred link
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    ),
    ));
    $resp = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $response = json_decode($resp);
    //return response()->json($response->data);

    $jsonData = $response->response->offers;

    $searchTerm = $cat;

    if($searchTerm != "all"){
    $filteredData = array_filter($jsonData, function ($item) use ($searchTerm) {
    return strpos($item->offer_desc, $searchTerm) !== false || strpos($item->offer_name, $searchTerm) !== false || strpos($item->call_to_action, $searchTerm) !== false;
    });
    }else{
      $filteredData = $response->response->offers;
    }

    $filteredData = array_values($filteredData);

    //dd($filteredData);

    return view('offers_by', ['filteredData'=>$filteredData,'cat'=>$cat]);

    } catch (\Exception $e) {
      return redirect()->route('home')->with('error', 'The offer is not available yet!');
  }

    }

    public function web_pages($slug)
    {
      $pages = pages::where('status', 1)->where('slug', $slug)->first();
      if(empty($pages)){ abort(404); }
      DB::table('pages')->where('id', $pages->id)->increment('views');
      return view('pages', ['pages'=>$pages]);
    }

    function csm_redeem_api(Request $request){

    $lat_r = Redeem_requests::select('id','name','points_used','request_amount')->orderBy('id','desc')->first();
    return Response::json($lat_r);

    }

    //api_data
    public function csm_offers_api(Request $request)
    {
        
    if(empty(Auth::user()->id)){ $user_id = 1; }else{ $user_id = Auth::user()->id; }

    $ip = $request->ip();
    $agent = \Request::header('User-Agent');
    $app_id = env('TOROX_APP_ID');
    $pub_id = env('TOROX_PUB_ID');
    $secretkey = env('TOROX_SECRET_KEY');
    $time = time();
    $clientIP = $request->ip();
    $c_code = geo($clientIP)->geoplugin_countryCode;
    $api = "http://www.torox.io/api/";
    $url = "?pubid=$pub_id&appid=$app_id&secretkey=$secretkey&country=$c_code&platform=all&format=json&user_id=$user_id";
    $api_url = str_replace( ' ', '%20', $api.$url);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,// your preferred link
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    ),
    ));
    $resp = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    $response = json_decode($resp);

    return response()->json($response->response->offers);
    }

    public function index(Request $request)
    {
    if(!empty(Auth::user()->id)){
     $user_id = Auth::user()->id;
    }else{
     $user_id = 0;
    }
    
    if(!empty(Auth::user()->id)){
    if(!Auth::user()->status==1){
          Auth::logout();
          return redirect('/login')->with('status-alert', "Your account has been banned due to violating the Terms & Conditions.");
        }
    }
    
     $red_req = Redeem_requests::orderBy('id','desc')->paginate(12);
     $offers = Offers::where('type','0')->where('status',1)->orderBy('rate','desc')->paginate(20);
     $surveys = Offers::where('type','1')->where('status',1)->orderBy('rate','desc')->paginate(20);
     return view('home', ['offers'=>$offers,'surveys'=>$surveys, 'user_id'=>$user_id, 'red_req'=>$red_req]);
    }

    public function leaderboard(){
      $first = User::orderBy('points','desc')->first();
      $second = User::orderBy('points','desc')->skip(1)->first();
      $third = User::orderBy('points','desc')->skip(2)->first();

      $users = User::orderBy('points','desc')->skip(3)->take(47)->get();
      return view('leaderboard', [
     'users'=>$users,
     'first'=>$first,
     'second'=>$second,
     'third'=>$third
    ]);
    }

    public function mission()
    {
     $missions = Missions::where('slug', "game")->where('status', 1)->get();
     $missionsquiz = Missions::where('slug', "quiz")->where('status', 1)->get();
     $missionsoffer = Missions::where('slug', "offer")->where('status', 1)->get();
     return view('missions', ['missions'=>$missions, 'missionsquiz'=>$missionsquiz, 'missionsoffer'=>$missionsoffer]);

    }

    public function missionup(Request $request)
    {
    $encpoints = $request['token_read'];
    $m_ids = Crypt::decryptString($encpoints);
    $Apo = Auth::user()->points;
    $u_id = Auth::user()->id;
    $m_date = date('Y-m-d');
    $u_name = Auth::user()->name;

    $track_m = Track_missions::where('user_id', $u_id)->where('m_id', $m_ids)->where('date', $m_date)->count();

    if(!$track_m > 0){
    $miss_details = Missions::where('m_id', $m_ids)->first();
    $Add_point = $miss_details->points;
    $miss_type = $miss_details->slug;
    $m_type = $miss_details->slug;
    $ip = $request->ip();
    $add_p = $Apo + $Add_point;
    $m_time = time();
    DB::statement("UPDATE `users` SET points = $add_p WHERE id = $u_id");
    DB::insert('insert into track_missions (m_id, user_id, type, name, date, time, ip_address, points)
    values (?, ?, ?, ?, ?, ?, ?, ?)',
    [$m_ids, $u_id, $m_type, $u_name, $m_date, $m_time, $ip, $Add_point]);

    // tracker codes
    $userid = Auth::user()->id;
    $user_name = Auth::user()->name;
    $userdate = date('Y-m-d');
    $madd_type = ucfirst(trans($miss_type));
    DB::insert('insert into trackers (user_id, points, type, transation, time, date)
    values (?, ?, ?, ?, ?, ?)',
    [$userid, $Add_point, 1, "$madd_type Mission", $m_time, $userdate]);
    // tracker codes end

    }
    return redirect(route('game_missons'));
    }


    public function refer_missionup(Request $request)
    {
    $encpoints = $request['ref_token_read'];
    $m_ids = Crypt::decryptString($encpoints);
    $Apo = Auth::user()->points;
    $u_id = Auth::user()->id;
    $m_date = date('Y-m-d');
    $u_name = Auth::user()->name;

    $track_m = Track_missions::where('user_id', $u_id)->where('m_id', $m_ids)->where('date', $m_date)->count();

    if(!$track_m > 0){
    $userss = Missions::where('m_id', $m_ids)->first();
    $Add_point = $userss->points;
    $m_type = $userss->slug;
    $ip = $request->ip();
    $add_p = $Apo + $Add_point;
    $m_time = time();
    DB::statement("UPDATE `users` SET points = $add_p WHERE id = $u_id");
    DB::insert('insert into track_missions (m_id, user_id, type, name, date, time, ip_address, points)
    values (?, ?, ?, ?, ?, ?, ?, ?)',
    [$m_ids, $u_id, $m_type, $u_name, $m_date, $m_time, $ip, $Add_point]);
    }
    return redirect(route('refer_missons'));
    }

    public function referinvite()
    {
     $refer_missions = Missions::where('slug', "refer")->get();
     $loged_id = Auth::user()->id;
     $user = User::where('id', $loged_id)->first();
     return view('invite', ['user'=>$user,'refer_missions'=>$refer_missions]);
    }

    public function user_transaction()
    {
    $u_id = Auth::user()->id;
    $user_transactions = trackers::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(15);
    $requests_data = Redeem_requests::where('user_id', $u_id)->orderBy('id','desc')->get();
    return view('user_transaction', ['user_transactions'=>$user_transactions,'requests_data'=>$requests_data]);
    }




}
