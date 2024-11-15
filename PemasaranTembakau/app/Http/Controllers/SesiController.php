<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class SesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.email' => 'Format email tidak valid',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'pengunjung') {
                return redirect('/');
            } elseif ($user->role == 'admin') {
                return redirect('/admin');
            }
        }

        return redirect('/login')->withErrors('Email atau password yang dimasukkan salah')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function profile()
    {
        return view('FrontEnd.profile');
    }
    public function show()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        return view('FrontEnd.profile', compact('user'));
    }

    public function reviewstore(Request $request)
    {
        // Validasi input
        $request->validate([
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        try {
            // Simpan data review
            $review = new Review();
            $review->comments = $request->comment;
            $review->star_rating = $request->rating;
            $review->user_id = Auth::id(); // Ambil ID pengguna yang sedang login
            $review->status = 'active'; // Atur status default
            $review->save();

            // Redirect ke halaman testimoni dengan pesan sukses
            return redirect()->back()->with('flash_msg_success', 'Your review has been submitted successfully.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan pesan error
            return redirect()->back()->with('flash_msg_error', 'Failed to submit your review. Please try again.');
        }
    }
    public function showReviews()
    {
        // Ambil hanya 9 review pertama
        $reviews = Review::with('user')->get();
    
        // Hitung total review di database
        $totalReviews = Review::count();
    
        return view('FrontEnd.testimoni', compact('reviews', 'totalReviews'));
    }
    
}