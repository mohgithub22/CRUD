<?php





namespace App\Http\Middleware;
use illuminate\Http\Request;
class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return [
            'auth.token' => $request->user()?'Bearer'.
            $request->user()->createToken('auth_token')->plainTextToken:null
        ];
    }
}
