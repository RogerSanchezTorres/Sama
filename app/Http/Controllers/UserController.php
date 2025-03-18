<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Billing;
use Illuminate\Validation\Rule;
use App\Models\UploadedFile;
use App\Models\Invoice;


class UserController extends Controller
{

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $files = UploadedFile::where('user_id', $user->id)->get();
        $invoices = Invoice::where('user_id', $user->id)->get();
        return view('user.dashboard', compact('user', 'files', 'invoices'));
    }

    public function account()
    {
        $user = Auth::user();
        return view('user.cuenta', compact('user'));
    }

    public function updatePersonalDetails(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string',
            'surname' => 'string',
            'email' => 'email',
            'phoneNumber' => 'nullable|string'
        ]);

        $user = Auth::user();
        $user->update(array_filter($validated, function ($value) {
            return $value !== null || $value !== '';
        }));

        return redirect()->route('user-account')->with('success', 'Los datos se han actualizado correctamente.');
    }

    public function updateBillingDetails(Request $request)
    {
        $validated = $request->validate([
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'postalCode' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->billing()->update(array_filter($validated, function ($value) {
            return $value !== null || $value !== '';
        }));

        $billing = $user->billing;

        if (!$billing) {
            $billing = new Billing();
        }

        $billing->address = $validated['address'];
        $billing->city = $validated['city'];
        $billing->province = $validated['province'];
        $billing->postalCode = $validated['postalCode'];
        $billing->country = $validated['country'];

        $user->billing()->save($billing);

        return redirect()->route('user-account')->with('success', 'Los datos se han actualizado correctamente.');
    }

    protected function validateCurrentPassword($attribute, $value, $parameters, $validator)
    {
        return Hash::check($value, Auth::user()->password);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'different:current_password'],
        ], [
            'current_password.current_password' => 'La contraseña anterior no coincide.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('user-account'))->with('success', 'Password updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }

    public function destroy(User $user)
    {
        $user->billing()->delete();

        $user->delete();

        Auth::logout();

        return redirect(route('index'));
    }

    
}
