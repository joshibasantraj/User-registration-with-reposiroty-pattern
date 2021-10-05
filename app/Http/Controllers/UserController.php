<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository as RepositoriesUserRepository;
use Illuminate\Http\Request;
use Appp\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user=null;

    public function __construct(RepositoriesUserRepository $user)
    {
        $this->user=$user;
    }
    public function index()
    {
        $users = $this->user->all();
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $data['password'] = Hash::make($data['password']);
        $success = $this->user->store($data);
        if ($success)
        {
            return redirect()->route('user.index');
        }

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
        $user = $this->user->get($id);
        return view('user.form')->with('user', $user);
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
        $user = $this->user->get($id);
        $data = $request->all();
        $user->fill($data);
        $success=$user->save();
        if ($success)
        {
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->get($id);
        $success = $user->delete();
        if($success)
        {
            return redirect()->route('user.index');
        }
    }
}
