<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Http\RedirectResponse;

class BaseController extends Controller
{
    private $service;
    public function __construct(BaseService $_Service)
    {
       $this->service = $_Service;
    }

    
    /**
    * Display a listing of the resource.
    */
    public function index(): View
    {
        $bases = Base::latest()->paginate(5);

        return view('bases.index',compact('bases'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create(): View
    {
        return view('bases.create');
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        Base::create($request->all());

        return redirect()->route('bases.index')->with('success','Base created successfully.');
    }


    /**
    * Display the specified resource.
    */
    public function show(Base $base): View
    {
        return view('bases.show',compact('base'));
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Base $base): View
    {
        return view('bases.edit',compact('base'));
    }

    /** 
    * Update the specified resource in storage.
    */
    public function update(Request $request, Base $base): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        $base->update($request->all());

        return redirect()->route('bases.index')->with('success','Base updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Base $base): RedirectResponse
    {
        $base->delete();

        return redirect()->route('bases.index')->with('success','Base deleted successfully');
    }
}