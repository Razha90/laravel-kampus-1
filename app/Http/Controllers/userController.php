<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class userController extends Controller
{
    public function show(string $id): View
    {
        Log::info('Showing the user profile for user: {id}', ['id' => $id]);
 
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
