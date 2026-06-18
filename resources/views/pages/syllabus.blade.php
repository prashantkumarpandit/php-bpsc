@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Syllabus</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span><span class="sep">»</span><span>Examination</span><span class="sep">»</span><span>Syllabus</span>
        </p>
    </div>

    <div class="bpsc-content">
        <h2 class="bpsc-section-title">Examination Syllabus</h2>
        <p>Download the detailed syllabus for all BPSC examinations. Click the PDF button to download the syllabus for any exam.</p>

        <div class="filter-tabs">
            @php $tabs = ['All', 'Objective', 'Descriptive', 'Written']; @endphp
            @foreach($tabs as $t)
                <button class="filter-tab-btn {{ request('type', 'All') == $t ? 'active' : '' }}" onclick="window.location.href='?type={{ $t }}'">{{ $t }}</button>
            @endforeach
        </div>

        <div class="bpsc-table-wrapper">
            <table class="bpsc-data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">SR.</th>
                        <th>EXAMINATION NAME</th>
                        <th>SUBJECT</th>
                        <th>TYPE</th>
                        <th style="width: 100px;">SYLLABUS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $syllabus = [
                            ['sr' => 1, 'exam' => '70th Combined (Preliminary) Competitive Examination, 2024', 'subject' => 'General Studies', 'type' => 'Objective', 'url' => '#'],
                            ['sr' => 2, 'exam' => '70th Combined (Mains) — Paper I', 'subject' => 'General Studies — I', 'type' => 'Descriptive', 'url' => '#'],
                            ['sr' => 3, 'exam' => '70th Combined (Mains) — Paper II', 'subject' => 'General Studies — II', 'type' => 'Descriptive', 'url' => '#'],
                            ['sr' => 4, 'exam' => '70th Combined (Mains) — General Hindi', 'subject' => 'General Hindi', 'type' => 'Descriptive', 'url' => '#'],
                            ['sr' => 5, 'exam' => '70th Combined (Mains) — Essay', 'subject' => 'Essay', 'type' => 'Descriptive', 'url' => '#'],
                            ['sr' => 6, 'exam' => 'Assistant Section Officer (BPSC) Examination, 2024', 'subject' => 'General Studies + Reasoning', 'type' => 'Objective', 'url' => '#'],
                            ['sr' => 7, 'exam' => 'District Statistical Officer Examination, 2025', 'subject' => 'Statistics / Mathematics', 'type' => 'Written', 'url' => '#'],
                            ['sr' => 8, 'exam' => 'Bihar Judicial Services (Preliminary) Examination, 2025', 'subject' => 'Law', 'type' => 'Objective', 'url' => '#'],
                            ['sr' => 9, 'exam' => 'Special School Teacher Examination (Class 6-8), 2026', 'subject' => 'Subject-specific (Multi)', 'type' => 'Objective', 'url' => '#'],
                            ['sr' => 10, 'exam' => 'Assistant Education Development Officer Examination, 2025', 'subject' => 'General Studies + Education', 'type' => 'Objective', 'url' => '#'],
                            ['sr' => 11, 'exam' => 'Assistant Town Planner Examination, 2025', 'subject' => 'Urban Planning / Architecture', 'type' => 'Written', 'url' => '#'],
                            ['sr' => 12, 'exam' => 'Assistant Curator / Research & Publication Officer Examination, 2025', 'subject' => 'History / Archaeology', 'type' => 'Written', 'url' => '#'],
                        ];

                        $activeType = request('type', 'All');
                        if($activeType != 'All') {
                            $syllabus = array_filter($syllabus, function($item) use ($activeType) {
                                return $item['type'] == $activeType;
                            });
                        }
                    @endphp

                    @foreach($syllabus as $row)
                        <tr>
                            <td>{{ $row['sr'] }}</td>
                            <td>{{ $row['exam'] }}</td>
                            <td>{{ $row['subject'] }}</td>
                            <td>
                                @php
                                    $bg = $row['type'] == 'Objective' ? '#ecfdf5' : ($row['type'] == 'Descriptive' ? '#eff6ff' : '#fffbeb');
                                    $color = $row['type'] == 'Objective' ? '#059669' : ($row['type'] == 'Descriptive' ? '#2563eb' : '#d97706');
                                @endphp
                                <span style="background: {{ $bg }}; color: {{ $color }}; padding: 2px 8px; border-radius: 999px; font-size: 12px; font-weight: 600;">{{ $row['type'] }}</span>
                            </td>
                            <td><a href="{{ $row['url'] }}" class="btn-download"><i data-lucide="download" size="13"></i> PDF</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bpsc-article-block">
            <h3><i data-lucide="info" size="16" style="margin-right: 6px;"></i> Note</h3>
            <p>
                The syllabus provided here is indicative. Always refer to the official advertisement for the
                most accurate and up-to-date syllabus before preparing for any examination.
                Syllabus may be subject to revision by the Commission.
            </p>
        </div>
    </div>
</div>
@endsection
