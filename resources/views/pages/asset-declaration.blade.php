@extends('layouts.app')

@section('content')
<div class="bpsc-inner-page">
    <div class="bpsc-banner">
        <h1>Asset Declaration</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Asset Declaration</span>
        </p>
    </div>

    <!-- Decorative sub-banner -->
    <div class="asset-sub-banner">
        <div class="asset-sub-left">
            <span style="font-size: 24px;">🏛️</span>
            <span style="color: #164e87; font-weight: bold; font-size: 18px; margin-left: 10px;">बिहार सरकार</span>
        </div>
        <div class="asset-sub-center">
            <div class="asset-declaration-text">
                <span class="decl-word">Declaration</span>
                <span class="decl-of">of</span>
                <div class="decl-row">
                    <span class="decl-assets">Assets</span>
                    <span class="decl-amp">&</span>
                    <span class="decl-liabilities">Liabilities</span>
                </div>
            </div>
        </div>
        <div class="asset-sub-right">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: #164e87; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid #0aa4db;">
                BPSC
            </div>
        </div>
    </div>

    <div class="bpsc-content">
        <ul class="asset-year-list">
            @php
                $years = [
                    '2024-25', '2023-24', '2022-23', '2021-22', '2020-21',
                    '2019-20', '2018-19', '2017-18', '2016-17', '2015-16',
                    '2014-15', '2013-14', '2012-13', '2011-12', '2010-11',
                ];
            @endphp
            @foreach($years as $yr)
                <li>
                    <a href="#" class="asset-year-link">
                        Asset Declaration {{ $yr }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
