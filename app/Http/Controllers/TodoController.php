<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        // Mengambil semua todo yang dimiliki user yang sedang login
        $todos = $user->todo; // Menggunakan relasi 'todo' dari model User

        $title = "Todo";

        return view('todo.todo', [
            'title' => $title,
            'todos' => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'description' => 'required',
        ]);

        // Mengaitkan todo dengan user yang sedang login
        $todo = auth()->user()->todo()->create($request->all());

        return redirect('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);

        // Pastikan todo ditemukan
        if ($todo) {
            // Ubah status menjadi "done"
            $todo->status = 'done';

            // Simpan perubahan
            $todo->save();
        }
        return redirect('todo');

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

    // Pastikan todo ditemukan dan milik user yang sedang login
    if ($todo && $todo->user_id == auth()->id()) {
        // Ubah status menjadi "done"
        $todo->status = 'done';

        // Simpan perubahan
        $todo->save();

        return redirect('todo');
    }

    return redirect('todo')->with('error', 'Todo not found or you do not have permission to edit it.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect('todo');
    }
}
