<?php

namespace App\Http\Controllers;

use App\Models\Jen;
use App\Http\Requests\JenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JenController extends Controller
{
    public function index(): View|JsonResponse
    {
        $jens = Jen::all();
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['data' => $jens]);
        }
        return view('jens.index', compact('jens'));
    }

    public function create(): View
    {
        return view('jens.create');
    }

    public function store(JenRequest $request): RedirectResponse
    {
        Jen::create($request->validated());
        return redirect()->route('jens.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function show(Jen $jen): View
    {
        return view('jens.show', compact('jen'));
    }

    public function edit(Jen $jen): View
    {
        return view('jens.edit', compact('jen'));
    }

    public function update(JenRequest $request, Jen $jen): RedirectResponse
    {
        $jen->update($request->validated());
        return redirect()->route('jens.index')->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy(Jen $jen): RedirectResponse
    {
        $jen->delete();
        return redirect()->route('jens.index')->with('success', 'Jenis berhasil dihapus.');
    }
}
