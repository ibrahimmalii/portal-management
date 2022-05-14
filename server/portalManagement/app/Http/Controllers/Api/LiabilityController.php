<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Liabilities\LiabilityRequest;
use App\Models\Liability;
use App\Models\LiabilityDate;
use Illuminate\Http\Request;

class LiabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liabilities = Liability::with(['dates' => function ($query) {
            $query->select('id','liability_id', 'date', 'required_amount', 'is_paid');
        }, 'user' => function ($query){
            $query->select('id', 'name', 'name_ar');
        }, 'company' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'subCompany' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }])->get();
        return response()->json($liabilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LiabilityRequest $request)
    {
        $validated = $request->all();
        $storedLiability = Liability::create($validated);
        // insert all milestones date
        foreach($validated['liability_dates'] as $key => $liability){
            LiabilityDate::create([
                'liability_id' => $storedLiability->id,
                'date' => $liability['date'],
                'required_amount' => $liability['required_amount'],
                'is_paid' => $liability['is_paid']
            ]);
        }

        return response()->json(['msg' => 'liability created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
