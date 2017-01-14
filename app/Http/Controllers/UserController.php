<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Group;
use \App\User;
use \App\Company;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        return view('users.create', compact('groups', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $active = (is_numeric($request->input('active'))) ? 1 : 0;

        $company_id = (is_numeric($request->input('company_id'))) ? $request->input('company_id') : NULL;

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'active' => $active,
            'company_id' => $company_id
        ]);

        if (count($request->groups) > 0):
            foreach ($request->groups as $group):

                $group = Group::find($group);

                $user->groups()->save($group);

            endforeach;

        endif;

        return redirect()->route('user.index')->with('message', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $groups = Group::pluck('name', 'id');

        $companies = Company::pluck('name', 'id');

        return view('users.edit', compact('user', 'groups', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        $active = (is_numeric($request->input('active'))) ? 1 : 0;

        $company_id = (is_numeric($request->input('company_id'))) ? $request->input('company_id') : NULL;

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $user->email;
        $user->password = bcrypt($request->input('password'));
        $user->company_id = $company_id;
        $user->active = $active;

        $user->save();

        $user->groups()->detach();

        foreach ($request->groups as $group):

            $group = Group::find($group);

            $user->groups()->save($group);

        endforeach;

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
