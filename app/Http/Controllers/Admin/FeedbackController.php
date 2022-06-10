<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $feedback = Feedback::get();
            return DataTables::of($feedback)
            ->addIndexColumn()
            ->addColumn('action', function ($q){
                return $this->getActionColumn($q);
            })
            ->make(true);
        }

        return view('landing.feedbacks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.feedbacks.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required',
            'feedback' => 'required',
            'star_count' => 'integer|max:5|min:1'
        ]);

        Feedback::create(array_merge($request->all(), [
            'avatar' => $request->hasFile('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : '',
        ]));

        return redirect()->route('feedback.index')->with('status', 'Feedback was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('landing.feedbacks.create-edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $this->validate($request, [
            'avatar' => 'sometimes|mimes:jpg,jpeg,png',
            'name' => 'required',
            'feedback' => 'required',
            'star_count' => 'integer|max:5|min:1'
        ]);

        $feedback->update(array_merge($request->all(), [
            'avatar' => $request->hasFile('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : '',
        ]));

        return redirect()->route('feedback.index')->with('status', 'Feedback was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $validation = Feedback::count();
        if($validation == 2){
            return redirect()->route('feedback.index')->with('error', 'Harus menyisakan 2 feedback');
        }

        $feedback->delete();

        return redirect()->route('feedback.index')->with('status', 'Feedback Deleted');
    }

    public function getActionColumn($data)
    {
        $editBtn = route('feedback.edit', $data->id);
        $deleteBtn = route('feedback.destroy', $data->id);
        $ident = substr(md5(now()), 0, 10);
        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
    }
}
