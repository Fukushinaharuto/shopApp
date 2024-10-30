<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\UserStock; // ここを追加
use Illuminate\Support\Facades\DB; // DBクラスもインポート

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // セッションのカートアイテムをデータベースに移動
        $user_id = Auth::id();
        $cart = session()->get('cart', []);
    
        foreach ($cart as $item) {
            UserStock::updateOrCreate(
                ['user_id' => $user_id, 'stock_id' => $item['stock_id']],
                ['quantity' => DB::raw("quantity + {$item['quantity']}")]
            );
        }
    
        // セッションカートをクリア
        session()->forget('cart');
    
        return redirect()->intended(route('stock.index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('stock.index'));
    }
}
