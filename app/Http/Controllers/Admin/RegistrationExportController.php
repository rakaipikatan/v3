<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationExportController extends Controller
{
    public function __invoke(): StreamedResponse
    {
        $filename = 'registrations-'.now()->format('Y-m-d-His').'.csv';

        $columns = [
            'Registration ID', 'Athlete Name', 'Gender', 'Age', 'Club', 'Manager Name', 'Manager Phone',
            'Event', 'Category Group', 'Category Name', 'Jersey Size', 'Competition Numbers', 'Bib Numbers',
            'Emergency Contact Name', 'Emergency Contact Phone',
            'Invoice Number', 'Total Amount (Rp)', 'Payment Status', 'Registered At',
        ];

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            Registration::query()
                ->with(['athlete.club.manager', 'event', 'category', 'jerseySize', 'items.raceEvent', 'items.raceNumber', 'invoice.payments'])
                ->orderBy('created_at')
                ->chunk(200, function ($registrations) use ($handle) {
                    foreach ($registrations as $registration) {
                        $payment = $registration->invoice?->payments->first();

                        fputcsv($handle, [
                            $registration->id,
                            $registration->athlete->full_name,
                            ucfirst($registration->athlete->gender),
                            $registration->athlete->age,
                            $registration->athlete->club->club_name,
                            $registration->athlete->club->manager->full_name,
                            $registration->athlete->club->manager->phone,
                            $registration->event->name,
                            ucfirst($registration->category->group),
                            $registration->category->name,
                            $registration->jerseySize->label,
                            $registration->items->pluck('raceEvent.name')->join('; '),
                            $registration->items->pluck('raceNumber.bib_number')->filter()->join('; '),
                            $registration->emergency_contact_name,
                            $registration->emergency_contact_phone,
                            $registration->invoice?->invoice_number,
                            $registration->invoice?->total_amount,
                            $payment?->status ?? 'pending_payment',
                            $registration->created_at->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
