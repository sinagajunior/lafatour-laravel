<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page_title = 'FAQ';
        $page_meta_description = 'Temukan jawaban untuk pertanyaan umum seputar Umroh dan Haji di LaFatour';

        return view('faq', compact('page_title', 'page_meta_description'));
    }
}
