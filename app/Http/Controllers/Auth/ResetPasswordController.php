<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function reset(Request $request)
    {
        // Validate request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',   
                'regex:/[0-9]/',   
            ],
        ]);

        // Retrieve user by email
        $user = User::where('email', $request->email)->firstOrFail();

        Log::info('Starting password reset for user ID: ' . $user->id);

        // Check if the new password matches any of the last three
        if ($this->isPasswordInHistory($user->id, $request->password)) {
            Log::warning('Password reuse detected for user ID: ' . $user->id);

            // Redirect back with error if password reuse detected
            return redirect()->back()->withErrors([
                'password' => 'Please use a new password that is not among your last three passwords.'
            ])->withInput();
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        Log::info('Password successfully updated for user ID: ' . $user->id);

        // Save the new password to password history
        $this->addPasswordToHistory($user->id, $user->password);

        // Maintain only the last three entries in history
        $this->maintainPasswordHistory($user->id);

        Log::info('Password reset completed for user ID: ' . $user->id);

        return redirect()->route('login')->with('status', 'Your password has been reset successfully. Please log in.');
    }


    protected function messages()
    {
        return [
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must contain at least one uppercase letter and one number.',
        ];
    }


    protected function isPasswordInHistory($userId, $password)
    {
        $previousPasswords = DB::table('password_histories')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->pluck('password_hash');

        foreach ($previousPasswords as $oldPassword) {
            if (Hash::check($password, $oldPassword)) {
                return true;
            }
        }

        return false;
    }


    protected function addPasswordToHistory($userId, $hashedPassword)
    {
        Log::info("Attempting to insert password history for user ID: $userId");

        DB::beginTransaction();

        try {
            DB::table('password_histories')->insert([
                'user_id' => $userId,
                'password_hash' => $hashedPassword,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            Log::info("Password history committed for user ID: $userId");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to commit password history for user ID: $userId. Error: " . $e->getMessage());
        }
    }


    protected function maintainPasswordHistory($userId)
    {
        Log::info("Maintaining password history for user ID: $userId");

        $historyCount = DB::table('password_histories')
            ->where('user_id', $userId)
            ->count();

        if ($historyCount > 3) {
            DB::table('password_histories')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'asc')
                ->limit($historyCount - 3)    
                ->delete();
            
            Log::info("Older password history entries deleted, keeping the latest three for user ID: $userId");
        } else {
            Log::info("No password history entries deleted as the count is $historyCount for user ID: $userId");
        }
    }
}