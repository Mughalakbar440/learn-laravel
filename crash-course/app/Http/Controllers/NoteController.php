<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\updateNoteRequest;
use App\Models\Notes;
use Auth;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        $notes = Notes::query()->orderBy('id','desc')->paginate();
        return view('note.index',['Notes'=>$notes,'success'=>session('success')]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('note.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = 2; 

        // pre($data);
        Notes::create($data);
   
        return redirect()->route('note.index')->with("success","data successfully inserted") ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Notes::find($id);
        return view('note.show',['note'=>$note]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = Notes::find($id);

        return view('note.edit',['note'=>$note]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Notes $note)
    {
        // Use validated data directly
        $note->update($request->validated());
    
        return redirect()->route('note.index')->with('success', 'Note updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notes = Notes::find($id);
        if (!$notes) {
            return redirect()->route('note.index')->with('error', 'Note not found.');
        }
    
        $notes->delete();
        return redirect()->route('note.index')->with('success', 'Data successfully deleted: ' . $notes->id);
    }
    
    
}
