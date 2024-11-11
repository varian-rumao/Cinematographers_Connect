<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/[A-Z]/|regex:/[0-9]/',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        Log::info('Starting password reset for user ID: ' . $user->id);

        // Check if the new password matches any of the last three
        if ($this->isRecentPassword($user->id, $request->password)) {
            Log::warning('Password reuse detected for user ID: ' . $user->id);

            // Redirect back with error if password reuse detected
            return redirect()->back()->withErrors([
                'password' => 'Please use a new password other than last three passwords.'
            ])->withInput();
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        Log::info('Password successfully updated for user ID: ' . $user->id);

        // Save the new password to password history
        $this->storePasswordInHistory($user->id, $user->password);

        // Maintain only the last three entries in history
        $this->prunePasswordHistory($user->id);

        Log::info('Password reset completed for user ID: ' . $user->id);

        return redirect()->route('home')->with('Your password has been reset successfully. Please log in.');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Check if the new password is in the user's recent history
    protected function isRecentPassword($userId, $password)
    {
        // Retrieve the last 3 passwords for this user
        $previousPasswords = DB::table('password_data')
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

    // Save new password hash to the history table
    protected function storePasswordInHistory($userId, $hashedPassword)
    {
        Log::info("Attempting to insert password history for user ID: $userId");

        DB::beginTransaction();

        try {
            DB::table('password_data')->insert([
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

    protected function prunePasswordHistory($userId)
    {
        Log::info("Maintaining password history for user ID: $userId");

        $historyCount = DB::table('password_data')
            ->where('user_id', $userId)
            ->count();

        if ($historyCount > 3) {
            DB::table('password_data')
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