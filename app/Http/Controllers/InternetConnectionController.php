<?php

namespace App\Http\Controllers;

use App\Models\InternetConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class InternetConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $connections = DB::table('internet_connections')
            ->leftJoin('users', 'internet_connections.user_id', '=', 'users.id')
            ->select(
                'internet_connections.*',
                'users.name as user_name'
            )
            ->orderBy('internet_connections.created_at', 'desc')
            ->get();

        return view('internet-connections.index', compact('connections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = DB::table('users')->select('id', 'name')->get();
        return view('internet-connections.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'telco' => 'required|string|max:255',
            'connection_speed' => 'required|string|max:255',
            'measurement' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id'
        ]);

        try {
            DB::table('internet_connections')->insert([
                'telco' => $validated['telco'],
                'connection_speed' => $validated['connection_speed'],
                'measurement' => $validated['measurement'],
                'user_id' => $validated['user_id'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('internet-connections.index')
                ->with('success', 'Data sambungan internet berjaya ditambah!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ralat berlaku semasa menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $connection = DB::table('internet_connections')
            ->leftJoin('users', 'internet_connections.user_id', '=', 'users.id')
            ->select(
                'internet_connections.*',
                'users.name as user_name',
                'users.email as user_email'
            )
            ->where('internet_connections.id', $id)
            ->first();

        if (!$connection) {
            abort(404, 'Data sambungan internet tidak dijumpai');
        }

        return view('internet-connections.show', compact('connection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $connection = DB::table('internet_connections')->where('id', $id)->first();
        
        if (!$connection) {
            abort(404, 'Data sambungan internet tidak dijumpai');
        }

        $users = DB::table('users')->select('id', 'name')->get();
        
        return view('internet-connections.edit', compact('connection', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'telco' => 'required|string|max:255',
            'connection_speed' => 'required|string|max:255',
            'measurement' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id'
        ]);

        try {
            $updated = DB::table('internet_connections')
                ->where('id', $id)
                ->update([
                    'telco' => $validated['telco'],
                    'connection_speed' => $validated['connection_speed'],
                    'measurement' => $validated['measurement'],
                    'user_id' => $validated['user_id'] ?? null,
                    'updated_at' => now()
                ]);

            if ($updated) {
                return redirect()->route('internet-connections.index')
                    ->with('success', 'Data sambungan internet berjaya dikemaskini!');
            } else {
                return redirect()->back()
                    ->with('error', 'Tiada perubahan dibuat atau data tidak dijumpai.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ralat berlaku semasa mengemaskini data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $deleted = DB::table('internet_connections')->where('id', $id)->delete();
            
            if ($deleted) {
                return redirect()->route('internet-connections.index')
                    ->with('success', 'Data sambungan internet berjaya dipadam!');
            } else {
                return redirect()->back()
                    ->with('error', 'Data tidak dijumpai atau sudah dipadam.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa memadam data: ' . $e->getMessage());
        }
    }
}