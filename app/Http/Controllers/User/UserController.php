<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Htask;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgetPasswordMail;

class UserController extends Controller
{
 function create(Request $request){
     $request->validate([
         'name'      => 'required',
         'email'     => 'required|email|unique:users,email',
         'password'  => 'required|min:6|max:15',
         'cpassword' => 'required|same:password'
     ],[
         'cpassword.required' => 'The Confirm field is Required',
         'cpassword.same'     => 'The Confirm password and Password must Match'
     ]);
     $user           = new User();
     $user->name     = $request->name;
     $user->email    = $request->email;
     $user->password = Hash::make($request->password);
     $data           = $user->save();

    if($data){
       return redirect()->back()->with('success','You have Register Successfully');
    }else{
        return redirect()->back()->with('error','Registeration Failed');
    }
 }

 public function dologin(Request $request){
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6|max:15'
     ]);
     $check = $request->only('email','password');
     if(Auth::guard('web')->attempt($check)){
       $useName=Auth::guard('web')->user()->name;
        return redirect()->route('user.home')->with('success','Welcome To Home Dashboard '. $useName );
     }else{
        return redirect()->back()->with('error','Login Failed');

     }
 }

 public function logout(Request $request){
     Auth:: guard('web')->logout();
     return redirect('/');
 }

 /* Adding Data tsak to DB*/
 public function add(Request $req)
 {
   foreach ($req->task as $key => $insert) {
    $addData=[
      'task'  => $req->task[$key],
      'hrs_time' => $req->hrs_time[$key],
      'time'  => $req->time[$key],
      'date'  => $req->date[$key],
      'email' => Auth::guard('web')->user()->email,
    ];
    DB:: table('tasks')->insert($addData);
   }

    return redirect()->route('user.home');

 }
    public function addList(Request $req){

        $userEmail   = Auth::guard('web')->user()->email;

        $data   = task::where('email','=',$userEmail)->get();



       // Average TASk
        $fromdate = $req->input('fromdate');
        $todate   = $req->input('todate');
        $average1  = DB::table('tasks')->where('email','=',$userEmail)->whereBetween ('date',[$fromdate, $todate])->avg('time');
        $average2  = DB::table('tasks')->where('email','=',$userEmail)->whereBetween ('date',[$fromdate, $todate])->avg('hrs_time');
       $average =$average1+($average2*60);


        $mintime    = task::where('email','=',$userEmail)->sum('time');
        $hrstime    = task::where('email','=',$userEmail)->sum('hrs_time');
        $min=($hrstime*60)+($mintime);
        $time   = time();
        $atime  = date('D d M Y  ',$time);


       // monthly task
        if($req->has('frommonth'))
        {
             $year=Carbon::parse($req->input('frommonth'))->year;
             $month=Carbon::parse($req->input('frommonth'))->month;
            $querys = DB::table('tasks')->whereYear('date','=',$year)->whereMonth('date','=',$month)->get();

            return view('dashboard.user.home',compact('data','min','atime','average','querys'));
        }



        return view('dashboard.user.home',compact('data','min','atime','average'));
    }

    function delete($id){
        $data = Task::find($id);
        $data->delete();
        return redirect()->route('user.home')->with('success','Task Deleted');
    }

    function showData($id)
    {
       $data = Task::find($id);
       return view('dashboard.user.edit',['data'=>$data]);
    }
    function update(Request $req)
     {

       $data       = Task::find($req->id);
       $data->task = $req->task;
       $data->hrs_time = $req->hrs_time;
       $data->time = $req->time;
       $data->date = $req->date;
       $data->save();
       return redirect()->route('user.home');

     }

   public function getForgetPassword()
   {
   return view ('dashboard.user.forget_password');
   }

   public function postForgetPassword(Request $req)
   {
    $req->validate([
        'email'    => 'required|email',
     ]);
     $user = User::where('email',$req->email)->first();
     if(!$user){
        return redirect()->back()->with('error','User not found');
     }
     else{
          $reset_code=Str::random(200);

          PasswordReset::create([
           'user_id'=>$user->id,
           'email'=>$user->email,
           'reset_code'=>$reset_code
          ]);


          Mail::to($user->email)->send(new ForgetPasswordMail($user->name,$reset_code));

          return redirect()->back()->with('success','we have sent you a password reset link.please check your Email');
     }

   }
   function getResetPassword($reset_code){
    $password_reset_data=PasswordReset::where('reset_code',$reset_code)->first();

    if(!$password_reset_data || Carbon::now()->subMinutes(10)> $password_reset_data->created_at){
     return redirect()->route('user.getResetPassword')
     ->with('error','Invalid password reset link or Link expired');
    }else{
        return view('dashboard.user.reset_password',compact('reset_code'));
    }

}

public function postResetPassword($reset_code,Request $req){
    $password_reset_data=PasswordReset::where('reset_code',$reset_code)->first();

    if(!$password_reset_data || Carbon::now()->subMinutes(10)> $password_reset_data->created_at){
        return redirect()->route('user.getResetPassword')
        ->with('error','Invalid password reset link or Link expired');
       }else{
        $req->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:6|max:15',
            'cpassword' => 'required|same:password'
        ]);
        $user =User::find($password_reset_data->user_id);

        if($user->email!=$req->email){
            return redirect()->back()->with('error','Enter Correct Email');
        }else{
            $password_reset_data->delete();
            $user->update([
                'password'=>Hash::make($req->password)
            ]);
            return redirect()->route('user.login')->with('success','Password succesfully reset');
        }
       }
}


}
