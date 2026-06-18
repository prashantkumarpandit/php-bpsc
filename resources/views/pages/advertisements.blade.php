@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Advertisements</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span><span class="sep">»</span><span>Advertisements</span>
        </p>
    </div>

    <div class="bpsc-content">
        <h2 class="bpsc-section-title">Latest Advertisements & Notifications</h2>

        <!-- Search -->
        <form method="GET" action="{{ route('advertisements') }}" style="margin-bottom: 16px;">
            <input type="text" name="search" placeholder="Search by title or advertisement number..." value="{{ request('search') }}" style="width: 100%; padding: 10px 14px; border: 1.5px solid #d1d5db; border-radius: 8px; font-size: 14px; box-sizing: border-box; outline: none;" onchange="this.form.submit()">
            <input type="hidden" name="category" value="{{ request('category', 'All') }}">
        </form>

        <!-- Tabs -->
        <div class="filter-tabs">
            @php $categories = ['All', 'Advertisement', 'Result', 'Admission Card', 'Syllabus', 'Important Notice', 'Examination Program']; @endphp
            @foreach($categories as $cat)
                <button class="filter-tab-btn {{ request('category', 'All') == $cat ? 'active' : '' }}" onclick="window.location.href='?category={{ urlencode($cat) }}&search={{ urlencode(request('search')) }}'">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="bpsc-table-wrapper">
            <table class="bpsc-data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">SR.</th>
                        <th>DATE</th>
                        <th>ADVT. NO.</th>
                        <th>CATEGORY</th>
                        <th>SUBJECT / TITLE</th>
                        <th style="width: 90px;">DOWNLOAD</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $advertisements = [
                            ['sr' => 1, 'advNo' => '05/2025', 'date' => '18-02-2025', 'category' => 'Advertisement', 'title' => '70th Combined (Preliminary) Competitive Examination, 2024', 'url' => '#'],
                            ['sr' => 2, 'advNo' => '06/2025', 'date' => '25-02-2025', 'category' => 'Advertisement', 'title' => 'District Statistical Officer / Assistant Director (Statistics) Main (Written) Competitive Examination, 2025', 'url' => '#'],
                            ['sr' => 3, 'advNo' => '07/2025', 'date' => '05-03-2025', 'category' => 'Advertisement', 'title' => 'Assistant Education Development Officer Written (Objective) Competitive Examination, 2025', 'url' => '#'],
                            ['sr' => 4, 'advNo' => '08/2025', 'date' => '10-03-2025', 'category' => 'Advertisement', 'title' => 'Bihar Judicial Services (Preliminary) Competitive Examination, 2025', 'url' => '#'],
                            ['sr' => 5, 'advNo' => '01/2025', 'date' => '05-01-2025', 'category' => 'Result', 'title' => 'Result of Assistant Section Officer Main (Objective) Competitive Examination, 2024', 'url' => '#'],
                            ['sr' => 6, 'advNo' => '02/2025', 'date' => '14-01-2025', 'category' => 'Admission Card', 'title' => 'Admit Card for 69th BPSC Mains Examination', 'url' => '#'],
                            ['sr' => 7, 'advNo' => '37/2025', 'date' => '22-02-2025', 'category' => 'Syllabus', 'title' => 'Detailed Syllabus for Assistant Section Officer BPSC Examination', 'url' => '#'],
                            ['sr' => 8, 'advNo' => '38/2025', 'date' => '27-02-2025', 'category' => 'Important Notice', 'title' => 'District Statistical Officer Admit Card Release Notice', 'url' => '#'],
                            ['sr' => 9, 'advNo' => '42/2025', 'date' => '24-02-2025', 'category' => 'Important Notice', 'title' => 'Invitation of Objection to Answers of Special School Teacher Examination', 'url' => '#'],
                            ['sr' => 10, 'advNo' => '87/2025', 'date' => '25-02-2025', 'category' => 'Examination Program', 'title' => 'Assistant Education Development Officer Examination Schedule', 'url' => '#'],
                        ];

                        $activeCategory = request('category', 'All');
                        $search = request('search', '');

                        $filtered = array_filter($advertisements, function($item) use ($activeCategory, $search) {
                            $catMatch = $activeCategory == 'All' || $item['category'] == $activeCategory;
                            $searchMatch = empty($search) || stripos($item['title'], $search) !== false || stripos($item['advNo'], $search) !== false;
                            return $catMatch && $searchMatch;
                        });
                    @endphp

                    @if(empty($filtered))
                        <tr><td colspan="6" style="text-align: center; padding: 32px; color: #9ca3af;">No records found.</td></tr>
                    @else
                        @foreach($filtered as $idx => $row)
                            <tr>
                                <td>{{ $row['sr'] }}</td>
                                <td style="white-space: nowrap;">{{ $row['date'] }}</td>
                                <td style="white-space: nowrap;">{{ $row['advNo'] }}</td>
                                <td><span style="background: #e3f2fd; color: #0288d1; padding: 2px 8px; border-radius: 999px; font-size: 12px; font-weight: 600;">{{ $row['category'] }}</span></td>
                                <td>{{ $row['title'] }} @if($idx < 3) <span class="badge-new">NEW</span> @endif</td>
                                <td><a href="{{ $row['url'] }}" class="btn-download"><i data-lucide="download" size="13"></i> PDF</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
