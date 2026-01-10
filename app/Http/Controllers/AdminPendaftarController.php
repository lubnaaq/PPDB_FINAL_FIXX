<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminPendaftarController extends Controller
{
    public function index(Request $request)
    {
        // Get all users with role 'user'
        $query = User::where('role', 'user')->with(['biodata.kelas', 'dokumens', 'payments']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
             $search = $request->search;
             $query->where(function($q) use ($search) {
                 $q->where('name', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%");
             });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.pendaftar', compact('users'));
    }
}
