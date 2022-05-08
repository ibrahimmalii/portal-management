<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getAvaliableUsersInCompany(Request $request)
    {
        $users = User::where('company_id', $request->company_id)->get();
        return response()->json($users);
    }
}
