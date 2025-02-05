<?

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Use authenticated method to redirect after login
            return $this->authenticated($request, Auth::user());
        }

        // If authentication fails, redirect back with error message
        return back()->with('error', 'Invalid email or password.');
    }

    // Handle post-login redirection
    protected function authenticated(Request $request, $user)
    {
        // Check user role and redirect to the appropriate dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');  // Redirect to admin dashboard
        }

        // Redirect to user dashboard for regular users
        return redirect()->route('user.dashboard');
    }

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
