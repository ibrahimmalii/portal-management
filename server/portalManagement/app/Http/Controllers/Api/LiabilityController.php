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
     * Store all liabilitie dates
     *
     * @param array $validatedData
     * @param integer $liability_id
     * @return void
     */
    public function storeLiabilityDates(array $validatedData, int $liability_id)
    {
        foreach($validatedData['liability_dates'] as $key => $liability){

            LiabilityDate::create([
                'liability_id' => $liability_id,
                'date' => $liability['date'],
                'required_amount' => $liability['required_amount'],
                'is_paid' => $liability['is_paid'],
                'notes' => $liability['notes'] ?? null,
                'pay_date' => $liability['pay_date'] ?? null,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liabilities = Liability::with(['dates' => function ($query) {
            $query->select('id','liability_id', 'date', 'required_amount', 'is_paid', 'pay_date');
        }, 'user' => function ($query){
            $query->select('id', 'name', 'name_ar');
        }, 'company' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'subCompany' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'product'])->get();
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
        foreach($validated as $key=> $value){
            if(is_null($value) || $value == '' || empty($value) || $value == 'null'){
                unset($validated[$key]);
            }
            if($key == 'remaining_amount' && (!$value || $value == 0)){
                $validated[$key] = 0;
            }
        }
        $storedLiability = Liability::create($validated);
        $this->storeLiabilityDates($validated, $storedLiability->id);

        return response()->json(['msg' => 'liability created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Liability $liability)
    {
        $liability = $liability->with(['dates' => function ($query) {
            $query->select('id','liability_id', 'date', 'required_amount', 'is_paid', 'notes', 'pay_date');
        }, 'user' => function ($query){
            $query->select('id', 'name', 'name_ar', 'avatar');
        }, 'company' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'subCompany' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'product'])->find($liability->id);
        return response()->json($liability);
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
    public function update(LiabilityRequest $request, Liability $liability)
    {
        $validated = $request->all();
        foreach($validated as $key=> $value){
            if(is_null($value) || $value == '' || empty($value) || $value == 'null'){
                unset($validated[$key]);
            }
            if($key == 'remaining_amount' && (!$value || $value == 0)){
                $validated[$key] = 0;
            }
            if($key == 'is_fully_paid' && (!$value || $value == 0)){
                $validated[$key] = 0;
            }
        }
        $liability->update($validated);
        LiabilityDate::where('liability_id', $liability->id)->delete();

        // insert all milestones date
        $this->storeLiabilityDates($validated, $liability->id);

        return response()->json(['msg' => 'liability updated successfully']);
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
