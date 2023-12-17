<?php

namespace App\Http\Controllers;

use App\Models\Inout;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('welcome');
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
            'about' => $request->about,
            'date' => $request->date,
            'type' => $request->type
        ]);
        return redirect()->back()->with('success','data Stored');
        $validatedData = $request->validate([
            'about' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in,out',
        ]);
        Inout::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data stored successfully');     
           
    }
}
    