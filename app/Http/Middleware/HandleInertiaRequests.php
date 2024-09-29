<?php





namespace App\Http\Middleware;

use Inertia\Middleware\Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(): array
    {
        return [
        ];
    }
}
