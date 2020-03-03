<?php

namespace Sivanov\LaravelGuardPass\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Display the Guard Pass page
     * 
     * @return View
     */
    public function index(Request $request, Array $columns)
    {
        $columns_ = \Schema::getColumnListing('users');

        return view('guardpass::index', compact('columns', 'columns_'));
    }

    /**
     * Get table contents
     * 
     * @return JSON 
     */
    public function show(Array $columns)
    {
        return [
            'columns' => $columns,
            'data' => User::select($columns)->orderBy('id', 'asc')->get()->makeVisible($columns)
        ];
    }

    /**
     * Assume User Identity
     */
    public function assumeIdentity(User $user)
    {
        Auth::login($user, true);
        return redirect('/');
    }
}
