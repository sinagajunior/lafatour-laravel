<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::active()
            ->latest()
            ->get();

        return view('about', compact('teamMembers'));
    }
}
