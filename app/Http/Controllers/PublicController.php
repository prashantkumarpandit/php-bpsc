<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function index()
    {
        $this->incrementVisitor();
        
        $stats = [
            'today' => Visitor::where('date', Carbon::today()->toDateString())->first()?->count ?? 0,
            'yesterday' => Visitor::where('date', Carbon::yesterday()->toDateString())->first()?->count ?? 0,
            'thisMonth' => Visitor::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('count'),
            'thisYear' => Visitor::whereYear('date', Carbon::now()->year)->sum('count'),
            'total' => Visitor::sum('count'),
        ];

        return view('home', compact('stats'));
    }

    public function history()
    {
        return view('pages.history');
    }

    public function contactUs()
    {
        return view('pages.contact-us');
    }

    public function theCommission()
    {
        return view('pages.the-commission');
    }

    public function examCalendar()
    {
        return view('pages.exam-calendar');
    }

    public function syllabus()
    {
        return view('pages.syllabus');
    }

    public function advertisements()
    {
        return view('pages.advertisements');
    }

    public function onlineApplication()
    {
        return view('pages.online-application');
    }

    public function constitutionalProvisions()
    {
        return view('pages.constitutional-provisions');
    }

    public function faqs()
    {
        return view('pages.faqs');
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function archives()
    {
        return view('pages.archives');
    }

    public function community()
    {
        return view('pages.community');
    }

    public function section()
    {
        return view('pages.section');
    }

    public function assetDeclaration()
    {
        return view('pages.asset-declaration');
    }

    private function incrementVisitor()
    {
        $today = Carbon::today()->toDateString();
        $visitor = Visitor::firstOrCreate(['date' => $today]);
        $visitor->increment('count');
    }
}
