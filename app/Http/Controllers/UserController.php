<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\User;
use App\Model\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all())
                                        ->with('profiles', Profile::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/profile/garoto.png'
        ]);

        alert()->success('Usuário criado com sucesso!', 'Salvo');

        return redirect()->route('user.index');
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        $user->role = 'admin';
        $user->save();
        alert()->info('Permissão alterada com sucesso');
        return redirect()->back();
    }
    public function not_admin($id)
    {
        $user = User::find($id);
        $user->role = 'writer';
        $user->save();
        alert()->info('Permissão alterada com sucesso');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Status mudado com sucesso.']);
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
    public function destroy(User $user)
    {
        if ($user->posts->count() > 0){
        alert()->error('Usuário não pode ser deletada porque ela tem posts.', 'Inative o Usuário');
        return redirect()->back();
    }else{
        $user->profile->delete();
        $user->delete();
        alert()->success('Usuário Deletado!', 'Deletado');
        return redirect()->back();
    }
    }
}
