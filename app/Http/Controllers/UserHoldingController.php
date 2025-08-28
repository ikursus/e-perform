<?php

namespace App\Http\Controllers;

use App\Models\UserHolding;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserHoldingImport;
use Illuminate\Support\Facades\Validator;

class UserHoldingController extends Controller
{
    /**
     * Display a listing of the user holdings.
     */
    public function index(Request $request)
    {
        $query = UserHolding::with('user');

        // Filter by fund code
        if ($request->filled('fund_code')) {
            $query->byFundCode($request->fund_code);
        }

        // Filter by transaction type
        if ($request->filled('transaction_type')) {
            $query->byTransactionType($request->transaction_type);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->byDateRange($request->start_date, $request->end_date);
        }

        // Search by fund name or user name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('fund_name', 'like', "%{$search}%")
                  ->orWhere('fund_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $holdings = $query->orderBy('transaction_date', 'desc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);

        $fundCodes = UserHolding::distinct()->pluck('fund_code')->sort();
        $transactionTypes = UserHolding::getTransactionTypes();
        $users = User::orderBy('name')->get();

        return view('investor-holdings.index', compact('holdings', 'fundCodes', 'transactionTypes', 'users'));
    }

    /**
     * Show the form for creating a new user holding.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $transactionTypes = UserHolding::getTransactionTypes();
        
        return view('investor-holdings.create', compact('users', 'transactionTypes'));
    }

    /**
     * Store a newly created user holding in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'fund_name' => 'required|string|max:255',
            'fund_code' => 'required|string|max:50',
            'transaction_date' => 'required|date',
            'transaction_type' => 'required|string|max:10',
            'total_investment' => 'required|numeric|min:0',
            'nav' => 'required|numeric|min:0',
            'current_value' => 'required|numeric|min:0',
            'unrealized_pl_myr' => 'required|numeric',
            'unrealized_pl_percentage' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            UserHolding::create($request->all());
            
            return redirect()->route('investor-holdings.index')
                           ->with('success', 'Data investor holding berjaya ditambah.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Ralat berlaku semasa menyimpan data: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified user holding.
     */
    public function show(UserHolding $investor_holding)
    {
        $investor_holding->load('user');
        return view('investor-holdings.show', compact('investor_holding'));
    }

    /**
     * Show the form for editing the specified user holding.
     */
    public function edit(UserHolding $investor_holding)
    {
        $users = User::orderBy('name')->get();
        $transactionTypes = UserHolding::getTransactionTypes();
        
        return view('investor-holdings.edit', compact('investor_holding', 'users', 'transactionTypes'));
    }

    /**
     * Update the specified user holding in storage.
     */
    public function update(Request $request, UserHolding $investor_holding)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'fund_name' => 'required|string|max:255',
            'fund_code' => 'required|string|max:50',
            'transaction_date' => 'required|date',
            'transaction_type' => 'required|string|max:10',
            'total_investment' => 'required|numeric|min:0',
            'nav' => 'required|numeric|min:0',
            'current_value' => 'required|numeric|min:0',
            'unrealized_pl_myr' => 'required|numeric',
            'unrealized_pl_percentage' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            $investor_holding->update($request->all());
            
            return redirect()->route('investor-holdings.index')
                           ->with('success', 'Data investor holding berjaya dikemaskini.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Ralat berlaku semasa mengemaskini data: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Remove the specified user holding from storage.
     */
    public function destroy(UserHolding $investor_holding)
    {
        try {
            $investor_holding->delete();
            
            return redirect()->route('investor-holdings.index')
                           ->with('success', 'Data investor holding berjaya dipadam.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Ralat berlaku semasa memadam data: ' . $e->getMessage());
        }
    }

    /**
     * Show the import form.
     */
    public function importForm()
    {
        return view('investor-holdings.import');
    }

    /**
     * Import user holdings from Excel/CSV file.
     */
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240' // Max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->with('error', 'Fail yang dimuat naik tidak sah.');
        }

        try {
            DB::beginTransaction();
            
            $import = new UserHoldingImport();
            Excel::import($import, $request->file('file'));
            
            DB::commit();
            
            $importedCount = $import->getImportedCount();
            $errorCount = $import->getErrorCount();
            
            $message = "Import selesai. {$importedCount} rekod berjaya diimport.";
            if ($errorCount > 0) {
                $message .= " {$errorCount} rekod gagal diimport.";
            }
            
            return redirect()->route('investor-holdings.index')
                           ->with('success', $message);
                           
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                           ->with('error', 'Ralat berlaku semasa import: ' . $e->getMessage());
        }
    }

    /**
     * Download sample template for import.
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="template_investor_holdings.xlsx"',
        ];

        // Create sample data for template
        $sampleData = [
            [
                'fund_name' => 'PBSN All - Weather Private Mandate (PAWPM01) - Mixed Asset Global',
                'fund_code' => 'PM1',
                'date' => '31/1/2025',
                'trans_type' => 'SA',
                'tot_inv' => '500000',
                'nav' => '1.1',
                'cur_val' => '550000',
                'Unreal_pl_myr' => '50000',
                'Unreal_pl_percent' => '10.00'
            ]
        ];

        return Excel::download(new \App\Exports\UserHoldingTemplateExport($sampleData), 'template_investor_holdings.xlsx', \Maatwebsite\Excel\Excel::XLSX, $headers);
    }
}