<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\PresenceController;
use App\Http\Controllers\Public\CertificateController;
use App\Http\Controllers\Public\TimelineController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\TermsController;
use App\Http\Controllers\Public\FactoryController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\CareerController;
use App\Http\Controllers\Public\ExportQualityController;
use App\Http\Controllers\Public\NewsletterController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team', [AboutController::class, 'team'])->name('team');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/load-more/{category}', [CatalogController::class, 'loadMore'])->name('catalog.loadMore');
Route::get('/catalog/{category}', [CatalogController::class, 'category'])->name('catalog.category');
Route::get('/catalog/{category}/{product}', [CatalogController::class, 'product'])->name('catalog.product');
Route::post('/catalog/inquiry/{product}', [CatalogController::class, 'inquiry'])->name('catalog.product.inquiry');

Route::get('/factory', [FactoryController::class, 'index'])->name('factory');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/export-quality', [ExportQualityController::class, 'index'])->name('export-quality');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');
Route::post('/careers/{slug}/apply', [CareerController::class, 'apply'])->name('careers.apply');

Route::get('/presence', [PresenceController::class, 'index'])->name('presence');
Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline');

Route::get('/surma-fish', [CatalogController::class, 'surmaFish'])->name('surma-fish');
Route::get('/change-box', [CatalogController::class, 'changeBox'])->name('change-box');

Route::get('/terms', [TermsController::class, 'index'])->name('terms');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'priority' => '1.0'],
        ['loc' => route('about'), 'priority' => '0.9'],
        ['loc' => route('team'), 'priority' => '0.8'],
        ['loc' => route('catalog.index'), 'priority' => '0.9'],
        ['loc' => route('factory'), 'priority' => '0.8'],
        ['loc' => route('gallery'), 'priority' => '0.7'],
        ['loc' => route('blog.index'), 'priority' => '0.8'],
        ['loc' => route('careers.index'), 'priority' => '0.7'],
        ['loc' => route('export-quality'), 'priority' => '0.8'],
        ['loc' => route('presence'), 'priority' => '0.7'],
        ['loc' => route('certificates'), 'priority' => '0.7'],
        ['loc' => route('timeline'), 'priority' => '0.7'],
        ['loc' => route('surma-fish'), 'priority' => '0.8'],
        ['loc' => route('change-box'), 'priority' => '0.8'],
        ['loc' => route('terms'), 'priority' => '0.5'],
        ['loc' => route('contact'), 'priority' => '0.8'],
    ];
    return response()->view('partials.sitemap', compact('urls'))->header('Content-Type', 'application/xml');
});

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
    return response($content)->header('Content-Type', 'text/plain');
});

Route::get('/debug/ai', function () {
    $results = [];

    // 1. Check DB settings
    $results['api_key_in_db'] = \App\Models\Setting::getValue('ai_openai_api_key', 'NOT FOUND');
    $results['base_url'] = \App\Models\Setting::getValue('ai_openai_base_url', 'NOT FOUND');
    $results['model'] = \App\Models\Setting::getValue('ai_openai_model', 'NOT FOUND');

    // 2. Check PHP environment
    $results['curl_enabled'] = function_exists('curl_version');
    $results['curl_version'] = $results['curl_enabled'] ? curl_version()['version'] : 'N/A';
    $results['php_version'] = phpversion();
    $results['allow_url_fopen'] = ini_get('allow_url_fopen');
    $results['disabled_functions'] = ini_get('disable_functions');

    // 3. DNS check
    $host = parse_url($results['base_url'], PHP_URL_HOST) ?: 'api.groq.com';
    $dns = dns_get_record($host, DNS_A) ?: [];
    $results['dns_records'] = array_map(fn($r) => $r['ip'] ?? '?', $dns);

    // 4. Test cURL connection to Groq
    if ($results['curl_enabled']) {
        $apiKey = \App\Models\Setting::getValue('ai_openai_api_key', '');
        $ch = curl_init("{$results['base_url']}/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'model' => $results['model'],
                'messages' => [['role' => 'user', 'content' => 'Say "OK" and nothing else.']],
                'max_tokens' => 10,
            ]),
        ]);
        $output = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $results['curl_http_code'] = $httpCode;
        $results['curl_error'] = $curlError ?: 'none';
        $results['curl_response'] = $output ? json_decode($output, true) : 'EMPTY';
    } else {
        $results['curl_error'] = 'cURL is DISABLED on this server';
    }

    // 5. Test Laravel Http facade (same method the chatbot uses)
    $results['laravel_http_test'] = 'SKIPPED (run separate)';

    return response()->json($results, 200, ['Content-Type' => 'application/json']);
})->name('debug.ai');

require __DIR__.'/auth.php';
