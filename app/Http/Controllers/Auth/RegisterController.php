<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FiscalCondition;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.

     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_condicion_fiscal'=> ['required'],
            'fiscal_name' => ['required', 'string', 'max:100'],
            'fiscal_direction' => ['required', 'string', 'max:50'],
            'CUIT' => ['required', 'string', 'min:11', 'max:11']
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fiscal_name' => $data['fiscal_name'],
            'fiscal_direction' => $data['fiscal_direction'],
            'id_condicion_fiscal' => $data['id_condicion_fiscal'], 
            'CUIT'=> $data['CUIT'],

       
        ]);
    }

    public function showRegistrationForm()
    {
        $fiscal_condition = FiscalCondition::pluck('nombre_categoria', 'id');
        return view('auth.register', compact('fiscal_condition'));
    }
}
