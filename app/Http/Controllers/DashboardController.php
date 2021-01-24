<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Get dashboard view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::withoutSelf()->paginate();

        return view('dashboard', [
            'users' => $users,
            'no' => $users->firstItem() - 1
        ]);
    }
}
