<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Http\Request\RegisterRequest;
use App\Models\User;
use App\Models\UserToken;
use App\Repositories\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Util\Json;


class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    /**
     * Authenticate login user.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        return $this->authRepository->login($request);
    }

    /**
     *  Register user.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function register(RegisterRequest $request)
    {
        return $this->authRepository->register($request);
    }


    public function verifyToken(Request $request)
    {
        $token = UserToken::where(['access_token' => $request['token']])->where('expires_at', '>=', Carbon::now()->format('Y-m-d h:i:s'))->first();
        if ($token) {
            return response()->json(['success' => 'true', 'message' => 'Valid token']);
        }
        return response()->json(['success' => 'false', 'message' => 'Invalid token']);

        return redirect()->route('welcome', app()->getLocale());
    }


}
