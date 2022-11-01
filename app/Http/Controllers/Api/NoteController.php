<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PbeBaseController;
use App\Model\Note;
use Illuminate\Http\Request;

class NoteController extends PbeBaseController
{
    public function index()
    {
        return response()->json(Note::getAllByUserId($this->getUserId()));
    }
    public function store()
    {
        $title = request('title');
        $note = request('note');
        
        $noteInsert =[
            'n_title' => $title,
            'n_note' => $note,
            'n_us_id' => $this->getUserId()
        ];
        $noteId = Note::insert($noteInsert);
        $newNote = Note::getByIdAndUserId($noteId, $this->getUserId());
        return response()->json($newNote, 201);

    }
    public function getById($noteId)
    {
       $note = Note::getByIdAndUserId($noteId, $this->getUserId());
       if ($note == null) {
        throw new NotFoundException();
        exit;
       }
       return response()->json($note);
    }
   public function update(Request $request,$noteId)
   {
        $request->validate([
            'no_title' => 'required',
            'n_note' => 'required',
            'n_us_id'=> $this->getUserId()
        ]);

        $noteId->update([
            'no_title' => $request->no_title,
            'n_note' => $request->n_note
        ]);
        $newNote = Note::getAllByUserId($noteId, $this->getUserId());
        return response()->json($newNote, 201);

   }
    public function delete($noteId)
    {
        
    }
}       
    