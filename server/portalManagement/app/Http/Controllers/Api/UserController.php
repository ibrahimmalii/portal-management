<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\UpdateUserRequest;
use App\Http\Requests\Api\Users\UserRequest;
use App\Models\Phone;
use App\Models\User;
use App\Models\UserAttachment;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Store Attachments for User
     */
    public function storeAttachments($attachment, int $id){
        $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = $attachment->storeAs('employees', $fileName, 'public');
            UserAttachment::create([
                'user_id' => $id,
                'attachment_type' => $attachment->getClientMimeType(),
                'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                'attachment_path' => '/' . $filePath
            ]);
    }

    /**
     * Store User Phones
     */
    public function storePhone(int $id, string $phone){
        Phone::create([
            'user_id' => $id,
            'phone' => $phone,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::where('role_id', 2)->orWhere('role_id', 3)->get());
    }

    /**
     * Get Drop Down Of Users
     *
     * @return void
     */
    public function getSupervisorsDropDown(){
        return response()->json(User::select('id', 'name', 'name_ar')->where('role_id', 2)->orWhere('role_id', 3)->get());
    }


    public function getEmployeesDropdown()
    {
        return response()->json(User::select('id', 'name', 'name_ar')->where('role_id', 2)->orWhere('role_id', 3)->get());
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
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        foreach($validated as $key=> $prop){
            if(is_null($validated[$key]) || empty($validated[$key]) || $validated[$key] == ''){
                unset($validated[$key]);
            }
        }

        $user = User::create($validated);

        foreach ($validated['attachments'] as $key => $attachment){
            $this->storeAttachments($attachment, $user->id);
        }

        $this->storePhone($user->id, $validated['phone1']);

        if(!empty($validated['phone2'])){
            $this->storePhone($user->id, $validated['phone2']);
        }

        if(!empty($validated['phone3'])){
            $this->storePhone($user->id, $validated['phone3']);
        }
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $users = User::with(['company' => function ($query) {
            $query->select('id', 'name', 'name_ar');
        }, 'sub_company' => function ($query) {
            $query->select('id',  'name', 'name_ar');
        }, 'attachments' => function ($query){
            $query->select('id', 'user_id', 'attachment_name', 'attachment_path');
        }, 'phones'])->where('id', $user->id)->first();
        if($users->supervisor != null){
            $users->supervisor = User::select('id', 'name', 'name_ar')->where('id', $users->supervisor)->first();
        }

        return response()->json($users);
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
    public function update(UpdateUserRequest $request,User $user)
    {
        $validated = $request->validated();
        foreach($validated as $key=> $prop){
            if(is_null($validated[$key]) || $validated[$key] == ''){
                $user->update([$key => null]);
                unset($validated[$key]);
            }
        }

        $user->update($validated);
        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $key => $attachment){
                $this->storeAttachments($attachment, $user->id);
            }
        }

        Phone::where('user_id', $user->id)->delete();

        $this->storePhone($user->id, $validated['phone1']);

        if(!empty($validated['phone2'])){
            $this->storePhone($user->id, $validated['phone2']);
        }

        if(!empty($validated['phone3'])){
            $this->storePhone($user->id, $validated['phone3']);
        }
        return response()->json(['message' => 'User Updated Successfully'], 200);
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
