<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateStoreRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::all();
        if ($request->has('search')) {
            $states = State::where('name', 'like', "%{$request->search}%")->get();
        }
        return view('states.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('states.create', compact('countries'));
    }

    public function store(StateStoreRequest $request)
    {
        State::create($request->validated());

        return redirect()->route('states.index')->with('message', 'State Creation Succeed');
    }

    public function edit(State $state)
    {
        $countries = Country::all();

        return view('states.edit', compact('state', 'countries'));
    }

    public function update(StateStoreRequest $request, State $state)
    {
        $state->update([
            'country_id' => $request->country_id,
            'name' => $request->name
        ]);

        return redirect()->route('states.index')->with('message', 'State Update Succeed');
    }

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('states.index')->with('message', 'State Delete Succeed');
    }
}
