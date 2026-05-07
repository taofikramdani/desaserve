<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Auth;
use App\Models\Complaint;
use App\Models\ServiceRequest;

class DashboardController
{
    public function index(): void
    {
        Auth::requireLogin();
        $userId = (int) $_SESSION['user_id'];

        View::render('user/dashboard', [
            'requests' => ServiceRequest::listByUser($userId),
            'complaints' => Complaint::listByUser($userId),
        ]);
    }
}
