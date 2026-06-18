@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Exam Calendar</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Exam Calendar</span>
        </p>
    </div>

    <div class="bpsc-content" style="max-width: 1300px;">
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="#" class="btn-download"><i data-lucide="download" size="14"></i> Click to download</a>
        </div>

        <div class="exam-cal-header-block">
            <h2 class="exam-cal-title">BIHAR PUBLIC SERVICE COMMISSION</h2>
            <p class="exam-cal-subtitle">Exam Calendar (All dates are tentative)</p>
            <div class="exam-cal-meta">
                <span>Date: 02-02-2026</span>
                <span class="exam-cal-tbd">TBD – To Be Decided</span>
            </div>
        </div>

        <div class="bpsc-table-wrapper">
            <table class="bpsc-data-table exam-cal-table">
                <thead>
                    <tr>
                        <th rowspan="3" style="width: 50px;">SN.</th>
                        <th rowspan="3">ADV NO</th>
                        <th rowspan="3">NAME OF THE POST</th>
                        <th rowspan="3" style="width: 80px;">NO. OF VACANCIES</th>
                        <th colspan="2">PRELIMS/MCQ</th>
                        <th colspan="2">MAINS/WRITTEN (TENTATIVE DATES)</th>
                        <th rowspan="3">INTERVIEW DATE</th>
                        <th rowspan="3">FINAL RESULT DATE</th>
                        <th rowspan="3">REMARKS, IF ANY</th>
                    </tr>
                    <tr>
                        <th>DATE</th>
                        <th>RESULT</th>
                        <th>DATE</th>
                        <th>RESULT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="phase-row">
                        <td colspan="11">3 PHASE EXAMS (PT + MAINS + INTERVIEW)</td>
                    </tr>
                    @php
                        $exams = [
                            ['sn' => 1, 'adv' => '70 CCE', 'post' => 'Integrated CCE 70th', 'vac' => 2035, 'prelDate' => '13-12-2024 and 04-01-2025', 'prelResult' => '23-01-2025', 'mainsDate' => '25,26,28,29 and 30-04-2025', 'mainsResult' => '', 'intDate' => 'December, 2025', 'finalResult' => 'January, 2026', 'remarks' => 'April/May 2026'],
                            ['sn' => 2, 'adv' => '29/2024', 'post' => 'Secondary & Higher Secondary Teacher in Simultala Residential School, Jamui', 'vac' => 62, 'prelDate' => '16-08-2024', 'prelResult' => 'Result published on 06-12-2024', 'mainsDate' => '17-06-2026 & 18-06-2026', 'mainsResult' => '', 'intDate' => 'TBD', 'finalResult' => '', 'remarks' => ''],
                            ['sn' => 3, 'adv' => '38/2025', 'post' => 'District Statistical Officer / Assistant Director', 'vac' => 47, 'prelDate' => '03-08-2025', 'prelResult' => 'November, 2025', 'mainsDate' => 'January, 2026', 'mainsResult' => '', 'intDate' => 'February, 2026', 'finalResult' => '', 'remarks' => ''],
                        ];
                    @endphp
                    @foreach($exams as $e)
                        <tr>
                            <td style="text-align: center;">{{ $e['sn'] }}</td>
                            <td style="text-align: center; color: #0288d1; font-weight: 600;">{{ $e['adv'] }}</td>
                            <td>{{ $e['post'] }}</td>
                            <td style="text-align: center;">{{ $e['vac'] }}</td>
                            <td style="text-align: center;">{{ $e['prelDate'] }}</td>
                            <td style="text-align: center;">{{ $e['prelResult'] }}</td>
                            <td style="text-align: center;">{{ $e['mainsDate'] }}</td>
                            <td style="text-align: center;">{{ $e['mainsResult'] }}</td>
                            <td style="text-align: center;">{{ $e['intDate'] }}</td>
                            <td style="text-align: center;">{{ $e['finalResult'] }}</td>
                            <td>{{ $e['remarks'] }}</td>
                        </tr>
                    @endforeach

                    <tr class="phase-row">
                        <td colspan="11">2 PHASE EXAMS</td>
                    </tr>
                    @php
                        $exams2 = [
                            ['sn' => 15, 'adv' => '22/2024', 'post' => 'District Horticulture Officer (Group-A)', 'vac' => 31, 'prelDate' => '', 'prelResult' => '', 'mainsDate' => 'Result published on 20-01-2025', 'mainsResult' => '', 'intDate' => '', 'finalResult' => '', 'remarks' => ''],
                            ['sn' => 16, 'adv' => '23/2024', 'post' => 'District Agriculture Officer (Group-A)', 'vac' => 9, 'prelDate' => '', 'prelResult' => '', 'mainsDate' => 'Result published on 20-01-2025', 'mainsResult' => '', 'intDate' => '', 'finalResult' => '', 'remarks' => ''],
                        ];
                    @endphp
                    @foreach($exams2 as $e)
                        <tr>
                            <td style="text-align: center;">{{ $e['sn'] }}</td>
                            <td style="text-align: center; color: #0288d1; font-weight: 600;">{{ $e['adv'] }}</td>
                            <td>{{ $e['post'] }}</td>
                            <td style="text-align: center;">{{ $e['vac'] }}</td>
                            <td style="text-align: center;">{{ $e['prelDate'] }}</td>
                            <td style="text-align: center;">{{ $e['prelResult'] }}</td>
                            <td style="text-align: center;">{{ $e['mainsDate'] }}</td>
                            <td style="text-align: center;">{{ $e['mainsResult'] }}</td>
                            <td style="text-align: center;">{{ $e['intDate'] }}</td>
                            <td style="text-align: center;">{{ $e['finalResult'] }}</td>
                            <td>{{ $e['remarks'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
