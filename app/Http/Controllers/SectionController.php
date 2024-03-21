<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
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
    public function store(StoreSectionRequest $request)
    {
        $validated = $request->validated();

        Section::create([
            'section_name' => $validated['section_name'],
            'discreption' => $request->descreption,
            'created_by' => Auth::user()->name,
        ]);
        return redirect()->back()->with(['Add', 'تم اضافة القسم بنجاح ']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSectionRequest $request)
    {
        Section::where('id', $request->id)->update([
            'section_name' => $request->section_name,
            'discreption' => $request->description,
        ]);
        return redirect()->back()->with(['Edit' => 'تم تعديل القسم بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::destroy($request->id);
        return redirect()->back()->with(['Delete' => 'تم حذف القسم بنجاح']);
    }
}