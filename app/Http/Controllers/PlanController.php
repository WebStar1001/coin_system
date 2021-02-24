<?php

namespace App\Http\Controllers;

use App\Plan;
use App\TimeSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Manage STO";
        $plan = Plan::all();
        return view('admin.plan.index', compact('page_title', 'plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create New STO";
        $time = TimeSetting::all();
        return view('admin.plan.create', compact('page_title', 'plan','time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'grow' => 'required',
            'times' => 'required',
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.jpg';
            $location = 'assets/images/sto/' . $filename;
            Image::make($image)->save($location);
            $input['image'] = $filename;
        }
        if ($request->status == 1){
            $c = Plan::where('status', 1)->get();
            if (count($c) > 0){
                return back()->with('alert','Can not Run Two STO at a time!');
            }
            $input['name'] = $request->name;
            $input['start_date'] = $request->start_date;
            $input['end_date'] = $request->end_date;
            $input['amount'] = $request->amount;
            $input['price'] = $request->price;
            $input['grow'] = $request->grow;
            $input['times'] = $request->times;
            $input['status'] = $request->status;
        }else{
            $input['name'] = $request->name;
            $input['start_date'] = $request->start_date;
            $input['end_date'] = $request->end_date;
            $input['amount'] = $request->amount;
            $input['price'] = $request->price;
            $input['grow'] = $request->grow;
            $input['times'] = $request->times;
            $input['status'] = $request->status;
        }

        Plan::create($input);
        return back()->with('message', 'Create Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $page_title = "Update STO";
        $time = TimeSetting::all();
        $plan = Plan::whereId($id)->first();
        return view('admin.plan.edit', compact('page_title', 'plan','time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'grow' => 'required',
            'times' => 'required',
        ]);




        $p = Plan::find($id);

        if($request->hasFile('image')){
            @unlink('assets/images/sto/'.$p->image);
            $image = $request->file('image');
            $filename = time().'.jpg';
            $location = 'assets/images/sto/'.$filename;
            Image::make($image)->save($location);
            $input['image'] = $filename;
        }

        if ($p->status == 1 && $request->status == 1){

            $input['name'] = $request->name;
            $input['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
            $input['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
            $input['amount'] = $request->amount;
            $input['price'] = $request->price;
            $input['grow'] = $request->grow;
            $input['times'] = $request->times;
            $input['status'] = $request->status;
            $input['sold'] = $request->sold;

            Plan::whereId($id)->update($input);
            return back()->with('message', 'Update Successfully');

        }else{

            if ($request->status == 1){

                $c = Plan::where('status', 1)->get();
                if (count($c) > 0){
                    return back()->with('alert','Can not Run Two STO at a time!');
                }
                $input['name'] = $request->name;
                $input['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
                $input['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
                $input['amount'] = $request->amount;
                $input['price'] = $request->price;
                $input['grow'] = $request->grow;
                $input['times'] = $request->times;
                $input['status'] = $request->status;
                $input['sold'] = $request->sold;

                Plan::whereId($id)->update($input);
                return back()->with('message', 'Update Successfully');
            }else{

                $input['name'] = $request->name;
                $input['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
                $input['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
                $input['amount'] = $request->amount;
                $input['price'] = $request->price;
                $input['grow'] = $request->grow;
                $input['times'] = $request->times;
                $input['status'] = $request->status;
                $input['sold'] = $request->sold;

                Plan::whereId($id)->update($input);
                return back()->with('message', 'Update Successfully');
            }

        }






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
