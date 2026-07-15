<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NewsletterController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::post('products/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('products.upload-images');
    Route::resource('categories', CategoryController::class);

    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/read', [InquiryController::class, 'markRead'])->name('inquiries.mark-read');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::resource('blogs', BlogController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('careers', CareerController::class);
    Route::get('/careers/{career}/applications', [CareerController::class, 'applications'])->name('careers.applications');

    // New CRUD resources
    Route::resource('team', TeamController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('offices', OfficeController::class);
    Route::resource('statistics', StatisticController::class);
    Route::resource('timeline', TimelineController::class);
    Route::resource('banners', BannerController::class);

    // Newsletters (read-only + export)
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::get('/newsletters/export', [NewsletterController::class, 'export'])->name('newsletters.export');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::prefix('ai-settings')->name('ai-settings.')->group(function () {
        Route::get('/api-connection', [\App\Http\Controllers\Admin\AiSettingController::class, 'apiConnection'])->name('api-connection');
        Route::put('/api-connection', [\App\Http\Controllers\Admin\AiSettingController::class, 'updateApiConnection'])->name('update-api-connection');
        Route::get('/chat-appearance', [\App\Http\Controllers\Admin\AiSettingController::class, 'chatAppearance'])->name('chat-appearance');
        Route::put('/chat-appearance', [\App\Http\Controllers\Admin\AiSettingController::class, 'updateChatAppearance'])->name('update-chat-appearance');
        Route::get('/response-behavior', [\App\Http\Controllers\Admin\AiSettingController::class, 'responseBehavior'])->name('response-behavior');
        Route::put('/response-behavior', [\App\Http\Controllers\Admin\AiSettingController::class, 'updateResponseBehavior'])->name('update-response-behavior');
        Route::get('/content-rules', [\App\Http\Controllers\Admin\AiSettingController::class, 'contentRules'])->name('content-rules');
        Route::put('/content-rules', [\App\Http\Controllers\Admin\AiSettingController::class, 'updateContentRules'])->name('update-content-rules');
        Route::get('/custom-prompts', [\App\Http\Controllers\Admin\AiSettingController::class, 'customPrompts'])->name('custom-prompts');
        Route::put('/custom-prompts', [\App\Http\Controllers\Admin\AiSettingController::class, 'updateCustomPrompts'])->name('update-custom-prompts');
    });

    Route::prefix('image-manager')->name('image-manager.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ImageManagerController::class, 'index'])->name('index');
        Route::get('/gallery', [\App\Http\Controllers\Admin\ImageManagerController::class, 'gallery'])->name('gallery');
        Route::get('/history', [\App\Http\Controllers\Admin\ImageManagerController::class, 'history'])->name('history');
        Route::get('/search', [\App\Http\Controllers\Admin\ImageManagerController::class, 'search'])->name('search');
        Route::post('/download', [\App\Http\Controllers\Admin\ImageManagerController::class, 'download'])->name('download');
        Route::post('/assign', [\App\Http\Controllers\Admin\ImageManagerController::class, 'assign'])->name('assign');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ImageManagerController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [\App\Http\Controllers\Admin\ImageManagerController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/set-primary/{id}', [\App\Http\Controllers\Admin\ImageManagerController::class, 'setPrimary'])->name('set-primary');
        Route::get('/product/{product}/images', [\App\Http\Controllers\Admin\ImageManagerController::class, 'productImages'])->name('product-images');
        Route::post('/product/{product}/collect', [\App\Http\Controllers\Admin\ImageManagerController::class, 'collectForProduct'])->name('collect');
        Route::get('/product/{product}/suggest', [\App\Http\Controllers\Admin\ImageManagerController::class, 'suggestForProduct'])->name('suggest');
    });
});
