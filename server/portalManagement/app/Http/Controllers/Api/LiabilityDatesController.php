<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LiabilityDate;
use Illuminate\Http\Request;

class LiabilityDatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = LiabilityDate::with(['liability' => function ($query) {
            $query->select('id', 'user_id', 'company_id', 'sub_company_id', 'product_id', 'is_fully_paid');
        }, 'liability.user' => function ($query){
            $query->select('id', 'name', 'name_ar');
        }, 'liability.company' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'liability.subCompany' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'liability.product'])->select('id', 'liability_id', 'date', 'required_amount', 'is_paid', 'pay_date')->get();
        return response()->json($dates);
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
    public function store(Request $request)
    {
        //
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
