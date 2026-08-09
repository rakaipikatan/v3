<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\RaceEvent;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        return view('public.home', [
            'event' => Event::orderBy('start_date')->first(),
        ]);
    }

    public function about(): View
    {
        return view('public.about', [
            'event' => Event::orderBy('start_date')->first(),
        ]);
    }

    public function categories(): View
    {
        return view('public.categories', [
            'categories' => Category::orderBy('group')->orderBy('name')->get()->groupBy('group'),
        ]);
    }

    public function competitionNumbers(): View
    {
        return view('public.competition-numbers', [
            'raceEvents' => RaceEvent::orderBy('name')->get(),
        ]);
    }

    public function fees(): View
    {
        return view('public.fees', [
            'categories' => Category::orderBy('group')->orderBy('name')->get()->groupBy('group'),
        ]);
    }

    public function schedule(): View
    {
        return view('public.schedule', [
            'event' => Event::orderBy('start_date')->first(),
        ]);
    }

    public function handbook(): View
    {
        return view('public.handbook');
    }

    public function sponsors(): View
    {
        return view('public.sponsors');
    }

    public function results(): View
    {
        return view('public.results', [
            'event' => Event::orderBy('start_date')->first(),
        ]);
    }
}
