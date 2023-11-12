<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\Section\StoreRequest;
use App\Models\Section;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\Theme\ThemeResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        $sections = Section::with('parentBranches')->get();

        $sections = SectionWithBranchesResource::collection($sections)->resolve();
        return inertia('Section/Index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create ()
    {
        $this->authorize('create', Section::class);
        return inertia('Section/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreRequest $request)
    {
        $this->authorize('create', Section::class);
        $data = $request->validated();
        $section = Section::create($data);
        return redirect()->route('sections.index');
    }

    public function show (Section $section) {}

    public function edit (Section $section)
    {
        $section = SectionResource::make($section)->resolve();
        return inertia('Section/Edit', compact('section'));
    }

    public function update (UpdateRequest $request, Section $section)
    {
        $data = $request->validated();
        $section->update($data);
        return redirect()->route('sections.index');
    }

    public function destroy (Section $section)
    {
        $this->authorize('delete', Section::class);
        $section->delete();
        return redirect()->back();
    }

    public function branchIndex (Section $section)
    {
        $branches = $section->branches;

        return ThemeResource::collection($branches)->resolve();
    }

    public function branchIndexExcept (Section $section, Branch $branch)
    {
        $branches = $section->branches()->where('id', '!=', $branch->id)->get();

        return ThemeResource::collection($branches)->resolve();
    }

}
