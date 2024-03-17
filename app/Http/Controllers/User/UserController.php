<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $roles;

    public function __construct()
    {
        $this->roles = Role::all();
    }

    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create')->with('roles', $this->roles);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->assignRole($request->role_id);
        $user->addMedia($request->avatar)->toMediaCollection('user_avatar');
        return $this->redirectUser('Thêm người dùng ' . $user->name . ' thành công');
    }

    public function edit(User $user)
    {
        return view('backend.users.edit', compact('user'))
            ->with('roles', $this->roles);
    }

    public function update(Request $request, User $user)
    {
        $user->syncRoles([$request->role_id]);
        return $this->redirectUser('Cập nhật người dùng ' . $user->name . ' thành công');
    }

    public function destroy(User $user)
    {
        $user->delete();
        if ($user->getMedia('avatar')->isNotEmpty()) {
            $user->getMedia('avatar')[0]->delete();
        }
        return $this->redirectUser('Xóa người dùng ' . $user->name . ' thành công');
    }

    protected function redirectUser(string $message)
    {
        return redirect()
            ->route('backend.user.index')
            ->with('success', $message);
    }
}
