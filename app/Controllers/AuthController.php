<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Flash;
use App\Models\User;

class AuthController
{
    public function showLogin(): void
    {
        if (\App\Helpers\Auth::check()) {
            View::redirect(\App\Helpers\Auth::isAdmin() ? '/admin' : '/dashboard');
        }
        View::render('auth/login', ['hideSidebar' => true]);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            Flash::set('Email atau password salah.', 'danger');
            View::redirect('/login');
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        View::redirect('/dashboard');
    }

    public function showRegister(): void
    {
        if (\App\Helpers\Auth::check()) {
            View::redirect(\App\Helpers\Auth::isAdmin() ? '/admin' : '/dashboard');
        }
        View::render('auth/register', ['hideSidebar' => true]);
    }

    public function register(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            Flash::set('Semua field wajib diisi.', 'warning');
            View::redirect('/register');
        }

        if (User::findByEmail($email)) {
            Flash::set('Email sudah terdaftar.', 'warning');
            View::redirect('/register');
        }

        User::create($name, $email, $password);
        Flash::set('Registrasi berhasil. Silakan login.', 'success');
        View::redirect('/login');
    }

    public function logout(): void
    {
        session_destroy();
        View::redirect('/login');
    }
}
