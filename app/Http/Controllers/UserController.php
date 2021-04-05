<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index () {
        return view('index');
    }

    public function getFathers () {
        return User::select('id', 'name')->get()->toArray();
    }

    public function create (Request $request) {

        $this->validate($request, [
            'name'   => 'required|string',
            'phone'  => 'required|string|unique:users',
            'estate' => 'required|numeric',
            'city'   => 'required|numeric',
            'father' => 'nullable|numeric'
        ]);

        User::create([
            'name'      => $request['name'],
            'phone'     => $request['phone'],
            'estate_id' => $request['estate'],
            'city_id'   => $request['city'],
            'father_id' => $request['father'],
        ]);

        return true;
    }

    public function getUsers () {

        $users = User::orderBy('created_at', 'desc')->get();

        $u = array();

        foreach($users as $us) {

            array_push($u, [
                'id'      => $us->id,
                'name'    => $us->name,
                'phone'   => $us->phone,
                'local'   => $us->city->name . " / " . $us->estate->initials,
                'created' => $us->created_at->format('d/m/Y H:i'),
                'father'  => $us->father_id != null ? $us->father->name : '-' 
            ]);
        }

        return $u;
    }

    public function delete ($id) {

        $user = User::find($id);

        $user->delete();

        return true;
    }

    public function getRecursive ($id) {

        $user = User::find($id);

        return $user->web();
    }
}
