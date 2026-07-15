@extends('layouts.app')

@section('title', 'Certificates & Compliance - Surma Agro')
@section('meta_description', 'Surma Agro certifications including ISO 9001:2015, HACCP, GMP, and organic certifications ensuring premium quality and food safety.')

@section('content')

@verbatim
<style>
    [x-cloak] { display: none !important; }

    /* ─── Card grid ─── */
    @keyframes cert-shine {
        0%   { transform: translateX(-100%) skewX(-15deg); }
        100% { transform: translateX(200%) skewX(-15deg); }
    }
    .cert-card {
        transition: transform .35s cubic-bezier(.25,.8,.25,1),
                    box-shadow .35s cubic-bezier(.25,.8,.25,1);
    }
    .cert-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 0 0 1.5px rgba(134,176,83,.55),
                    0 20px 60px rgba(0,0,0,.13),
                    0 0 40px rgba(134,176,83,.12);
    }
    .cert-card:hover .cert-shine { animation: cert-shine .75s ease forwards; }
    .cert-shine {
        position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(90deg,transparent,rgba(255,255,255,.18),transparent);
    }

    /* ─── Fullscreen viewer shell ─── */
    #cert-viewer {
        position: fixed; inset: 0; z-index: 99999;
        background: rgba(0,0,0,.96);
        backdrop-filter: blur(14px);
        display: none;
        flex-direction: column;
        opacity: 0;
        transition: opacity .25s ease;
    }
    #cert-viewer.cv-open    { display: flex; }
    #cert-viewer.cv-visible { opacity: 1; }

    /* ─── Stage: the scrollable/pannable viewport ─── */
    #cv-stage {
        flex: 1;
        overflow: hidden;           /* clips pan edges cleanly */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: zoom-in;
    }
    #cv-stage.zoomed  { cursor: grab; }
    #cv-stage.grabbing { cursor: grabbing !important; }

    /*
     * cv-zoom-wrap: the element we apply transform scale() to.
     * It must have NO max-width / max-height / width / height constraints
     * so scale() can make it visually larger than the viewport.
     */
    #cv-zoom-wrap {
        transform-origin: center center;
        will-change: transform;
        /* transition controlled by JS class */
        line-height: 0;             /* remove inline-block gap */
    }
    #cv-zoom-wrap.cv-animated {
        transition: transform .18s cubic-bezier(.25,.8,.25,1);
    }

    /*
     * cv-img: natural image size at 100%, capped by viewport so it fits.
     * CRITICAL: these constraints apply ONLY to the layout size.
     * scale() on the PARENT (#cv-zoom-wrap) overrides the visual size
     * without being constrained by these rules — the image will visually
     * grow to 2x, 3x, 4x the viewport.
     */
    #cv-img {
        display: block;
        max-width:  min(88vw, 760px);
        max-height: min(62vh, 800px);
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 32px 96px rgba(0,0,0,.55);
        user-select: none;
        -webkit-user-drag: none;
        pointer-events: none;       /* drag handled by stage */
    }

    /* ─── Slide animations on cv-zoom-wrap (not on img) ─── */
    @keyframes sl-right  { from { opacity:0; transform: translateX(60px);  } to { opacity:1; transform: translate(0,0) scale(1); } }
    @keyframes sl-left   { from { opacity:0; transform: translateX(-60px); } to { opacity:1; transform: translate(0,0) scale(1); } }
    @keyframes sl-center { from { opacity:0; transform: scale(.93);        } to { opacity:1; transform: translate(0,0) scale(1); } }
    .sl-right  { animation: sl-right  .28s cubic-bezier(.25,.8,.25,1) both; }
    .sl-left   { animation: sl-left   .28s cubic-bezier(.25,.8,.25,1) both; }
    .sl-center { animation: sl-center .28s cubic-bezier(.25,.8,.25,1) both; }

    /* ─── Close button ─── */
    #cv-close {
        position: absolute; top: 14px; right: 14px; z-index: 100001;
        width: 44px; height: 44px; border-radius: 50%;
        background: #fff; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 24px rgba(0,0,0,.5);
        transition: transform .2s, background .2s;
    }
    #cv-close:hover { background: #f0f0f0; transform: rotate(90deg) scale(1.1); }

    /* ─── Zoom toolbar ─── */
    #cv-toolbar {
        display: flex; justify-content: center;
        flex-shrink: 0; padding: 6px 0 8px;
    }
    .cv-toolbar-inner {
        display: inline-flex; align-items: center; gap: 2px;
        padding: 5px 14px; border-radius: 999px;
        background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
    }
    .cv-zbtn {
        width: 32px; height: 32px; border-radius: 50%;
        background: transparent; border: none; cursor: pointer;
        color: #fff; display: flex; align-items: center; justify-content: center;
        transition: background .15s, transform .15s;
    }
    .cv-zbtn:hover { background: rgba(255,255,255,.2); transform: scale(1.12); }
    #cv-zpct {
        font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,.8);
        width: 44px; text-align: center;
        letter-spacing: .02em;
    }
    .cv-divider { width: 1px; height: 16px; background: rgba(255,255,255,.2); margin: 0 4px; }

    /* ─── Nav arrows ─── */
    .cv-arrow {
        position: absolute; top: 50%; transform: translateY(-50%); z-index: 20;
        width: 44px; height: 44px; border-radius: 50%;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.22);
        color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(8px);
        transition: background .2s, transform .2s;
    }
    .cv-arrow:hover { background: rgba(255,255,255,.28); transform: translateY(-50%) scale(1.08); }
    #cv-prev { left: 14px; }
    #cv-next { right: 14px; }

    /* ─── Thumbnail strip ─── */
    #cv-thumbs {
        display: flex; gap: 8px; overflow-x: auto;
        max-width: 600px; margin: 0 auto; padding-bottom: 4px;
        scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.25) transparent;
    }
    #cv-thumbs::-webkit-scrollbar { height: 3px; }
    #cv-thumbs::-webkit-scrollbar-thumb { background: rgba(255,255,255,.25); border-radius: 99px; }
    .cv-thumb {
        flex-shrink: 0; width: 56px; height: 64px; border-radius: 8px;
        overflow: hidden; cursor: pointer;
        border: 2px solid rgba(255,255,255,.2);
        opacity: .45; transform: scale(1);
        transition: all .2s; background: #fff; padding: 0;
    }
    .cv-thumb.active { border-color: #fff; opacity: 1; transform: scale(1.08); }
    .cv-thumb img { width: 100%; height: 100%; object-fit: contain; padding: 2px; }
</style>
@endverbatim

{{-- ═══════════ HERO ═══════════ --}}
<section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-forest-500 rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">
            Certifications
        </span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Certificates &amp; Compliance</h1>
        <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
            Internationally recognised certifications that guarantee quality, safety, and reliability
        </p>
    </div>
</section>

{{-- ═══════════ MAIN CONTENT ═══════════ --}}
<section class="py-24 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
            $certificateScans = [
                ['name' => 'Certificate of Incorporation',     'issuing_body' => 'Changebox Services Company Limited',                   'image' => asset('storage/certificate_pdf/certificate_pdf (1).webp')],
                ['name' => 'Membership Certificate',           'issuing_body' => "Myanmar International Freight Forwarders' Association", 'image' => asset('storage/certificate_pdf/certificate_pdf (2).webp')],
                ['name' => 'Certificate of Membership',        'issuing_body' => 'UMFCCI – Changebox Services Company Limited',           'image' => asset('storage/certificate_pdf/certificate_pdf (3).webp')],
                ['name' => 'Exporter / Importer Registration', 'issuing_body' => 'Ministry of Commerce, Department of Trade',             'image' => asset('storage/certificate_pdf/certificate_pdf (4).webp')],
                ['name' => 'Certificate of Incorporation',     'issuing_body' => 'Surma River Fish Ltd',                                  'image' => asset('storage/certificate_pdf/certificate_pdf (5).webp')],
                ['name' => 'Report of Arrival (Form C)',       'issuing_body' => 'Immigration Record',                                   'image' => asset('storage/certificate_pdf/certificate_pdf (6).webp')],
                ['name' => 'Report of Arrival (Form C)',       'issuing_body' => 'Immigration Record',                                   'image' => asset('storage/certificate_pdf/certificate_pdf (7).webp')],
                ['name' => 'Certificate of Membership',        'issuing_body' => 'UMFCCI – Surma River Fish Limited',                     'image' => asset('storage/certificate_pdf/certificate_pdf (8).webp')],
            ];
            $complianceItems = [
                ['title' => 'Quality Assurance',     'desc' => 'Rigorous testing and quality checks at every stage of production.'],
                ['title' => 'Food Safety',            'desc' => 'HACCP and FSSC 22000 compliant facilities and processes.'],
                ['title' => 'Regulatory Compliance', 'desc' => 'Full compliance with international trade and export regulations.'],
            ];
        @endphp

        {{-- Section header --}}
        <div class="text-center" style="margin-bottom: 56px;">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-forest-100 text-forest-700 text-xs font-bold rounded-full uppercase tracking-widest mb-4">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Verified Documents
            </span>
            <h2 class="text-3xl lg:text-4xl font-bold text-forest-900 mb-4">Our Certificates</h2>
            <p class="text-forest-500 max-w-2xl mx-auto leading-relaxed">
                Verified certifications, registrations, and quality assurance documents demonstrating our commitment to excellence.
            </p>
        </div>

        {{-- Card grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
            @foreach($certificateScans as $i => $scan)
                <button
                    type="button"
                    class="cert-card relative group rounded-[18px] overflow-hidden bg-white border border-warm-gray/40 shadow-md text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-forest-500"
                    onclick="CertViewer.open({{ $i }})"
                    aria-label="View {{ $scan['name'] }} full screen"
                >
                    <div class="relative aspect-[3/4] bg-forest-50 overflow-hidden">
                        <img
                            src="{{ $scan['image'] }}"
                            alt="{{ $scan['name'] }}"
                            loading="lazy"
                            class="w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-[1.05]"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-5">
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white/90 backdrop-blur-sm text-forest-800 text-xs font-bold shadow-lg">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 8v6M8 11h6"/>
                                </svg>
                                View Certificate
                            </span>
                        </div>
                        <div class="cert-shine"></div>
                    </div>
                    <div class="p-4 border-t border-warm-gray/40">
                        <p class="text-sm font-bold text-forest-800 leading-snug mb-0.5">{{ $scan['name'] }}</p>
                        <p class="text-xs text-forest-400 leading-snug line-clamp-2">{{ $scan['issuing_body'] }}</p>
                    </div>
                </button>
            @endforeach
        </div>

        {{-- Compliance cards --}}
        <div class="mt-20 bg-white rounded-2xl p-10 border border-warm-gray/50 shadow-sm">
            <h2 class="text-2xl font-bold text-forest-800 mb-8 text-center">Our Compliance Commitment</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($complianceItems as $item)
                    <div class="text-center p-6 rounded-2xl bg-forest-50 border border-forest-100">
                        <div class="w-12 h-12 bg-forest-700 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-forest-800 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-forest-500 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     CERTIFIED EXCELLENCE MARQUEE
═══════════════════════════════════════════════════ --}}
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Our Certifications</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Certified Excellence</h2>
            <p class="text-forest-500 text-lg max-w-2xl mx-auto">Internationally recognized certifications ensuring quality and compliance</p>
        </div>

        <div class="flex justify-center">
            <div class="cert-marquee">
                <div class="cert-marquee-track">
                    @php
                        $certLogos   = ['L1.webp','L2.webp','L3.webp','L4.webp','L5.webp','L6.webp','L7.webp'];
                        $certLogosAll = array_merge($certLogos, $certLogos);
                    @endphp
                    @foreach($certLogosAll as $logo)
                        <img src="{{ asset('storage/certificate_images/' . $logo) }}" alt="Certification badge">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@verbatim
<style>
    .cert-marquee {
        overflow: hidden;
        width: 1172px;
        max-width: 100%;
        mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
    }
    .cert-marquee-track {
        display: flex;
        gap: 2rem;
        width: max-content;
        animation: cert-scroll 30s linear infinite;
        will-change: transform;
        align-items: center;
    }
    .cert-marquee-track img {
        width: 140px;
        height: auto;
        object-fit: contain;
        flex-shrink: 0;
    }
    @keyframes cert-scroll {
        0%   { transform: translateX(-1172px); }
        100% { transform: translateX(0); }
    }
</style>
@endverbatim

{{-- ═══════════════════════════════════════════════════
     FULLSCREEN VIEWER HTML
═══════════════════════════════════════════════════ --}}<div id="cert-viewer" role="dialog" aria-modal="true" aria-label="Certificate viewer">

    {{-- Close --}}
    <button id="cv-close" onclick="CertViewer.close()" aria-label="Close gallery (Esc)">
        <svg width="18" height="18" fill="none" stroke="#111" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- Top bar --}}
    <div style="display:flex;align-items:center;justify-content:center;gap:12px;padding:18px 60px 4px;flex-shrink:0">
        <span style="font-size:13px;font-weight:600;color:rgba(255,255,255,.45)">
            <span id="cv-cur" style="color:#fff;font-weight:700">1</span>
            <span style="margin:0 4px;color:rgba(255,255,255,.25)">/</span>
            <span id="cv-tot">8</span>
        </span>
        <p id="cv-title" style="font-size:13px;font-weight:600;color:rgba(255,255,255,.85);max-width:440px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"></p>
    </div>

    {{-- Zoom toolbar --}}
    <div id="cv-toolbar">
        <div class="cv-toolbar-inner">
            <button class="cv-zbtn" onclick="CertViewer.zoomBy(-0.25)" aria-label="Zoom out">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M8 11h6"/>
                </svg>
            </button>
            <span id="cv-zpct">100%</span>
            <button class="cv-zbtn" onclick="CertViewer.zoomBy(0.25)" aria-label="Zoom in">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 8v6M8 11h6"/>
                </svg>
            </button>
            <div class="cv-divider"></div>
            <button class="cv-zbtn" onclick="CertViewer.resetZoom()" aria-label="Reset zoom">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Stage → zoom-wrap → img  (three-layer architecture) --}}
    <div id="cv-stage">
        <div id="cv-zoom-wrap">
            <img id="cv-img" src="" alt="" draggable="false">
        </div>
    </div>

    {{-- Nav arrows --}}
    <button id="cv-prev" class="cv-arrow" onclick="CertViewer.navigate(-1)" aria-label="Previous">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button id="cv-next" class="cv-arrow" onclick="CertViewer.navigate(1)" aria-label="Next">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Issuing body label --}}
    <div style="flex-shrink:0;padding:4px 16px;text-align:center">
        <p id="cv-issuer" style="font-size:11px;color:rgba(255,255,255,.35);max-width:440px;margin:0 auto;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"></p>
    </div>

    {{-- Thumbnail strip --}}
    <div style="flex-shrink:0;padding:8px 16px 20px">
        <div id="cv-thumbs"></div>
    </div>

</div>

{{-- ═══════════════════════════════════════════════════
     VANILLA JS ENGINE
═══════════════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    /* ── data ── */
    var CERTS = {{ Js::from($certificateScans) }};

    /* ── zoom / pan state ── */
    var zoom     = 1;
    var panX     = 0;
    var panY     = 0;
    var MIN_Z    = 0.5;
    var MAX_Z    = 5;
    var curIdx   = 0;

    /* ── drag state ── */
    var dragging    = false;
    var dragStartX  = 0;
    var dragStartY  = 0;
    var dragOriginX = 0;
    var dragOriginY = 0;

    /* ── pinch state ── */
    var lastPinch = null;

    /* ── DOM ── */
    var viewer   = document.getElementById('cert-viewer');
    var stage    = document.getElementById('cv-stage');
    var wrap     = document.getElementById('cv-zoom-wrap');  /* ← zoom target */
    var img      = document.getElementById('cv-img');
    var zpct     = document.getElementById('cv-zpct');
    var curEl    = document.getElementById('cv-cur');
    var totEl    = document.getElementById('cv-tot');
    var titleEl  = document.getElementById('cv-title');
    var issuerEl = document.getElementById('cv-issuer');
    var thumbs   = document.getElementById('cv-thumbs');

    /* ── build thumbnails once ── */
    totEl.textContent = CERTS.length;
    CERTS.forEach(function (c, i) {
        var btn = document.createElement('button');
        btn.className = 'cv-thumb';
        btn.setAttribute('aria-label', 'Certificate ' + (i + 1));
        btn.innerHTML = '<img src="' + c.image + '" alt="">';
        btn.addEventListener('click', function () { CertViewer.jumpTo(i); });
        thumbs.appendChild(btn);
        /* preload */
        (new Image()).src = c.image;
    });

    /* ════════════════════════════════════════════
       THE ONE TRUE TRANSFORM FUNCTION
       Applies to #cv-zoom-wrap — NOT to #cv-img.
       #cv-img has max-width/max-height for layout only.
       scale() on the wrapper makes it visually larger
       than those constraints, exactly like Google Drive.
    ════════════════════════════════════════════ */
    function applyTransform(withTransition) {
        if (withTransition) {
            wrap.classList.add('cv-animated');
        } else {
            wrap.classList.remove('cv-animated');
        }
        wrap.style.transform =
            'translate(' + panX + 'px, ' + panY + 'px) scale(' + zoom + ')';

        zpct.textContent = Math.round(zoom * 100) + '%';
        stage.classList.toggle('zoomed', zoom > 1);

        /* debug — remove once confirmed working */
        console.log({
            zoom: zoom,
            wrapTransform: wrap.style.transform,
            imgW: img.offsetWidth,
            imgH: img.offsetHeight,
            visualW: Math.round(img.offsetWidth  * zoom),
            visualH: Math.round(img.offsetHeight * zoom)
        });
    }

    /* ── load image at index ── */
    function loadImage(newIdx, animClass) {
        curIdx = newIdx;
        var c  = CERTS[curIdx];

        /* reset zoom without transition */
        zoom = 1; panX = 0; panY = 0;
        wrap.classList.remove('cv-animated', 'sl-right', 'sl-left', 'sl-center');
        wrap.style.transform = 'translate(0px, 0px) scale(1)';

        /* swap src */
        img.src = c.image;
        img.alt = c.name;

        /* play slide animation on the wrap, one frame later */
        requestAnimationFrame(function () {
            wrap.classList.add(animClass || 'sl-center');
        });

        /* CRITICAL FIX: Remove animation class after it finishes (280ms)
           so it doesn't permanently override inline transform */
        setTimeout(function () {
            wrap.classList.remove('sl-right', 'sl-left', 'sl-center');
        }, 320);

        /* update text */
        curEl.textContent   = curIdx + 1;
        titleEl.textContent = c.name;
        issuerEl.textContent = c.issuing_body;
        zpct.textContent    = '100%';

        /* update thumbs */
        var all = thumbs.querySelectorAll('.cv-thumb');
        all.forEach(function (b, i) { b.classList.toggle('active', i === curIdx); });
        if (thumbs.children[curIdx]) {
            thumbs.children[curIdx].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    }

    /* ── clamp pan so image can't disappear off-screen ── */
    function clampPan() {
        var maxPan = Math.max(0, (img.offsetWidth  * zoom - stage.offsetWidth)  / 2 + 100);
        var maxPanY = Math.max(0, (img.offsetHeight * zoom - stage.offsetHeight) / 2 + 100);
        panX = Math.max(-maxPan,  Math.min(maxPan,  panX));
        panY = Math.max(-maxPanY, Math.min(maxPanY, panY));
    }

    /* ════════════════════════════════════════════
       PUBLIC API
    ════════════════════════════════════════════ */
    window.CertViewer = {
        open: function (i) {
            loadImage(i, 'sl-center');
            viewer.classList.add('cv-open');
            document.body.style.overflow = 'hidden';
            requestAnimationFrame(function () {
                viewer.classList.add('cv-visible');
            });
        },
        close: function () {
            viewer.classList.remove('cv-visible');
            setTimeout(function () {
                viewer.classList.remove('cv-open');
                document.body.style.overflow = '';
            }, 260);
        },
        navigate: function (dir) {
            loadImage((curIdx + dir + CERTS.length) % CERTS.length,
                      dir > 0 ? 'sl-right' : 'sl-left');
        },
        jumpTo: function (i) {
            if (i === curIdx) return;
            loadImage(i, i > curIdx ? 'sl-right' : 'sl-left');
        },
        zoomBy: function (delta) {
            zoom = Math.min(MAX_Z, Math.max(MIN_Z, zoom + delta));
            if (zoom <= 1) { panX = 0; panY = 0; }
            applyTransform(true);
        },
        resetZoom: function () {
            zoom = 1; panX = 0; panY = 0;
            applyTransform(true);
        }
    };

    /* ════════════════════════════════════════════
       EVENTS
    ════════════════════════════════════════════ */

    /* keyboard */
    document.addEventListener('keydown', function (e) {
        if (!viewer.classList.contains('cv-open')) return;
        if (e.key === 'Escape')     CertViewer.close();
        if (e.key === 'ArrowLeft')  CertViewer.navigate(-1);
        if (e.key === 'ArrowRight') CertViewer.navigate(1);
        if (e.key === '+' || e.key === '=') CertViewer.zoomBy(0.25);
        if (e.key === '-')          CertViewer.zoomBy(-0.25);
        if (e.key === '0')          CertViewer.resetZoom();
    });

    /* mouse wheel — MUST be on stage, passive:false */
    stage.addEventListener('wheel', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var delta = e.deltaY < 0 ? 0.15 : -0.15;
        zoom = Math.min(MAX_Z, Math.max(MIN_Z, zoom + delta));
        if (zoom <= 1) { panX = 0; panY = 0; }
        applyTransform(false);   /* no transition during scroll — feels instant */
    }, { passive: false });

    /* double-click */
    stage.addEventListener('dblclick', function (e) {
        e.preventDefault();
        if (zoom !== 1) {
            zoom = 1; panX = 0; panY = 0;
        } else {
            zoom = 2.5;
        }
        applyTransform(true);
    });

    /* mouse drag */
    stage.addEventListener('mousedown', function (e) {
        if (zoom <= 1) return;
        dragging    = true;
        dragStartX  = e.clientX;
        dragStartY  = e.clientY;
        dragOriginX = panX;
        dragOriginY = panY;
        stage.classList.add('grabbing');
        e.preventDefault();
    });
    window.addEventListener('mousemove', function (e) {
        if (!dragging) return;
        panX = dragOriginX + (e.clientX - dragStartX);
        panY = dragOriginY + (e.clientY - dragStartY);
        clampPan();
        applyTransform(false);
    });
    window.addEventListener('mouseup', function () {
        if (!dragging) return;
        dragging = false;
        stage.classList.remove('grabbing');
    });

    /* touch pinch + drag */
    stage.addEventListener('touchstart', function (e) {
        if (e.touches.length === 2) {
            lastPinch = pDist(e.touches);
        } else if (e.touches.length === 1 && zoom > 1) {
            dragging    = true;
            dragStartX  = e.touches[0].clientX;
            dragStartY  = e.touches[0].clientY;
            dragOriginX = panX;
            dragOriginY = panY;
        }
    }, { passive: true });

    stage.addEventListener('touchmove', function (e) {
        e.preventDefault();
        if (e.touches.length === 2 && lastPinch !== null) {
            var d = pDist(e.touches);
            zoom = Math.min(MAX_Z, Math.max(MIN_Z, zoom * (d / lastPinch)));
            lastPinch = d;
            if (zoom <= 1) { panX = 0; panY = 0; }
            applyTransform(false);
        } else if (e.touches.length === 1 && dragging) {
            panX = dragOriginX + (e.touches[0].clientX - dragStartX);
            panY = dragOriginY + (e.touches[0].clientY - dragStartY);
            clampPan();
            applyTransform(false);
        }
    }, { passive: false });

    stage.addEventListener('touchend', function () {
        lastPinch = null;
        dragging  = false;
        if (zoom <= 1) { panX = 0; panY = 0; }
    });

    function pDist(touches) {
        var dx = touches[0].clientX - touches[1].clientX;
        var dy = touches[0].clientY - touches[1].clientY;
        return Math.sqrt(dx * dx + dy * dy);
    }

}());
</script>

@endsection
