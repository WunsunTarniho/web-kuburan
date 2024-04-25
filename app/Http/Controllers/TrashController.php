<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', [
            'title' => 'Data yang dihapus sementara',
            'graves' => Grave::onlyTrashed()->paginate(20),
            'tools' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input('trash_id'));
        $grave = Grave::withTrashed()->find($request->input('trash_id'));

        $existingGrave = Grave::where('blok', $grave->blok)->whereNull('deleted_at')->first();
        // dd($existingGrave);

        if ($existingGrave) {
            return back()->with('fail', 'Gagal memulihkan data. Ada nama blok yang sama.');
        }

        $grave->restore();

        return back()->with('success', 'Data berhasil dipulihkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $grave = Grave::withTrashed()->find($id);
        $grave->forceDelete();

        return back()->with('success', 'Data berhasil dihapus secara permanen!');
    }
}
