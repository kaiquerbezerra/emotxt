<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EntryController extends Controller
{
    private $paginate = 20;
    protected $repository;

    public function __construct(Entry $entry)
    {
        $this->repository = $entry;
    }
    public function dashboard()
    {
        $user = Auth::user();
        $entries = $this->repository::where('user_id', $user->id)->get();

        return Inertia::render('Entries/Dashboard', [
            'userId' => $user->id,
            'entries' => $entries
        ]);
    }

    public function create()
    {
        return Inertia::render('Entries/EntryForm');
    }


    public function edit($id)
    {
        $user = Auth::user();
        $entry = $this->repository::where('id', $id)->get();

        return Inertia::render('Entries/EntryForm', [
            'userId' => $user->id,
            'entry' => $entry
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $this->repository::create($data);

        return Redirect::route('entry.create');
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $entry = $this->repository::find($id);
        $entry->update($data);

        return Redirect::route('entry.edit', ['id' => $entry->id]);
    }
    public function destroy($id)
    {
        $entry = $this->repository::findOrFail($id);
        $entry->delete();

        return Redirect::route('entry.edit');
    }
    public function show($id)
    {
        $entry = $this->repository::findOrFail($id);

        return Inertia::render('Entries/ShowEntry', [
            'entry' => $entry
        ]);
    }
}
