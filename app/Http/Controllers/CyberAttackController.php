<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CyberAttack;
use App\Models\User;

class CyberAttackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cyberAttacks = DB::table('cyber_attacks')
            ->leftJoin('users', 'cyber_attacks.user_id', '=', 'users.id')
            ->select(
                'cyber_attacks.*',
                'users.name as user_name'
            )
            ->orderBy('cyber_attacks.created_at', 'desc')
            ->get();

        return view('cyber-attacks.index', compact('cyberAttacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('cyber-attacks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'attack_frequency' => 'required|string|max:255',
            'measurement' => 'required|string|max:100',
            'attack_source' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id'
        ]);

        DB::table('cyber_attacks')->insert([
            'attack_frequency' => $request->attack_frequency,
            'measurement' => $request->measurement,
            'attack_source' => $request->attack_source,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('cyber-attacks.index')
            ->with('success', 'Data serangan siber berjaya ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cyberAttack = DB::table('cyber_attacks')
            ->leftJoin('users', 'cyber_attacks.user_id', '=', 'users.id')
            ->select(
                'cyber_attacks.*',
                'users.name as user_name',
                'users.email as user_email'
            )
            ->where('cyber_attacks.id', $id)
            ->first();

        if (!$cyberAttack) {
            return redirect()->route('cyber-attacks.index')
                ->with('error', 'Data serangan siber tidak dijumpai!');
        }

        // Convert to object for easier access in view
        $cyberAttack = (object) $cyberAttack;
        
        // Add user relationship for consistency
        if ($cyberAttack->user_name) {
            $cyberAttack->user = (object) [
                'name' => $cyberAttack->user_name,
                'email' => $cyberAttack->user_email
            ];
        } else {
            $cyberAttack->user = null;
        }
        
        // Add timestamps as Carbon instances
        $cyberAttack->created_at = \Carbon\Carbon::parse($cyberAttack->created_at);
        $cyberAttack->updated_at = \Carbon\Carbon::parse($cyberAttack->updated_at);

        return view('cyber-attacks.show', compact('cyberAttack'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cyberAttack = DB::table('cyber_attacks')->where('id', $id)->first();
        
        if (!$cyberAttack) {
            return redirect()->route('cyber-attacks.index')
                ->with('error', 'Data serangan siber tidak dijumpai!');
        }

        $cyberAttack = (object) $cyberAttack;
        $users = User::orderBy('name')->get();

        return view('cyber-attacks.edit', compact('cyberAttack', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'attack_frequency' => 'required|string|max:255',
            'measurement' => 'required|string|max:100',
            'attack_source' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $updated = DB::table('cyber_attacks')
            ->where('id', $id)
            ->update([
                'attack_frequency' => $request->attack_frequency,
                'measurement' => $request->measurement,
                'attack_source' => $request->attack_source,
                'user_id' => $request->user_id,
                'updated_at' => now()
            ]);

        if (!$updated) {
            return redirect()->route('cyber-attacks.index')
                ->with('error', 'Data serangan siber tidak dijumpai!');
        }

        return redirect()->route('cyber-attacks.index')
            ->with('success', 'Data serangan siber berjaya dikemaskini!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = DB::table('cyber_attacks')->where('id', $id)->delete();

        if (!$deleted) {
            return redirect()->route('cyber-attacks.index')
                ->with('error', 'Data serangan siber tidak dijumpai!');
        }

        return redirect()->route('cyber-attacks.index')
            ->with('success', 'Data serangan siber berjaya dipadam!');
    }
}