<?php

namespace App\Http\Controllers\Postback;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\trackers;
use DB;

class OfferController extends Controller
{
    public function adgem(Request $r)
    {
        if (DB::table('users')->where('id', $r->player_id)->exists()) {
            $settings = DB::table('settings')->select('ADGEM_POSTBACK_KEY')->first();
            $ADGEM_POSTBACK_KEY = $settings->ADGEM_POSTBACK_KEY;
                    // securely supply the static whitelist ip and your secret postback key using env variables
            // get the full request url
            $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $request_url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            // parse the url and query string
            $parsed_url = parse_url($request_url);

            // get the verifier value
            $verifier = $query_string['verifier'] ?? null;
            if (is_null($verifier)) {
                http_response_code(422);
                exit("Error: missing verifier");
            }

            // rebuild url without the verifier
            unset($query_string['verifier']);
            $hashless_url = $protocol.'://'.$parsed_url['host'].$parsed_url['path'].'?'.http_build_query($query_string, "", "&", PHP_QUERY_RFC3986);

            // calculate the hash and verify it matches the provided one
            $calculated_hash = hash_hmac('sha256', $hashless_url, $ADGEM_POSTBACK_KEY);
            if ($calculated_hash !== $verifier) {
                http_response_code(422);
                exit('Error: invalid verifier');
            }

                $user = User::Where('id',$r->player_id)->first();
                $user->points += $r->amount;
                $user->offer_play += 1;
                $add_track = new trackers;
                $add_track->user_id = $user->id;
                $add_track->transation = 'Adgem offer';
                $add_track->type = 1;
                $add_track->points = $r->amount;
                $add_track->extra = $user->uid;
                $add_track->time = time();
                $add_track->ip = $r->ip();
                $add_track->save();
                $user->save();
                
                if(offer_status::Where('id',$r->player_id)->Where('offer_id',$r->campaign_id)->exists()){
                    $add_offer = offer_status::Where('id',$r->player_id)->Where('offer_id',$r->campaign_id)->first();
                    $add_offer->status = 1;
                    $add_offer->save();
                    return response()->json([
                        'error'=>'false',
                       ]);
                }
            http_response_code(200);
            exit('OK');
        }
        
    
    }

        public function cpalead(Request $r){
            //https://yourdomain.com/?subid={subid}&virtual_currency={virtual_currency}&&password={password}
    
            if($r->ip()=='34.69.179.33'){
                $type = 0;
                    //Safe to proccess next
                    $uid = $_GET['subid'];
                    $point_value = $_GET['virtual_currency'];
    
                    $user = User::Where('id',$uid)->first();
                    $user->points += $point_value;
                    $user->offer_play += 1;
                    $add_track = new trackers;
                    $add_track->user_id = $user->id;
                    $add_track->transation = 'CPALead offer';
                    $add_track->type = 1;
                    $add_track->points = $point_value;
                    $add_track->extra = $user->id;
                    $add_track->time = time();
                    $add_track->ip = $r->ip();
                    $add_track->save();
                    $user->save();
                    
                    
                    echo 'success';
                    http_response_code(200);
                
    
            }else {
                    echo 'failed';
                    http_response_code(301);
                }
        }
            
            
        public function offertoro(Request $r){
        //https://yourdomain.com/?user_id={user_id}&amount={amount}&o_name={o_name}&oid={oid}&payout={payout}&ip_address={ip_address}&event={event}&conversion_ts={conversion_ts}
            if($r->ip()=="54.175.173.245"){
                $type = 0;
                //Safe to proccess next
                $uid = $_GET['user_id'];
                $point_value = $_GET['amount'];
                $offer_title = $_GET['o_name'];
                $offer_id = $_GET['oid'];
                $payout = $_GET['payout'];
            
                $user = User::Where('id',$r->user_id)->first();
                $user->points += $r->amount;
                $user->offer_play += 1;
                $add_track = new trackers;
                $add_track->user_id = $user->id;
                $add_track->transation = 'Offertoro offer';
                $add_track->type = 1;
                $add_track->points = $r->amount;
                $add_track->extra = $user->uid;
                $add_track->time = time();
                $add_track->ip = $r->ip();
                $add_track->save();
                $user->save();
                
                $time = time();

                DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip,time,type)
                values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [$uid, 'Offertoro offer',$offer_id, $offer_title, "$point_value", $payout, $r->ip(),$time, $type]);
                echo "1";
                http_response_code(200);
            }else{
                echo "0";
                http_response_code(301);
            }

        }
        
    public function adget(Request $r){
        //?conversion_id={conversion_id}&user_id={s1}&point_value={points}&usd_value={payout}&offer_title={vc_title}
       if($_SERVER["REMOTE_ADDR"] == "52.42.57.125")
        {
            //Safe to proccess next
            $uid = $_GET['user_id'];
            $point_value = $_GET['point_value'];
            $user = User::Where('id',$uid)->first();
            $user->points += $point_value;
            $user->offer_play += 1;
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            $add_track->transation = 'AdGetMedia offer';
            $add_track->type = 1;
            $add_track->points = $point_value;
            if(!empty($r->oid)){
                $add_track->extra = $r->oid;
            }            
            
            if(!empty($r->country)){
                $add_track->extra2 = $r->country;
            }
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'AdGetMedia offer', $r->oid, $r->offer_title, "$point_value", $r->usd_value, $r->ip(), $r->conversion_id,$time,0]);

            echo 'success';
            http_response_code(200);
        }
        else
        {
            echo "error";
            http_response_code(301);
        }

    }
    
    
    
    
        public function ayet(Request $r){
        
        if($r->ip()=='35.165.166.40' or $r->ip()=='35.166.159.131' or $r->ip()=='52.40.3.140'){
            
            $API_KEY= env('AYET_API_KEY','0');

            ksort($_REQUEST, SORT_STRING);
            $sortedQueryString = http_build_query($_REQUEST, '', '&'); // "adslot_id=123&currency_amount=100&payout_usd=1.5...."
            $securityHash = hash_hmac('sha256', $sortedQueryString, $API_KEY);
            if($_SERVER['HTTP_X_AYETSTUDIOS_SECURITY_HASH']===$securityHash) { // actually sent as X-Ayetstudios-Security-Hash but converted by apache2 in this example
                // success
                
                $uid = $_GET['external_identifier'];
                $point_value = $_GET['currency_amount'];
                $offer_title = $_GET['offer_name'];
                $offer_id = $_GET['offer_id'];
                $payout = $_GET['payout_usd'];
                $ip = $_GET['ip'];
                $transaction_id = $_GET['transaction_id'];
                $user_id = $_GET['user_id'];
                $is_chargeback = $_GET['is_chargeback'];
                $device_uuid = $_GET['device_uuid'];
                $device_model = $_GET['device_model'];
                
                // /api/ayet?external_identifier={external_identifier}&currency_amount={currency_amount}&offer_name={offer_name}&offer_id={offer_id}&payout_usd={payout_usd}&ip={ip}&transaction_id={transaction_id}&user_id={user_id}&is_chargeback={is_chargeback}&device_uuid={device_uuid}&device_model={device_model}
                

            // tracker code
            $user_name = "Demo";
            $useremail = "csm@csm.com";
            $userdate = date('Y-m-d');
            $m_time = date('H:i:s');
            $myObj = new \stdClass();
            $myObj->eyeT_user_id = $user_id;
            $myObj->device_uuid = $device_uuid;
            $myObj->device_model = $device_model;
            if($is_chargeback==0){
                
            $user = User::Where('id',$uid)->first();
            $user->points += $point_value;
            $user->offer_play += 1;
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            $add_track->transation = 'ayeT-Studio offer';
            $add_track->type = 1;
            $add_track->points = $point_value;
            if(!empty($offer_id)){
                $add_track->extra = $offer_id;
            }            
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
                
            }elseif($is_chargeback==1){
            // tracker code
            $user_name = "Demo";
            $useremail = "csm@csm.com";
            $userdate = date('Y-m-d');
            $m_time = date('H:i:s');
            $myObj = new \stdClass();
            $myObj->eyeT_user_id = $user_id;
            $myObj->device_uuid = $device_uuid;
            $myObj->device_model = $device_model;
            if($is_chargeback==0){
                
            $user = User::Where('id',$uid)->first();
            $user->points -= $point_value;
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            $add_track->transation = 'ayeT-Studio offer chargeback';
            $add_track->type = 1;
            $add_track->points = $point_value;
            if(!empty($offer_id)){
                $add_track->extra = $offer_id;
            }            
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
                
            }
            
}
        
            $myJSON = json_encode($myObj);
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, extra, trans_id)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$uid, 'ayeT-Studio', $offer_id, $offer_title, "$point_value", $payout, $ip, $myJSON, $transaction_id]);
                
                
                
                http_response_code(200);
            }
            else {
                 http_response_code(301);
            }
        }
        
    }
        
        
    public function mm(Request $r)
    {
        if($r->ip()=='63.32.127.99'){
        $type = 0;
          //  api/mm?user_id={user_id}&point_value={amount}&oid={offerid}
            //Safe to proccess next
            $uid = $_GET['user_id'];
            $point_value = $_GET['amount'];
            $trans = $_GET['transaction_id'];
            $user = User::Where('id',$uid)->first();
            $user->points += $point_value;
            $user->offer_play += 1;
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            $add_track->transation = 'MMWall offer';
            $add_track->type = 1;
            $add_track->points = $point_value;
            if(!empty($r->offerid)){
                $add_track->extra = $r->offerid;
            }            
            
            if(!empty($r->country)){
                $add_track->extra2 = $r->country;
            }
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip,time,type, trans_id)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$uid, "MMWall offer",$r->offerid, $r->offername, "$point_value", $r->payout, $r->user_ip,$time, $type, $trans]);

            echo 'success';
            http_response_code(200);
 
            
        }
    }
    
    
        public function cpxr(Request $r){
       
        if($r->ip()=='188.40.3.73' or $r->ip()=='2a01:4f8:d0a:30ff::2' or $r->ip()=='157.90.97.92'){
            
            $your_app_secure_hash = env('CPX_SECURE_HASH','0');;
            
            //hash is a md5 hash: example: md5({trans_id}-yourappsecurehash) 
            if(!empty($_GET['trans_id'])){
                $trans_id = $_GET['trans_id'];
                $status = $_GET['status'];
                $uid = $_GET['user_id'];
                $point_value = (Int) $_GET['amount_local'];
                $offer_id = $_GET['offer_ID'];
                $payout = $_GET['amount_usd'];
                $ip = $_GET['ip_click'];
                $secure_hash = $_GET['secure_hash'];
                $transaction_id = $_GET['trans_id'];
                //?trans_id={trans_id}&status={status}&user_id={user_id}&amount_local={amount_local}&offer_ID={offer_ID}&amount_usd={amount_usd}&ip_click={ip_click}&secure_hash={secure_hash}
                $sig = md5($trans_id.'-'.$your_app_secure_hash);
                if($sig==$secure_hash){
                    $from = "0";
                    $type = 0;
                    if($status==1){
                        //valid
                        $user = User::Where('id',$uid)->first();
                        $user->points += $point_value;
                        $user->offer_play += 1;
                        $add_track = new trackers;
                        $add_track->user_id = $user->id;
                        $add_track->transation = 'CPXResearch survey offer';
                        $from = 'CPXResearch survey offer';
                        $add_track->type = 1;
                        $add_track->points = $point_value;
                        if(!empty($offer_id)){
                            $add_track->extra = $offer_id;
                        }            
                        
                        $add_track->time = time();
                        $add_track->ip = $r->ip();
                        $add_track->save();
                        $user->save();
                    

                        }
                        else if($status==2) {
                        $type = 1;
                        $user = User::Where('id',$uid)->first();
                        $user->points -= $point_value;
                        $add_track = new trackers;
                        $add_track->user_id = $user->id;
                        $add_track->transation = 'CPXResearch survey offer chargeback';
                        $from = 'CPXResearch survey offer chargeback';
                        $add_track->type = 0;
                        $add_track->points = $point_value;
                        if(!empty($offer_id)){
                            $add_track->extra = $offer_id;
                        }            
                        
                        $add_track->time = time();
                        $add_track->ip = $r->ip();
                        $add_track->save();
                        $user->save();
                    
                        
                        }
                        
                        if(isset($r->type)){
                            if($r->type=="out"){
                                $type = 2;
                            }
                        }
                        
                        
                        $time = time();
                    
                        DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id, time, type)
                        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                        [$uid, "CPXResearch survey offer", "$offer_id", $from, "$point_value", $payout, $ip, $transaction_id, $time, $type]);
                            echo 'success';
                            http_response_code(200);
                            
                }else{
                    echo 'failed';
                    http_response_code(301);
                }

                    
            }
        }else{
                    echo 'failed';
                }

    }
    
    
    public function monli(Request $r){
            
            $secretKey = env('MONLIX_SECRET_KEY','0');
            
            //hash is a md5 hash: example: md5({trans_id}-yourappsecurehash) 
            if(!empty($_GET['secretKey'])){
                $trans_id = $_GET['trans_id'];
                $status = $_GET['status'];
                $uid = $_GET['user_id'];
                $point_value = $_GET['point_value'];
                $offer_id = $_GET['oid'];
                $payout = $_GET['payout'];
                $ip = $_GET['ip_click'];
                $transaction_id = $_GET['trans_id'];
                //https://csmdevelopers.com/super_paisa_test_admin/api/monli?trans_id={{transactionId}}&status={{status}}&user_id={{userId}}&point_value={{rewardValue}}&oid={{transactionId}}&payout={{payout}}&ip_click={userIp}&secretKey={{secretKey}}
                $sig = $_GET['secretKey'];
                if($sig==$secretKey){
                    $from = "0";
                    $type = 0;
                    if($status==1){
                        //valid
                        $user = User::Where('id',$uid)->first();
                        $user->points += $point_value;
                        $user->offer_play += 1;
                        $add_track = new trackers;
                        $add_track->user_id = $user->id;
                        $add_track->transation = 'MonLix offer';
                        $from = 'CPXResearch survey offer';
                        $add_track->type = 1;
                        $add_track->points = $point_value;
                        if(!empty($offer_id)){
                            $add_track->extra = $offer_id;
                        }            
                        
                        $add_track->time = time();
                        $add_track->ip = $r->ip();
                        $add_track->save();
                        $user->save();
                    

                        }
                        else if($status==2) {
                        $type = 1;
                        $user = User::Where('id',$uid)->first();
                        $user->points -= $point_value;
                        $add_track = new trackers;
                        $add_track->user_id = $user->id;
                        $add_track->transation = 'MonLix offer chargeback';
                        $from = 'MonLix offer chargeback';
                        $add_track->type = 0;
                        $add_track->points = $point_value;
                        if(!empty($offer_id)){
                            $add_track->extra = $offer_id;
                        }            
                        
                        $add_track->time = time();
                        $add_track->ip = $r->ip();
                        $add_track->save();
                        $user->save();
                        
                        }
                        
                        $time = time();
                        DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id, time, type)
                        values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
                        [$uid, "Monlix", "$offer_id", $from, "$point_value", $payout, $ip, $transaction_id, $time,$type]);
                            echo 'success';
                            http_response_code(200);
                            
                }else{
                    echo 'failed';
                    http_response_code(301);
                }

                    
            }


    }
    
    
    
    public function bitlab(Request $r){
         // This has to be your App's secret key that you can find on the Dashboard
        $secret_key = env('BITLABS_SECRET_KEY','0');;
        // Get the currently active http protocol
        $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https" : "http";
        // Build the full callback URL
        // Example: https://url.com?param1=foo&param2=bar&hash=3171f6b78e06cadcec4c9c3b15f858b8400e8738
        $url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // Save all query parameters of the callback into the $params array
        $url_components = parse_url($url);
        parse_str($url_components["query"], $params);
        // Get the callback URL without the "hash" query parameter
        // Example: https://url.com?param1=foo&param2=bar
        $url_val = substr($url, 0, -strlen("&hash=$params[hash]"));
        // Generate a hash from the complete callback URL without the "hash" query parameter
        $hash = hash_hmac("sha1", $url_val, $secret_key);
        
        //Check if the generated hash is the same as the "hash" query parameter
        if ($params["hash"] === $hash) {
            ///api/bit?uid=28647&amount=8750&offer_name=&offer_id=&payout=1.75&ip_address=8750&trans_id=434703502&country=IN&s_minuts=7&type=COMPLETE&task_id=&pre_ref=&hash=e04ff0ff1b7f6ea3cf66047352a899d5d2669977
                $uid = $_GET['uid'];
                $point_value = $_GET['amount'];
                $offer_title = $_GET['offer_name'];
                $offer_id = $_GET['offer_id'];
                $payout = $_GET['payout'];
                //$ip = $_GET['ip_address'];
                $transaction_id = $_GET['trans_id'];
                $country = $_GET['country'];
                $s_minuts = $_GET['s_minuts'];
                $type = $_GET['type'];
                $task_id = $_GET['task_id'];
                if(!empty($_GET['pre_ref'])){
                $pre_ref = $_GET['pre_ref'];
                }else{
                    $pre_ref = 0;
                }
            
            // tracker code
            $user_name = "Demo";
            $useremail = "csm@csm.com";
            $userdate = date('Y-m-d');
            $m_time = date('H:i:s');
            
            
 
            if($pre_ref!=0){
                $myObj->previous_reference = $pre_ref;
            }
            $typee = 0;
            if($type=="COMPLETE"){
                    //valid
                    $user = User::Where('id',$uid)->first();
                    $user->points += $point_value;
                    $user->offer_play += 1;
                    $add_track = new trackers;
                    $add_track->user_id = $user->id;
                    $add_track->transation = 'BitLabs survey offer';
                    $add_track->type = 1;
                    $add_track->points = $point_value;
                    if(!empty($offer_id)){
                        $add_track->extra = $offer_id;
                    }            
                    
                    $add_track->time = time();
                    $add_track->ip = $r->ip();
                    $add_track->save();
                    $user->save();
                
                    
                
            }elseif($type=="RECONCILIATION"){
                $typee = 1;
                        $user = User::Where('id',$uid)->first();
                        $user->points -= $point_value;
                        $add_track = new trackers;
                        $add_track->user_id = $user->id;
                        $add_track->transation = 'BitLabs survey chargeback';
                        $add_track->type = 0;
                        $add_track->points = str_replace("-","",$point_value);
                        if(!empty($offer_id)){
                            $add_track->extra = $offer_id;
                        }            
                        $add_track->time = time();
                        $add_track->ip = $r->ip();
                        $add_track->save();
                        $user->save();

                        
            }elseif($type=="SCREENOUT"){
                    //valid
                    $typee = 2;
                    $user = User::Where('id',$uid)->first();
                    $user->points += $point_value;
                    $user->offer_play += 1;
                    $add_track = new trackers;
                    $add_track->user_id = $user->id;
                    $add_track->transation = 'BitLabs survey screenout';
                    $add_track->type = 1;
                    $add_track->points = $point_value;
                    if(!empty($offer_id)){
                        $add_track->extra = $offer_id;
                    }            
                    
                    $add_track->time = time();
                    $add_track->ip = $r->ip();
                    $add_track->save();
                    $user->save();
                    
                
            }
        
            $time = time();
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, coins, amount, trans_id, country,time,type,offer_name)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?,?)',
            [$uid, 'BitLabs', $offer_id, $point_value, $payout, $transaction_id, $country, $time,$typee,$offer_title]);
            
          echo "valid";
        } else {
          echo "invalid";
        }
                 
     }
    
    
    public function wann(Request $r){
        //api/wann?uid={user_id}&transaction_id={transaction_id}&payout={payout}&point_value={reward}&ip={ip}&type={status}&oname={offer_name}&oid={offer_id}&signature={signature}
       if($_SERVER["REMOTE_ADDR"] == "3.22.177.178")
        {
            $secret = env('WANNADS_SECRET','0');;
            //Safe to proccess next
            $uid = $_GET['uid'];
            $point_value = $_GET['point_value'];
            $trans_id = $_GET['transaction_id'];
            $type = $_GET['type'];
            $offer_id = $_GET['oid'];
            $offer_name = $_GET['oname'];
            $payout = $_GET['payout'];
            $ip = $_GET['ip'];
            $signature = isset($_GET['signature']) ? $_GET['signature'] : null;
            // validate signature
            if(md5($uid.$trans_id.$point_value.$secret) != $signature)
            {
                echo "ERROR: Signature doesn't match";
                return;
            }
            $typee = 0;
            if($type=="credited"){
                $typee = 0;
                $user = User::Where('id',$uid)->first();
                $user->points += $point_value;
                $user->offer_play += 1;
                $add_track = new trackers;
                $add_track->user_id = $user->id;
                $add_track->transation = 'WannAds offer';
                $add_track->type = 1;
                $add_track->points = $point_value;
                $add_track->time = time();
                $add_track->ip = $r->ip();
                $add_track->date = date('Y-m-d');
                $add_track->save();
                $user->save();
                
                
                
            }elseif($type=="rejected"){
                $typee = 1;
                $user = User::Where('id',$uid)->first();
                $user->points -= $point_value;
                $add_track = new trackers;
                $add_track->user_id = $user->id;
                $add_track->transation = 'WannAds offer chargeback';
                $add_track->type = 0;
                $add_track->points = $point_value;
            
                $add_track->time = time();
                $add_track->ip = $r->ip();
                $add_track->date = date('Y-m-d');
                $add_track->save();
                $user->save();
                
                
                
            }
            

            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, coins, amount, user_ip, trans_id,time,type,date)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$uid, 'WannAds offer', "$point_value", $r->payout, $ip, $r->transactionID,time(),$typee,date('Y-m-d')]);
            
            
            echo 'success';
            http_response_code(200);
        }
        else
        {
            echo "error";
            http_response_code(301);
        }

    }
    
    
        public function revlum(Request $r){
        
        /* offerwall params // GET Method in Postback!!
          api/revlum?subId={subId}&reward={reward}&offerId={offerId}&offerName={offerName}&payout={payout}&transId={transId}&userIp={userIp}&country={country}&signature={signature}*/
          if($_SERVER["REMOTE_ADDR"] == "209.159.156.198")
  
          {
              
             $secret = env('REVLUM_SECRET_KEY'); // Get your secret key from Revlum
  
             $subId = isset($_REQUEST['subId']) ? $_REQUEST['subId'] : null;
             $transId = isset($_REQUEST['transId']) ? $_REQUEST['transId'] : null;
             $reward = isset($_REQUEST['reward']) ? $_REQUEST['reward'] : null;
             $signature = isset($_REQUEST['signature']) ? $_REQUEST['signature'] : null;
           
             // Validate Signature
             if(md5($subId.$transId.$reward.$secret) != $signature)
             {
               echo "ERROR: Signature doesn't match";;
              return;
             }
    
              //Safe to proccess next
              $uid = $_GET['subId'];
              $point_value = $_GET['reward'];
              $oId = $_GET['offerId'];
              $oName = $_GET['offerName'];
              $oPayout = $_GET['payout'];
              $oTransId = $_GET['transId'];
              $userIp = $_GET['userIp'];
              $userCountry = $_GET['country'];
              
              $user = User::Where('id',$uid)->first();
              $user->points += $point_value;
              $add_track = new trackers;
              $add_track->user_id = $user->id;
              $add_track->transation = 'Revlum';
              $add_track->type = 1;
              $add_track->points = $point_value;
              if(!empty($oId)){
                  $add_track->extra = $oId;
              }            
              
              $add_track->time = time();
              $add_track->ip = $r->ip();
              $add_track->save();
              $user->save();
              
              $time = time();
              
              DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
              values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
              [$uid, 'Revlum', $oId, $oName, "$point_value", $oPayout, $userIp, $oTransId,$time,0]);
  
              echo 'ok';
              http_response_code(200);
          }
          else
          {
              echo "error code";
              http_response_code(301);
          }
  
      }
    
      public function lootably(Request $r){
        //api/lootably?conversion_id={transactionID}&user_id={userID}&point_value={currencyReward}&usd_value={revenue}&offer_title={offerName}&ip={ip}&status={status}&hash={hash}
        
        $check_hash = hash("sha256", $r->user_id . $r->ip . $r->usd_value . $r->point_value . env("LOOTABLY_SECRET","JjJuhXvwtFQNM9IYniarodb4q4F7KnZ0rro2mhTNAD7HE9tUYmQn0HLOEFRI4X0rfsjjrnBxakVdgO8gPphQ"));
        
       if($check_hash == $r->hash)
        {
            //Safe to proccess next
            $uid = $_GET['user_id'];
            $point_value = $_GET['point_value'];
            $status = $_GET['status'];
            $user = User::Where('id',$uid)->first();
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            
            $offerWallName = "Lootably";
            $tansType = 0;

            if($status==1){
                //Add coins
                $add_track->transation = 'Lootably';
                $add_track->type = 1;
                $user->points += $point_value;
            }
            elseif($status==0){
                // Chargeback
                $add_track->transation = 'Lootably chargeback';
                $add_track->type = 0;
                $user->points -= $point_value;
                $offerWallName = 'Lootably chargeback';
                $tansType = 1;
            }

            $add_track->points = $point_value;
            if(!empty($r->oid)){
                $add_track->extra = $r->oid;
            }            
            
            if(!empty($r->country)){
                $add_track->extra2 = $r->country;
            }
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'Lootably', $r->oid, $r->offer_title, "$point_value", $r->usd_value, $r->ip, $r->conversion_id,$time,$tansType]);
            if(!empty($user->refer_by)){
                $this->ReferCoins($r,$user->refer_by,$user->id,$point_value);
            }
            echo '0';
            http_response_code(200);
        }
        else
        {
            echo "1";
            http_response_code(301);
        }

    }
    
    

        public function inbrain(Request $r){
        /*
        POST http://yourdomainname.com/api/inbrain
        {
            "Sig": "cd917216cb4cb02648bb96ac77760269",
            "PanelistId": "testing@inbrain.ai",
            "RewardType": "survey_disqualified",
            "RewardId": "c55b3483-5755-42f8-9bc5-5c185862e35a",
            "Reward": 72,
            "SessionId": "custom_session_value",
            "RevenueAmount": 0.35,
            "IsTest": false
        }*/
    
        $check_hash = md5($r->PanelistId . $r->RewardId . env("INBRAIN_CALLBACK_SECRET","0"));
        
       if($check_hash == $r->Sig)
        {
            //Safe to proccess next
            $uid = $_GET['PanelistId'];
            $point_value = $_GET['Reward'];
            $status = $_GET['RewardType'];
            $user = User::Where('id',$uid)->first();
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            
            $offerWallName = "InBrain";
            $tansType = 0;

            if($status=="survey_completed"){
                //Add coins
                $add_track->transation = 'InBrain';
                $add_track->type = 1;
                $user->points += $point_value;
            }
            elseif($status=="survey_disqualified"){
                // Chargeback
                $add_track->transation = 'InBrain chargeback';
                $add_track->type = 0;
                $user->points -= $point_value;
                $offerWallName = 'InBrain chargeback';
                $tansType = 1;
            }

            $add_track->points = $point_value;
            if(!empty($r->oid)){
                $add_track->extra = $r->oid;
            }            
            
            if(!empty($r->country)){
                $add_track->extra2 = $r->country;
            }
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'InBrain', $r->RewardId, $r->offer_title, "$point_value", $r->RevenueAmount, $r->ip, $r->Sig,$time,$tansType]);

            echo '0';
            http_response_code(200);
        }
        else
        {
            echo "failed";
            http_response_code(301);
        }

    }
    
    
    public function notik(Request $r){
        //api/notik?user_id={user_id}&amount={amount}&offer_id={offer_id}&offer_name={offer_name}&payout={payout}&txn_id={txn_id}&hash={hash}

        $hash = $_REQUEST['hash'];

        $secretKey = env("NOTIK_SECRET","0"); // This has to be your App's secret key that you can find in you App detail page
        $protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") ? "https" : "http";
        $url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlWithoutHash = substr($url, 0, -strlen("&hash=$hash"));
        $generatedHash = hash_hmac("sha1", $urlWithoutHash, $secretKey);

        /*Check if the generated hash is the same as the "hash" query parameter*/
       if($generatedHash == $hash && $r->ip() == "192.53.121.112")
        {
            //Safe to proccess next
            $uid = $_GET['user_id'];
            $point_value = $_GET['amount'];
            $user = User::Where('id',$uid)->first();
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            
            $offerWallName = "Notik";
            $tansType = 0;

            //Add coins
            $add_track->transation = 'Notik';
            $add_track->type = 1;
            $user->points += $point_value;

            $add_track->points = $point_value;
 
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'Notik', $r->offer_id, $r->offer_name, "$point_value", $r->payout, $r->ip(), $r->txn_id,$time,$tansType]);
            if(!empty($user->refer_by)){
                $this->ReferCoins($r,$user->refer_by,$user->id,$point_value);
            }
            echo '0';
            http_response_code(200);
        }
        else
        {
            echo "1";
            http_response_code(301);
        }

    }


    public function admantum(Request $r){
        //api/admantum?uid={uid}&of_id={of_id}&of_name={of_name}&virtual_currency={virtual_currency}&status={status}&payout={payout}&transaction_id={transaction_id}&hash={hash}

        // Your App Secret Key from AdMantum
        $secret_key = env("ADMANTUM_SECRET","0");

        // Setup postback variables.  
        // For a complete list of parameters visit https://admantum.com/documentation/#pb-parameters

        $userId = $_REQUEST['uid'];
        $offerId = $_REQUEST['of_id'];
        $offerName = $_REQUEST['of_name'];
        $virtual_currency = $_REQUEST['virtual_currency'];
        $hash_signature = $_REQUEST['hash'];
        $status = $_REQUEST['status'];

        if($hash_signature === md5($userId.$offerId.$virtual_currency.$secret_key))
        {
            //Safe to proccess next
            $uid = $_GET['uid'];
            $point_value = $_GET['virtual_currency'];
            $status = $_GET['status'];
            $user = User::Where('id',$uid)->first();
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            
            $offerWallName = "AdMantum";
            $tansType = 0;

            if($status==1){
                //Add coins
                $add_track->transation = 'AdMantum';
                $add_track->type = 1;
                $user->points += $point_value;
            }
            elseif($status==0){
                // Chargeback
                $add_track->transation = 'AdMantum chargeback';
                $add_track->type = 0;
                $user->points -= $point_value;
                $offerWallName = 'AdMantum chargeback';
                $tansType = 1;
            }

            $add_track->points = $point_value;
            
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'AdMantum', $offerId, $offerName, "$point_value", $r->payout, $r->ip, $r->transaction_id,$time,$tansType]);
            if(!empty($user->refer_by)){
                $this->ReferCoins($r,$user->refer_by,$user->id,$point_value);
            }
            echo "OK";
            http_response_code(200);
        }
        else
        {
            echo "NOT OK";
            http_response_code(301);
        }

    }
      
      
    public function Adscend(Request $r){
        //api/Adscend?user_id=[SB1]&amount=[CUR]&offer_id=[OID]&offer_name={offer_name}&payout=[PAY]&offer_name=[ONM]&txn_id=[TID]


        /*Check if the generated hash is the same as the "hash" query parameter*/
       if($r->ip() == "54.204.57.82" or $r->ip() == "52.117.122.183" or $r->ip() == "52.117.127.192" or $r->ip() == "52.117.121.196")
        {
            //Safe to proccess next
            $uid = $_GET['user_id'];
            $point_value = $_GET['amount'];
            $user = User::Where('id',$uid)->first();
            $add_track = new trackers;
            $add_track->user_id = $user->id;
            
            $offerWallName = "AdscendMedia";
            $tansType = 0;

            //Add coins
            $add_track->transation = 'AdscendMedia';
            $add_track->type = 1;
            $user->points += $point_value;

            $add_track->points = $point_value;
 
            $add_track->time = time();
            $add_track->ip = $r->ip();
            $add_track->save();
            $user->save();
            
            $time = time();
            
            DB::insert('insert into offer_historys (uid, offerwall_name, offer_id, offer_name, coins, amount, user_ip, trans_id,time,type)
            values (?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [$uid, 'AdscendMedia', $r->offer_id, $r->offer_name, "$point_value", $r->payout, $r->ip(), $r->txn_id,$time,$tansType]);
            if(!empty($user->refer_by)){
                $this->ReferCoins($r,$user->refer_by,$user->id,$point_value);
            }
            echo '0';
            http_response_code(200);
        }
        else
        {
            echo "1";
            http_response_code(301);
        }

    }
      

}
