<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class LiabilityController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        dd($request->all());
    }
}
