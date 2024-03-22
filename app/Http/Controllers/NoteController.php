<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function list()
    {
        $data['allNotes']=Note::where('user_id', auth()->id())->get();
        return view('note.list', $data);
    }

    public function add()
    {
        return view('note.add');
    }

    public function store(NoteRequest $request){

        $id = $request->get('id', '');
        if ($id != '') {
            $note = Note::find($id);
        }else {
            $note = new Note();
        }

        DB::beginTransaction();

        try {
            $note->user_id = auth()->id();
            $note->title = $request->title;
            $note->description = $request->description;
            $note->save();

            DB::commit();

            $message = $request->id ? 'Updated successfully' : 'Note created successfully';
            return redirect()->route('note.list')->with('SUCCESS_MESSAGE', $message);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $data['note']=Note::find(decrypt($id));
        return view('note.edit', $data);
    }

    public function view($id)
    {
        $data['note']=Note::find(decrypt($id));
        return view('note.view', $data);
    }

    public function delete($id)
    {
        try {
            $note = Note::find(decrypt($id));
            $note->delete();

            DB::commit();
            return redirect()->route('note.list')->with('SUCCESS_MESSAGE', 'Deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('ERROR_MESSAGE', 'Something went wrong!');
        }
    }

    public function search(Request $request)
    {
        $searchItem = $request->input('search');

        $data['allNotes'] = Note::where('title', 'LIKE', "%{$searchItem}%")
                     ->orWhere('description', 'LIKE', "%{$searchItem}%")
                     ->get();

        return view('welcome', $data);
    }

}

