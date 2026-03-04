<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Mail;

class SocialController extends Controller
{

    public function randcode($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function web_logout(Request $request)
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }

    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function getUserInfo($accessToken)
    {
        $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo';
        $response = $this->httpClient->get($userInfoUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function redirectToGoogle()
    {
        $url = 'https://accounts.google.com/o/oauth2/auth';
        $params = [
            'redirect_uri' => config('services.google.redirect'),
            'response_type' => 'code',
            'client_id' => config('services.google.client_id'),
            'scope' => 'openid profile email',
        ];

        return redirect($url . '?' . http_build_query($params));
    }

    public function handleGoogleCallback(Request $request)
    {
        $tokenUrl = 'https://accounts.google.com/o/oauth2/token';
        $params = [
            'code' => $request->get('code'),
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri' => config('services.google.redirect'),
            'grant_type' => 'authorization_code',
        ];

        $response = $this->httpClient->post($tokenUrl, ['form_params' => $params]);
        $Tdata = json_decode($response->getBody(), true);

        $userInfo = $this->getUserInfo($Tdata['access_token']);

        $data = User::where('email', $userInfo['email'])->first();
        if (is_null($data)) {
            $users['name'] = $userInfo['name'];
            $users['email'] = $userInfo['email'];
            $users['picture'] = $userInfo['picture'];
            $users['join_date'] = date('Y-m-d');
            $users['join_time'] = time();
            $users['register_agent'] = \Request::header('User-Agent');
            $users['register_ip'] = \Request::ip();
            $users['status'] = "1";
            $users['is_verified'] = "1";
            $data = User::create($users);

        }

        Auth::login($data);

        User::where('id', Auth::user()->id)
            ->update([
                'login_agent' => \Request::header('User-Agent'),
                'login_ip' => \Request::ip(),
            ]);

        if (!Auth::user()->status == 1) {
            Auth::logout();
            return redirect('/login')->with('status-alert', 'User has been blocked by Admin');
            exit();
        }

        //Global Vars
        $logu_id = Auth::user()->id;
        $today_date = date('Y-m-d');

        //refer system
        if (session()->has('referby') and is_null(Auth::user()->refer_id)) {

            if (is_null(Auth::user()->refer_join_status)) {
                $refjoinuser = Auth::user()->id;
                $referby_userP = env('REFER_BY');
                $joining_userP = env('REFER_JOIN');
                $joining_userIP = \Request::ip();
                $joi_agent = \Request::server('HTTP_USER_AGENT');
                $userid = session('referby');
                $userdate = date('Y-m-d');
                $usertime = time();
                $ip = $request->ip();
                DB::statement("UPDATE `users` SET points = points + $referby_userP, total_referral = total_referral + 1 WHERE id = $userid");
                DB::statement("UPDATE `users` SET points = points + $joining_userP, refer_join_status = 1, refer_by = $userid WHERE id = $refjoinuser");

                DB::insert('insert into refer_historys (refer_by, join_user, joining_user_ip, joining_user_points, refer_by_points, joining_user_agent)
                values (?, ?, ?, ?, ?, ?)',
                    [$userid, $refjoinuser, $joining_userIP, $joining_userP, $referby_userP, $joi_agent]);

                DB::insert('insert into trackers (user_id, points, transation, type, time, date, ip)
        values (?, ?, ?, ?, ?, ?, ?)',
                    [$userid, $referby_userP, "Referral credit", "1", $usertime, $userdate, $ip]);

            } else {

            }

        }
        //ref end

        $myRandomString = $this->randcode(6);

        if (is_null(Auth::user()->refer_id)) {
            $dailymission = DB::table('users')->where('id', $logu_id)->update(
                ['refer_id' => $myRandomString, 'log_date' => $today_date, 'refer_join_status' => 1]
            );
            if ($dailymission) {
                return redirect()->to('/');
            } else {
            }
        } else {
            return redirect()->to('/');
        }

        return redirect()->to('/');

    }

    //Email

    public function verify_account()
    {
        return view('auth.verify_account');
    }

    public function verify_code_resend()
    {

        if (Auth::user()->is_code != null) {
            $vcode = $this->vcode(6);
            $user = User::find(Auth::user()->id);
            $user->is_code = $vcode;
            $user->save();

            $data = ['vcode' => $vcode];
            $user['to'] = Auth::user()->email;
            Mail::send('auth.verify_account_email', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject(env('APP_NAME') . ' Verification code');
            });
        }

        return redirect('/verify-account')->with('status-success', 'Your verification code has been sent to your email address.');
    }

    public function code_verify(Request $request)
    {

        if (Auth::user()->is_code == $request->v_code) {

            $user = User::find(Auth::user()->id);
            $user->is_verified = "1";
            $user->save();

            User::where('id', Auth::user()->id)
                ->update([
                    'login_agent' => \Request::header('User-Agent'),
                    'login_ip' => \Request::ip(),
                ]);

            //Global Vars
            $logu_id = Auth::user()->id;
            $today_date = date('Y-m-d');

            //refer system
            if (session()->has('referby') and is_null(Auth::user()->refer_id)) {

                if (is_null(Auth::user()->refer_join_status)) {
                    $refjoinuser = Auth::user()->id;
                    $referby_userP = env('REFER_BY');
                    $joining_userP = env('REFER_jOIN');
                    $joining_userIP = \Request::ip();
                    $joi_agent = \Request::server('HTTP_USER_AGENT');
                    $userid = session('referby');
                    $userdate = date('Y-m-d');
                    $usertime = time();
                    $ip = $request->ip();
                    DB::statement("UPDATE `users` SET points = points + $referby_userP, total_referral = total_referral + 1 WHERE id = $userid");
                    DB::statement("UPDATE `users` SET points = points + $joining_userP, refer_join_status = 1, refer_by = $userid WHERE id = $refjoinuser");

                    DB::insert('insert into refer_historys (refer_by, join_user, joining_user_ip, joining_user_points, refer_by_points, joining_user_agent)
                values (?, ?, ?, ?, ?, ?)',
                        [$userid, $refjoinuser, $joining_userIP, $joining_userP, $referby_userP, $joi_agent]);

                    DB::insert('insert into trackers (user_id, points, type, transation, time, date, ip)
        values (?, ?, ?, ?, ?, ?)',
                        [$userid, $referby_userP, "Referral credit", "+$referby_userP", $usertime, $userdate, $ip]);

                }
            }
            //ref end

            //create refer random code and update to the table
            if (is_null(Auth::user()->refer_id)) {
                $myRandomString = $this->randcode(6);
                $dailymission = DB::table('users')->where('id', $logu_id)->update(
                    ['refer_id' => $myRandomString, 'log_date' => $today_date, 'refer_join_status' => 1]
                );
            }

            return redirect()->to('/');

        } else {
            return redirect('/verify-account')->with('status-alert', 'Verification code is invalid!!');
        }

    }

}
