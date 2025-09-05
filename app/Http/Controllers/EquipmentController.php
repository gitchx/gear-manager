<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'purchased_at' => 'nullable|date',
            'price' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // データ保存
        Equipment::create($validated);

        // インデックスにリダイレクト
        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully.');
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
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->only(['name', 'brand', 'purchased_at', 'price', 'status', 'notes']));

        return redirect()->route('equipment.index')->with('success', '更新しました');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
