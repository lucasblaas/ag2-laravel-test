<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Group;
use \App\User;

class GroupController extends Controller
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
        $groups = Group::orderBy('id', 'desc')->get();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('groups.create', compact('users'));
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
            'name' => 'required'
        ]);

        $group = Group::create($request->all());

        if (count($request->users) > 0):

            foreach ($request->users as $user):

                $user = User::find($user);

                $group->users()->save($user);

            endforeach;

        endif;

        return redirect()->route('group.index')->with('message', 'Group created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);

        if (!$group) {
            abort(404);
        }

        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);

        if (!$group) {
            abort(404);
        }

        $users = User::pluck('name', 'id');

        return view('groups.edit', compact('group', 'users'));
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
            'name' => 'required'
        ]);

        $group = Group::find($id);
        $group->update($request->all());

        $group->users()->detach();

        if (count($request->users) > 0):

            foreach ($request->users as $user):

                $user = User::find($user);

                $group->users()->save($user);

            endforeach;

        endif;

        return redirect()->route('group.index')
            ->with('success', 'Group updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Group::find($id)->delete();

        return redirect()->route('group.index')
            ->with('success', 'Group deleted successfully');
    }
}
