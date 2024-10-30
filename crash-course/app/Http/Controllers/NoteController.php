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
        $id = Auth::id();

        $notes = Notes::query()->orderBy('id','desc')->where('user_id',$id)->paginate();
        return view('note.index',['Notes'=>$notes,'message'=>session('success')]) ;
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
        $id = Auth::id();
        $data['user_id'] =  $id; 

        // pre($data);
        Notes::create($data);
   
        return redirect()->route('note.index')->with("message","data successfully inserted") ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $note)
    {
        if ($note->user_id !== Auth::id()) {
           abort(403);
        }
        return view('note.show',['note'=>$note]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notes $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
         }
        return view('note.edit',['note'=>$note]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Notes $note)
    {
        // Use validated data directly
        $note->update($request->validated());
    
        return redirect()->route('note.show',$note)->with('message', 'Note updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $note)
    {

        if ($note->user_id !== Auth::id()) {
            abort(403);
         }
        $notes = Notes::find($note->id);
        if (!$notes) {
            return redirect()->route('note.index')->with('error', 'Note not found.');
        }
    
        $notes->delete();
        return redirect()->route('note.index')->with('message', 'Data successfully deleted: ' . $notes->id);
    }
    
    
}
