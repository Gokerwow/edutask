<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            Log::info('Memulai callback Google...');
            $googleUser = Socialite::driver('google')->user();
            Log::info('Data Google User diterima:', (array) $googleUser);

            $user = User::where('email', $googleUser->getEmail())->first();
            Log::info('User dari database (sebelum create/update):', $user ? $user->toArray() : ['User tidak ditemukan']);

            if (!$user) {
                Log::info('User tidak ditemukan, membuat user baru...');
                $userData = [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)) // Berikan password acak
                ];
                Log::info('Data untuk user baru:', $userData);
                $user = User::create($userData);
                Log::info('User baru berhasil dibuat:', $user->toArray());
            } else {
                $avatarUrlFromGoogle = $googleUser->getAvatar();
                Log::info('URL Avatar ASLI dari Google untuk user yang sudah ada (sebelum update): ' . $avatarUrlFromGoogle);
                $user->avatar = $avatarUrlFromGoogle; // Pastikan ini mengambil URL yang benar
                $user->name = $googleUser->getName(); // Update nama juga jika perlu
                $user->save(); // Jangan lupa save!
                Log::info('Data user (yang sudah ada) berhasil diupdate:', $user->toArray());
            }

            Log::info('Mencoba melakukan Auth::login untuk user ID: ' . $user->id);
            Auth::login($user);

            if (Auth::check()) {
                Log::info('Auth::login berhasil. User ID: ' . Auth::id() . '. Redirecting ke /');
                return redirect('/');
            } else {
                Log::error('Auth::login GAGAL setelah mencoba login user ID: ' . $user->id);
                return redirect('/login')->with('error', 'Gagal melakukan autentikasi setelah mendapatkan data user.');
            }
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Google OAuth InvalidStateException: ' . $e->getMessage() . ' Stack: ' . $e->getTraceAsString());
            return redirect('/login')->with('error', 'Sesi tidak valid atau telah kedaluwarsa. Silakan coba lagi.');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Google OAuth GuzzleHttp ClientException: ' . $e->getResponse()->getBody()->getContents() . ' Stack: ' . $e->getTraceAsString());
            return redirect('/login')->with('error', 'Terjadi masalah saat berkomunikasi dengan Google. Silakan coba lagi.');
        } catch (\Exception $e) {
            Log::error('Google OAuth Error Umum: ' . $e->getMessage() . ' Stack: ' . $e->getTraceAsString());
            return redirect('/login')->with('error', 'Gagal login dengan Google. Silakan coba lagi nanti.');
        }
    }
}
