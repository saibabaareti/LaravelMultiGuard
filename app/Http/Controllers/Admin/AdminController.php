<?php

namespace App\Http\Controllers\Admin;
use App\Models\Htask;
use App\Models\Task;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{

 public function dologin(Request $request){
    $request->validate([
        'email'=>'required|email|exists:admins,email',
        'password'=>'required|min:6|max:15'
     ],[
         'email.exists'=>'This email is not Registerd into our system.'
     ]);
     $check =$request->only('email','password');
     if(Auth::guard('admin')->attempt($check)){
        return redirect()->route('admin.home')->with('success','Welcome To Admin Dashboard');
     }else{
        return redirect()->back()->with('error','Login Failed');

     }
 }

 public function logout(Request $request){
     Auth::guard('admin')->logout();
     return redirect()->route('user.home');
 }




 public function addList(Request $req){


    $data   = task::all();

    $hdata  = Htask::all();

 // for avg task time
    $usersEmails=user::all();
    $fromdate = $req->input('fromdate');
    $todate   = $req->input('todate');
    $Uemail = $req->input('email');

    $average1  = DB::table('tasks')->where('email','=',$Uemail)->whereBetween('date',[$fromdate, $todate])->avg('time');
    $average2  = DB::table('tasks')->where('email','=',$Uemail)->whereBetween('date',[$fromdate, $todate])->avg('hrs_time');
    $average=$average1+($average2*60);

// for holiday task avg time
    $holidayfromdate = $req->input('holidayfromdate');
    $holidaytodate   = $req->input('holidaytodate');
    $holidayemail = $req->input('holidayemail');

    $haverage1  = DB::table('htasks')->where('email','=',$holidayemail)->whereBetween('date',[$holidayfromdate, $holidaytodate])->avg('time');
    $haverage2  = DB::table('htasks')->where('email','=',$holidayemail)->whereBetween('date',[$holidayfromdate, $holidaytodate])->avg('hrs_time');
    $holidayaverage=($haverage1)+($haverage2*60);
    //dd($holidayaverage);

    $mintime=DB::table('tasks')->sum('time');
    $hrstime    = DB::table('tasks')->sum('hrs_time');
    $min=($hrstime*60)+($mintime);

    $hmintime=DB::table('Htasks')->sum('time');
    $hourtime=DB::table('Htasks')->sum('hrs_time');
    $hmin=($hourtime*60)+($hmintime);

    $time   = time();
    $admintime  = date('D d M Y',$time);

// for month report
   if($req->has('frommonth'))
   {
    $year=Carbon::parse($req->input('frommonth'))->year;
    $month=Carbon::parse($req->input('frommonth'))->month;
    $monthemail = $req->input('monthemail');
    $querys = DB::table('tasks')->whereYear('date','=',$year)->whereMonth('date','=',$month)->where('email','=',$monthemail)->get();
    return view('dashboard.admin.home',compact('data','hdata','min','hmin','admintime','usersEmails','average','holidayaverage','querys'));
   }

   return view('dashboard.admin.home',compact('data','hdata','min','hmin','admintime','usersEmails','average','holidayaverage'));
}



function delete($id){
    $data = Task::find($id);
    $data->delete();
    return redirect()->route('admin.home');
}
function hdelete($id){
    $hdata = Htask::find($id);
    $hdata->delete();
    return redirect()->route('admin.home');
}



function showWeekData($id)
{
   $data = Task::find($id);
   return view('dashboard.admin.edit',['data'=>$data]);
}
function weekupdate(Request $req)
 {


   $data = Task::find($req->id);
   $data->task = $req->task;
   $data->hrs_time = $req->hrs_time;
   $data->time = $req->time;
   $data->date = $req->date;
   $data->save();
   return redirect()->route('admin.home');

 }

 function showholidayData($id)
 {
    $data = Htask::find($id);
    return view('dashboard.admin.hedit',['data'=>$data]);
 }
 function holidayupdate(Request $req)
  {
    $data = Htask::find($req->id);
    $data->task = $req->task;
    $data->hrs_time = $req->hrs_time;
    $data->time = $req->time;
    $data->date = $req->date;
    $data->save();
    return redirect()->route('admin.home');

  }





}
