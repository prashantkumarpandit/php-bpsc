@extends('layouts.app')

@section('content')
<div class="gallery-page">
    <div class="bpsc-banner">
        <h1>Gallery</h1>
        <p class="bpsc-breadcrumb">
            <span>🏠 Home</span> <span class="sep">»</span> <span>Gallery</span>
        </p>
    </div>

    <div class="gallery-content">
        @php
            $galleryGroups = [
                [
                    'title' => '26th January 2026',
                    'images' => ['/DSC_2639-scaled-1.jpg', '/biharrr-1.jpg', '/bpsc8.jpeg', '/DSC_2639-scaled-1.jpg', '/biharrr-1.jpg', '/bpsc8.jpeg'],
                ],
                [
                    'title' => 'Interview 2026',
                    'images' => ['/bpsc8.jpeg', '/biharrr-1.jpg', '/DSC_2639-scaled-1.jpg', '/bpsc8.jpeg', '/DSC_2639-scaled-1.jpg', '/biharrr-1.jpg', '/bpsc8.jpeg'],
                ]
            ];
        @endphp

        @foreach($galleryGroups as $group)
            <div class="gallery-group" style="margin-bottom: 40px;">
                <h2 class="gallery-group-title">{{ $group['title'] }}</h2>

                <div class="gallery-img-grid">
                    @foreach($group['images'] as $src)
                        <div class="gallery-img-item" onclick="openLightbox('{{ $src }}')">
                            <img src="{{ $src }}" alt="{{ $group['title'] }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Lightbox -->
    <div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 2000; align-items: center; justify-content: center;">
        <span style="position: absolute; top: 20px; right: 30px; color: white; font-size: 30px; cursor: pointer;" onclick="closeLightbox()">✕</span>
        <img id="lightbox-img" src="" style="max-width: 90%; max-height: 90%; border: 5px solid white;">
    </div>
</div>

<script>
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').style.display = 'flex';
    }
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>
@endsection
