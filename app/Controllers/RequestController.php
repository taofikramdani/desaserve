<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Auth;
use App\Helpers\Flash;
use App\Models\ServiceRequest;
use App\Services\S3Uploader;
use RuntimeException;

class RequestController
{
    public function showForm(): void
    {
        Auth::requireLogin();
        View::render('user/request_new');
    }

    public function submit(): void
    {
        Auth::requireLogin();

        $type = trim($_POST['request_type'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($type === '') {
            Flash::set('Jenis surat wajib dipilih.', 'warning');
            View::redirect('/requests/new');
        }

        $documentUrl = null;
        if (!empty($_FILES['document']['name'])) {
            try {
                $uploader = new S3Uploader();
                $documentUrl = $uploader->upload(
                    $_FILES['document']['tmp_name'],
                    $_FILES['document']['name'],
                    'documents'
                );
            } catch (RuntimeException $e) {
                Flash::set($e->getMessage(), 'danger');
                View::redirect('/requests/new');
            }
        }

        ServiceRequest::create((int) $_SESSION['user_id'], $type, $description, $documentUrl);
        Flash::set('Pengajuan berhasil dikirim.', 'success');
        View::redirect('/dashboard');
    }
}
