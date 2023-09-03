<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\NationalTypeEnum;

   /**
    * @OA\Info(title="API ADVISOR", version="1.0")
    *
    * @OA\Server(url="http://127.0.0.1:8000")
    * @OA\Server(url="https://advisor-api.barbacode.com")
    */
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
        $this->middleware('guest');
    }
    
    /**
     * @OA\Post(
     *          path="/api/v1/user/register",
     *          summary="API to register users",
     *          description="Send request to create users for login application",
     *          tags={"register user"},
     *          @OA\RequestBody(
     *              required=true,
     *              description="User object fields",
     *              @OA\JsonContent(
     *                  @OA\Property(property="national_id", type="string", maxLength=8, minLength=8),
     *                  @OA\Property(property="national_type", type="string", enum={"dni","pasaporte"}),
     *                  @OA\Property(property="grant_id", type="integer"),
     *                  @OA\Property(property="name", type="string", maxLength=255),
     *                  @OA\Property(property="email", type="string", maxLength=255),
     *                  @OA\Property(property="password", type="string", minLength=8),
     *                  @OA\Property(property="password_confirmation", type="string", minLength=8)
     *              )
     *          ),
     *          @OA\Response(
     *              response=201,
     *              description="User has been created"
     *          ),
     *          @OA\Response(
     *              response=400,
     *              description="Bad request, please check request body"
     *          )
     * )
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);
        //this commented to avoid register user being auto logged in

        return response()->json([
           'status' => Response::HTTP_CREATED,
           'message' => 'User has been registered'
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'national_id' => ['required', 'string', 'size:8','unique:users'],
            'national_type' => ['required',Rule::in(['dni','pasaporte'])],
            'grant_id' => ['required',' numeric'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'national_id' => $data['national_id'],
            'national_type' => $data['national_type'],
            'grant_id' => $data['grant_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
