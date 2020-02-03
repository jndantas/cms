<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Model\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
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
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {

        $user = Auth::user();
        if($request->hasFile('avatar')){
            $avatar = $request->avatar;
            $avatar_new_name = time() . $avatar->getClientOriginalName();
            $avatar->move('uploads/avatars', $avatar_new_name);
            if ($user->profile->avatar !== 'uploads/avatars/1.png'){
                File::delete($user->profile->avatar);
            }
            $user->profile->avatar = 'uploads/avatars/' . $avatar_new_name;

            $user->profile->save();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->twitter = $request->twitter;
        $user->profile->instagram = $request->instagram;
        $user->profile->about = $request->about;

        $user->save();
        $user->profile->save();

        if($request->has('password'))

        {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        alert()->success('Perfil atualizado!', 'Optional Title');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
