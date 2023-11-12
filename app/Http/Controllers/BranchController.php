<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Branch\ThemeResource;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Section\SectionResource;
use App\Models\Branch;
use App\Models\Section;
use App\Http\Resources\Branch\BranchWithChildrenResource;

class BranchController extends Controller
{

    public function index ()
    {
        //
    }

    public function create ()
    {
        $sections = Section::all();
        $sections = SectionResource::collection($sections)->resolve();
        return inertia()->render('Branch/Create', compact(['sections']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreRequest $request)
    {
        $data = $request->validated();
        $branch = Branch::firstOrCreate($data);
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show (Branch $branch)
    {
        $branch = BranchWithChildrenResource::make($branch)->resolve();
        return inertia('Branch/Show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Branch $branch)
    {
        $sections = Section::all();
        $sections = SectionResource::collection($sections)->resolve();

        $branch = BranchResource::make($branch)->resolve();
        return inertia('Branch/Edit', compact('branch', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (UpdateRequest $request, Branch $branch)
    {
        $this->authorize('update', $branch);
        $data = $request->validated();
        $branch->update($data);
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Branch $branch)
    {
        $this->authorize('delete', $branch);
        $branch->delete();
        return redirect()->route('sections.index');
    }

    public function themeCreate (Branch $branch)
    {
        return inertia('Theme/Create', compact('branch'));
    }

}
