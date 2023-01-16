<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    //index
    public function index()
    {
        return view('admin.user.index');
    }
    // destroy
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
    // export
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    // rset
    public function reset()
    {
        // delete all user has participant
        User::has('participant')->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}
