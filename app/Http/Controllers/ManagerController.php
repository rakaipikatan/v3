<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagerController extends Controller
{
    public function edit(Request $request): View
    {
        return view('manager.edit', [
            'manager' => $request->user()->manager,
        ]);
    }

    public function update(ManagerUpdateRequest $request): RedirectResponse
    {
        $request->user()->manager()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated(),
        );

        return redirect()->route('dashboard')->with('status', 'manager-updated');
    }
}
