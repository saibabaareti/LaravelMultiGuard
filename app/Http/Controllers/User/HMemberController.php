<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Htask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class HMemberController extends Controller
{
  //Holiday Codes
  public function addData1(Request $req)
   {
      foreach ($req->task as $key => $insert) {
       $addData1=[
      'task' =>$req->task[$key],
      'hrs_time' => $req->hrs_time[$key],
      'time' =>$req->time[$key],
      'date'=>$req->date[$key],
      'email'=>Auth::guard('web')->user()->email,
       ];
         DB::table('Htasks')->insert($addData1);
     }

      return redirect()->route('user.whome');
    }



     public function addList1(Request $req){

        $userEmail   = Auth::guard('web')->user()->email;
        $data1 = htask::where('email','=',$userEmail)->get();
        //Avg Task
        $fromdate = $req->input('fromdate');
        $todate   = $req->input('todate');
        $average1  = DB::table('Htasks')->where('email','=',$userEmail)->whereBetween ('date',[$fromdate, $todate])->avg('time');
        $average2  = DB::table('Htasks')->where('email','=',$userEmail)->whereBetween ('date',[$fromdate, $todate])->avg('hrs_time');
       $average =$average1+($average2*60);

       $mintime    = htask::where('email','=',$userEmail)->sum('time');
       $hrstime    = htask::where('email','=',$userEmail)->sum('hrs_time');
       $min1=($hrstime*60)+($mintime);

        $time=time();
        $atime1=date('D d M Y  ',$time);

         //Monthly TAsk
        if($req->has('frommonth'))
        {
           $year=Carbon::parse($req->input('frommonth'))->year;
           $month=Carbon::parse($req->input('frommonth'))->month;
           $querys = DB::table('Htasks')->whereYear('date','=',$year)->whereMonth('date','=',$month)->get();
           return view('dashboard.user.homel',compact('data1','min1','atime1','average','querys'));
        }
        return view('dashboard.user.homel',compact('data1','min1','atime1','average'));
    }


    function delete1($id){
      $data1=Htask::find($id);
      $data1->delete();
      return redirect()->route('user.whome');
  }

  function showData1($id)
  {
     $data1= Htask::find($id);
     return view('dashboard.user.editl',['data1'=>$data1]);
  }
  function update1(Request $req)
   {
     $data1=Htask::find($req->id);
     $data1->task=$req->task;
     $data1->hrs_time=$req->hrs_time;
     $data1->time=$req->time;
     $data1->date=$req->date;
     $data1->save();
     return redirect()->route('user.whome');

   }


}
