<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if ($user->exists) {
            $threads = Thread::latest()->where('user_id', $user->id)->get();
        } else {
            $threads = Thread::latest()->get();
        }


        return view("threads/index", compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("threads/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $thread = Thread::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view("threads/show", compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);

        //if (! auth()->user()->can('update', $thread)) {
        //    return back();
        //}


        return view('threads/edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        //if (! auth()->user()->can('update', $thread)) {
        //    return back();
        //}

        request()->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        
        $thread->update(request()->all());

        return redirect($thread->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        $thread->comments()->delete();
        $thread->delete();

        return redirect('/threads');
    }
}
