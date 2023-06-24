<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredCompanyController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Company/CompanyRegister');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|unique:companies',
            'name' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:companies',
            'password' => 'required|min:6',
        ]);

        $company = Company::create([
            'cnpj' => $request->cnpj,
            'name' => $request->name,
            'country' => $request->country,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($company));

        Company::login($company);

        return redirect(RouteServiceProvider::HOME);
    }
}
