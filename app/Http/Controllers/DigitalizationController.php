<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Digitalization;
use App\Models\User;

class DigitalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $digitalizations = DB::table('digitalization')
            ->leftJoin('users', 'digitalization.user_id', '=', 'users.id')
            ->select(
                'digitalization.*',
                'users.name as user_name'
            )
            ->orderBy('digitalization.created_at', 'desc')
            ->get();

        return view('digitalizations.index', compact('digitalizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $developmentTypes = Digitalization::getDevelopmentTypes();
        $developmentStatuses = Digitalization::getDevelopmentStatuses();
        
        return view('digitalizations.create', compact('users', 'developmentTypes', 'developmentStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'development_type' => 'required|string|in:' . implode(',', array_keys(Digitalization::getDevelopmentTypes())),
            'development_period' => 'nullable|string|max:255',
            'development_status' => 'required|string|in:' . implode(',', array_keys(Digitalization::getDevelopmentStatuses())),
            'user_id' => 'nullable|exists:users,id'
        ]);

        DB::table('digitalization')->insert([
            'title' => $request->title,
            'year' => $request->year,
            'development_type' => $request->development_type,
            'development_period' => $request->development_period,
            'development_status' => $request->development_status,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('digitalizations.index')
            ->with('success', 'Data digitalisasi berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $digitalization = DB::table('digitalization')
            ->leftJoin('users', 'digitalization.user_id', '=', 'users.id')
            ->select(
                'digitalization.*',
                'users.name as user_name',
                'users.email as user_email'
            )
            ->where('digitalization.id', $id)
            ->first();

        if (!$digitalization) {
            abort(404, 'Data digitalisasi tidak dijumpai.');
        }

        // Add user object for consistency with view
        if ($digitalization->user_id) {
            $digitalization->user = (object) [
                'name' => $digitalization->user_name,
                'email' => $digitalization->user_email
            ];
        }

        return view('digitalizations.show', compact('digitalization'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $digitalization = DB::table('digitalization')->where('id', $id)->first();
        
        if (!$digitalization) {
            abort(404, 'Data digitalisasi tidak dijumpai.');
        }

        $users = User::all();
        $developmentTypes = Digitalization::getDevelopmentTypes();
        $developmentStatuses = Digitalization::getDevelopmentStatuses();
        
        return view('digitalizations.edit', compact('digitalization', 'users', 'developmentTypes', 'developmentStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'development_type' => 'required|string|in:' . implode(',', array_keys(Digitalization::getDevelopmentTypes())),
            'development_period' => 'nullable|string|max:255',
            'development_status' => 'required|string|in:' . implode(',', array_keys(Digitalization::getDevelopmentStatuses())),
            'user_id' => 'nullable|exists:users,id'
        ]);

        $updated = DB::table('digitalization')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'year' => $request->year,
                'development_type' => $request->development_type,
                'development_period' => $request->development_period,
                'development_status' => $request->development_status,
                'user_id' => $request->user_id,
                'updated_at' => now()
            ]);

        if (!$updated) {
            abort(404, 'Data digitalisasi tidak dijumpai.');
        }

        return redirect()->route('digitalizations.index')
            ->with('success', 'Data digitalisasi berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = DB::table('digitalization')->where('id', $id)->delete();
        
        if (!$deleted) {
            abort(404, 'Data digitalisasi tidak dijumpai.');
        }

        return redirect()->route('digitalizations.index')
            ->with('success', 'Data digitalisasi berjaya dipadam.');
    }
}