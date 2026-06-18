@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Archives</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Archives</span>
        </p>
    </div>

    <div class="bpsc-content">
        <h2 class="bpsc-section-title">Archived Notices & Results</h2>
        <p>Access previous notices, results, and advertisements from our archives below.</p>

        <div class="bpsc-table-wrapper" style="margin-top: 20px;">
            <table class="bpsc-data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">SR.</th>
                        <th style="width: 120px;">DATE</th>
                        <th>SUBJECT / TITLE</th>
                        <th style="width: 100px;">DOWNLOAD</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ sprintf('%02d', rand(1, 28)) }}-{{ sprintf('%02d', rand(1, 12)) }}-2024</td>
                            <td>Archived Notification regarding BPSC Competitive Examination {{ 2024 - ($i % 3) }}</td>
                            <td><a href="#" class="btn-download" style="background: #6b7280;"><i data-lucide="archive" size="13"></i> PDF</a></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
