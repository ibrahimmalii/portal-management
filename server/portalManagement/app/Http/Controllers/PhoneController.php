<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class PhoneController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if(($value && $key == 'phone1') || ($value && $key == 'phone2') || ($value && $key == 'phone3')) {
                Phone::create([
                    'user_id' => $request->user_id,
                    'phone' => $value,
                ]);
            }
        }

        return redirect()->route('voyager.phones.index');
    }
}
