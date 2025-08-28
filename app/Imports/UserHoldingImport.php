<?php

namespace App\Imports;

use App\Models\UserHolding;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UserHoldingImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    private $importedCount = 0;
    private $errorCount = 0;
    private $defaultUserId;

    public function __construct($defaultUserId = null)
    {
        // If no user ID provided, use the first user or create a default one
        $this->defaultUserId = $defaultUserId ?? User::first()?->id ?? $this->createDefaultUser();
    }

    /**
     * Transform a row into a model.
     */
    public function model(array $row)
    {
        try {
            // Map the Excel columns to our database fields
            // Based on the sample: fund_name, fund_code, date, trans_type, tot_inv, nav, cur_val, Unreal_pl_myr, Unreal_pl_percent
            
            $transactionDate = $this->parseDate($row['date'] ?? $row['transaction_date'] ?? null);
            
            if (!$transactionDate) {
                $this->errorCount++;
                Log::warning('Invalid date format in import row', $row);
                return null;
            }

            $userHolding = new UserHolding([
                'user_id' => $this->defaultUserId,
                'fund_name' => $row['fund_name'] ?? '',
                'fund_code' => $row['fund_code'] ?? '',
                'transaction_date' => $transactionDate,
                'transaction_type' => $row['trans_type'] ?? $row['transaction_type'] ?? 'SA',
                'total_investment' => $this->parseNumeric($row['tot_inv'] ?? $row['total_investment'] ?? 0),
                'nav' => $this->parseNumeric($row['nav'] ?? 0),
                'current_value' => $this->parseNumeric($row['cur_val'] ?? $row['current_value'] ?? 0),
                'unrealized_pl_myr' => $this->parseNumeric($row['unreal_pl_myr'] ?? $row['unrealized_pl_myr'] ?? 0),
                'unrealized_pl_percentage' => $this->parseNumeric($row['unreal_pl_percent'] ?? $row['unrealized_pl_percentage'] ?? 0)
            ]);

            $this->importedCount++;
            return $userHolding;
            
        } catch (\Exception $e) {
            $this->errorCount++;
            Log::error('Error importing row: ' . $e->getMessage(), $row);
            return null;
        }
    }

    /**
     * Validation rules for each row.
     */
    public function rules(): array
    {
        return [
            'fund_name' => 'required|string|max:255',
            'fund_code' => 'required|string|max:50',
            'date' => 'required',
            'trans_type' => 'nullable|string|max:10',
            'tot_inv' => 'required|numeric|min:0',
            'nav' => 'required|numeric|min:0',
            'cur_val' => 'required|numeric|min:0',
            'unreal_pl_myr' => 'nullable|numeric',
            'unreal_pl_percent' => 'nullable|numeric'
        ];
    }

    /**
     * Parse date from various formats.
     */
    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Handle Excel date serial numbers
            if (is_numeric($date)) {
                return Carbon::createFromFormat('Y-m-d', gmdate('Y-m-d', ($date - 25569) * 86400));
            }

            // Handle various date formats
            $formats = [
                'd/m/Y',
                'm/d/Y', 
                'Y-m-d',
                'd-m-Y',
                'm-d-Y',
                'd/m/y',
                'm/d/y'
            ];

            foreach ($formats as $format) {
                try {
                    return Carbon::createFromFormat($format, $date);
                } catch (\Exception $e) {
                    continue;
                }
            }

            // Try Carbon's flexible parsing as last resort
            return Carbon::parse($date);
            
        } catch (\Exception $e) {
            Log::warning('Could not parse date: ' . $date);
            return null;
        }
    }

    /**
     * Parse numeric values, removing commas and other formatting.
     */
    private function parseNumeric($value)
    {
        if (empty($value)) {
            return 0;
        }

        // Remove commas, spaces, and other non-numeric characters except decimal point and minus
        $cleaned = preg_replace('/[^0-9.-]/', '', str_replace(',', '', $value));
        
        return is_numeric($cleaned) ? (float) $cleaned : 0;
    }

    /**
     * Create a default user if none exists.
     */
    private function createDefaultUser()
    {
        $user = User::create([
            'name' => 'Import User',
            'email' => 'import@system.local',
            'password' => bcrypt('password')
        ]);

        return $user->id;
    }

    /**
     * Get the count of successfully imported records.
     */
    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    /**
     * Get the count of failed records.
     */
    public function getErrorCount(): int
    {
        return $this->errorCount + count($this->errors()) + count($this->failures());
    }

    /**
     * Handle import errors.
     */
    public function onError(\Throwable $e)
    {
        $this->errorCount++;
        Log::error('Import error: ' . $e->getMessage());
    }

    /**
     * Handle validation failures.
     */
    public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->errorCount++;
            Log::warning('Import validation failure', [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors()
            ]);
        }
    }
}