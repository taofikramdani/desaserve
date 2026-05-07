<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Auth;
use App\Helpers\Flash;
use App\Models\Complaint;
use App\Models\ServiceRequest;
use App\Models\User;

class AdminController
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            View::redirect(Auth::isAdmin() ? '/admin' : '/dashboard');
        }
        View::render('admin/login');
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);
        if (!$user || $user['role'] !== 'admin' || !password_verify($password, $user['password_hash'])) {
            Flash::set('Login admin gagal.', 'danger');
            View::redirect('/admin/login');
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        View::redirect('/admin');
    }

    public function dashboard(): void
    {
        Auth::requireAdmin();
        $requests = ServiceRequest::listAll();
        $complaints = Complaint::listAll();

        View::render('admin/dashboard', [
            'requests' => $requests,
            'complaints' => $complaints,
        ]);
    }

    public function updateRequestStatus(): void
    {
        Auth::requireAdmin();
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'Pending';

        ServiceRequest::updateStatus($id, $status);
        Flash::set('Status pengajuan diperbarui.', 'success');
        View::redirect('/admin');
    }

    public function updateComplaintStatus(): void
    {
        Auth::requireAdmin();
        $id = (int) ($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'Pending';

        Complaint::updateStatus($id, $status);
        Flash::set('Status pengaduan diperbarui.', 'success');
        View::redirect('/admin');
    }
}
