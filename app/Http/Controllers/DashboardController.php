<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {   

        $pageTitle = '<script>alert("User List Dashboard");</script>';

            $senaraiUsers = [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'role' => 'Staff'],
                ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane.doe@example.com', 'role' => 'Admin'],
                ['id' => 3, 'name' => 'Bob Smith', 'email' => 'bob.smith@example.com', 'role' => 'Staff'],
            ];

            // Cara 1 attach data kepada template menggunakan kaedah with()
            // return view('template-dashboard')->with('senaraiUsers', $senaraiUsers)->with('pageTitle', $pageTitle);

            // Cara 2 attach data kepada template menggunakan kaedah array()
            // return view('template-dashboard', ['senaraiUsers' => $senaraiUsers, 'pageTitle' => $pageTitle]);

            // Cara 3 attach data kepada template menggunakan kaedah compact()
            return view('template-dashboard', compact('senaraiUsers', 'pageTitle'));

    }
}
