<?php

namespace App\Http\Controllers;

use App\Models\Inout;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $total_income =0;
        $total_outcome =0;

        $today_date = date('Y-m-d');
        $inoutData =Inout::whereDate('date',$today_date)->get();

        foreach($inoutData as $sInoutData) {
            if($sInoutData->type =='in'){
                $total_income += $sInoutData->amount;
            }
            if($sInoutData->type =='out'){
                $total_outcome += $sInoutData->amount;
            }
        }
            //sun day ,monday
        $day_arr=[date('D')];
        $date_arr =[
            [
             'year'=>date('Y'),
            'month'=>date('m'),
            'day'=>date('d'),
            ]
        ];
        // return $date_arr;
        for($i =1; $i<=6; $i++){
            $day_arr[]=date('D',strtotime("-$i day"));
            $new_date = [
                'year'=>date('Y',strtotime("-$i day")),
                'month'=>date('m',strtotime("-$i day")),
                'day'=>date('d',strtotime("-$i day")),
            ];
            $date_arr[] = $new_date;
        }
       
        $income_amount = [];
        $outcome_amount=[];
        foreach($date_arr as $d){
            $income_amount[] =Inout::whereYear('date',$d['year'])
            ->whereMonth('date',$d['month'])
            ->whereDay('date',$d['day'])
            ->where('type', 'in')
            ->sum('amount');

            $outcome_amount[] =Inout::whereYear('date',$d['year'])
            ->whereMonth('date',$d['month'])
            ->whereDay('date',$d['day'])
            ->where('type', 'out')
            ->sum('amount');

        }
        // return $outcome_amount;

        $data = Inout::orderBy('id', 'desc')->get();
        return view('welcome',compact('data','total_income','total_outcome','day_arr','income_amount','outcome_amount'));
    }
    public function store(Request $request)
    {
        // Example using create method
            // Inout::create([
            //     'about' => 'Some about text',
            //     'date' => '2023-01-01',
            //     'type' => 'in',
            // ]);

            // // Example using mass assignment
            // $inout = new Inout();
            // $inout->about = 'Another about text';
            // $inout->date = '2023-02-01';
            // $inout->type = 'out';
            // $inout->save();
        // return request()->all();
        Inout::create([
            'amount' => $request->amount,
            'about' => $request->about,
            'date' => $request->date,
            'type' => $request->type
        ]);
        return redirect()->back()->with('success','data Stored');
        // $request->validate([
        //     'amount' => 'required|numeric',
        //     'about' => 'required|string',
        //     'date' => 'required|date',
        //     'type' => 'required|in:in,out',
        // ]);
        
        $validatedData = $request->validate([
            'about' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in,out',
            'amount' => 'required|numeric',
        ]);
        Inout::create($validatedData);
        // // Redirect back with success message
        // return redirect()->back()->with('success', 'Data stored successfully');     
           
    }
}
    