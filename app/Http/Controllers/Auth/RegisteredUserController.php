<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $users = $this->search($search);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return Redirect::route('users.index')->with('success', 'New user registered.');
    }

    public function search(?string $search)
    {
        if (!empty($search)) {
            $users = User::query()
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
        } else {
            $users = User::orderBy('updated_at', 'DESC')->paginate(10);
        }
        return $users;
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();
            $msg = ['success' => 'Supplier successfully deleted!'];
        } catch (QueryException $e) {
            $msg = ['error' => 'Failed to delete'];
        }
        return Redirect::route('users.index')->with($msg);
    }
}
