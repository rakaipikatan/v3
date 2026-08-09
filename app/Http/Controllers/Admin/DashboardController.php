<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Club;
use App\Models\Payment;
use App\Models\Registration;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'clubCount' => Club::count(),
            'athleteCount' => Athlete::count(),
            'registrationCount' => Registration::count(),
            'pendingReviewCount' => Payment::whereIn('status', ['payment_submitted', 'under_review'])->count(),
            'paidCount' => Payment::where('status', 'paid')->count(),
        ]);
    }
}
