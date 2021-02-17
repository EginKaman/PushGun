<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class iOSRegister extends Controller
{
    public function pushPackages(Request $request)
    {
        return Storage::download('/public/pushPackage.zip');
        
    }
    public function registrations(Request $request) {
        return response(200);
    }
    public function delete(Request $request) {
        return response(200);

    }
    public function log (Request $request) {
        return response(200);
    }
}
