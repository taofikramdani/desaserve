<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Auth;
use App\Helpers\Flash;
use App\Models\Complaint;
use App\Services\S3Uploader;
use RuntimeException;

class ComplaintController
{
    public function showForm(): void
    {
        Auth::requireLogin();
        View::render('user/complaint_new');
    }

    public function submit(): void
    {
        Auth::requireLogin();

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($title === '') {
            Flash::set('Judul pengaduan wajib diisi.', 'warning');
            View::redirect('/complaints/new');
        }

        $photoUrl = null;
        if (!empty($_FILES['photo']['name'])) {
            try {
                $uploader = new S3Uploader();
                $photoUrl = $uploader->upload(
                    $_FILES['photo']['tmp_name'],
                    $_FILES['photo']['name'],
                    'complaints'
                );
            } catch (RuntimeException $e) {
                Flash::set($e->getMessage(), 'danger');
                View::redirect('/complaints/new');
            }
        }

        Complaint::create((int) $_SESSION['user_id'], $title, $description, $photoUrl);
        Flash::set('Pengaduan berhasil dikirim.', 'success');
        View::redirect('/dashboard');
    }
}
