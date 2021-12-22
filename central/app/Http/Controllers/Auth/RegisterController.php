<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BdLocation;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function showRegistrationForm()
    {
        $data['district'] = BdLocation::where('type', 2)->get();
        $data['upazila'] = json_encode(BdLocation::where('type',3)->get());
        
        // not admin
        if(auth()->user()->type > 1)
        {
            $data['district'] = BdLocation::where('id', auth()->user()->district)->get();
            $data['upazila'] = json_encode(BdLocation::where('parent_id',auth()->user()->district)->get());
        }

        return view('admin.create', $data);
    }

    public function register(Request $request)
    {

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'email'     => ['email', 'max:255', 'nullable'],
            'district'  => ['required'],
            'type'      => ['required'],
            'password'  => ['required', 'string', 'min:4'],
            'photo'     => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);
        $this->validator($request->all())->validate();

        if ($request->hasFile('photo')) {

            $request->photo->name = $request->user()->type . time() . '.' . $request->photo->extension();
            $request->file('photo')->storeAs(
                'public/images/profile',
                $request->photo->name
            );
        }

        event(new Registered($user = $this->create($request)));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'email'     => ['email', 'max:255', 'nullable'],
            'district'  => ['required'],
            'type'      => ['required'],
            'password'  => ['required', 'string', 'min:8'],
            'photo'     => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ]);
    }

    protected function create(Request $request)
    {
        DB::transaction(function () use ($request) {

            $GLOBALS['user'] = $user = User::create([
                'name'      => $request->name,
                'username'  => $request->username,
                // 'email'     => $data['email'],
                'district'  => $request->district,
                'upazila'   => $request->upazila,
                'type'      => $request->type,
                'password'  => Hash::make($request->password),
            ]);

            Profile::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'bcs_batch' => $request->bcs_batch,
                'joining_date' => date('Y-m-d'),
                'photo'     => $request->photo->name ?? ''
            ]);


        });
        

        if(isset($GLOBALS['user']))
        {
            return  $GLOBALS['user'];
        }
    }
}
