# Tasks: Admin Panel Overhaul

## Task 1: Sidebar Navigation Redesign

- [ ] 1.1 Create `resources/views/components/admin/sidebar-group.blade.php` — Alpine.js collapsible group component accepting `title`, `icon`, and `active` props
- [ ] 1.2 Update `resources/views/admin/layouts/admin.blade.php` — replace flat nav links with grouped navigation using sidebar-group components (Catalog, Content, People, Business, System groups)
- [ ] 1.3 Add mobile sidebar toggle — hamburger button in header, Alpine.js overlay sidebar for screens below `lg` breakpoint
- [ ] 1.4 Add active state highlighting — detect current route with `request()->routeIs()` and auto-expand the parent group

## Task 2: Settings Page with API Integrations

- [ ] 2.1 Create `database/seeders/SettingsSeeder.php` — seed default API settings (unsplash_access_key, unsplash_secret_key, pexels_api_key) and SEO settings (meta_title, meta_description, google_analytics_id, facebook_pixel_id) with `group` column
- [ ] 2.2 Run the settings seeder to populate the database
- [ ] 2.3 Update `resources/views/admin/settings/index.blade.php` — convert to tabbed layout (Company, Social Media, API Integrations, SEO) using Alpine.js tabs
- [ ] 2.4 Add API key masking — password-type inputs with eye toggle to reveal values
- [ ] 2.5 Add validation in `SettingController@update` — validate API key fields are non-empty when provided

## Task 3: Product Edit View

- [ ] 3.1 Create `resources/views/admin/products/edit.blade.php` — form pre-populated with `$product` data, matching create form structure with all fields (category, name, slug, descriptions, origin, MOQ, packaging, export capacity, shipment details, shelf life, specifications, is_featured, is_active)
- [ ] 3.2 Add slug auto-generation JavaScript — on name input blur, generate slug if slug field is empty (lowercase, hyphenated, no special chars)
- [ ] 3.3 Add image management section to edit view — grid of current product images with "Set Primary" and "Delete" buttons per image
- [ ] 3.4 Add inline image search panel — search input, source selector (Unsplash/Pexels), results grid with "Download & Attach" button using fetch API to existing ImageManager endpoints
- [ ] 3.5 Add validation error display — show `@error` messages below each field and preserve old input on validation failure

## Task 4: Dashboard Enhancement

- [ ] 4.1 Update `DashboardController@index` — pass aggregate counts (products, categories, blogs, inquiries, newsletters, applications) and recent records (5 latest inquiries, 5 latest blogs)
- [ ] 4.2 Update `resources/views/admin/dashboard/index.blade.php` — add clickable summary cards grid and recent activity tables (inquiries + blogs)

## Task 5: Team Members CRUD

- [ ] 5.1 Create `app/Http/Controllers/Admin/TeamController.php` — resource controller with index, create, store, edit, update, destroy methods; validate name, role, bio, photo, display_order, is_active
- [ ] 5.2 Create `resources/views/admin/team/index.blade.php` — paginated table with name, role, photo thumbnail, display order, actions
- [ ] 5.3 Create `resources/views/admin/team/create.blade.php` — form with all fields including file upload for photo
- [ ] 5.4 Create `resources/views/admin/team/edit.blade.php` — pre-populated form with current photo preview
- [ ] 5.5 Register routes in `routes/admin.php` — `Route::resource('team', TeamController::class)`

## Task 6: Testimonials CRUD

- [ ] 6.1 Create `app/Http/Controllers/Admin/TestimonialController.php` — resource controller; validate author_name, company, quote, photo, rating (1-5), is_active
- [ ] 6.2 Create `resources/views/admin/testimonials/index.blade.php` — paginated table
- [ ] 6.3 Create `resources/views/admin/testimonials/create.blade.php` — form with rating selector
- [ ] 6.4 Create `resources/views/admin/testimonials/edit.blade.php` — pre-populated form
- [ ] 6.5 Register routes in `routes/admin.php` — `Route::resource('testimonials', TestimonialController::class)`

## Task 7: Certificates CRUD

- [ ] 7.1 Create `app/Http/Controllers/Admin/CertificateController.php` — resource controller; validate title, issuer, image, date, display_order
- [ ] 7.2 Create `resources/views/admin/certificates/index.blade.php` — paginated table
- [ ] 7.3 Create `resources/views/admin/certificates/create.blade.php` — form with file upload and date picker
- [ ] 7.4 Create `resources/views/admin/certificates/edit.blade.php` — pre-populated form with current image preview
- [ ] 7.5 Register routes in `routes/admin.php` — `Route::resource('certificates', CertificateController::class)`

## Task 8: Offices CRUD

- [ ] 8.1 Create `app/Http/Controllers/Admin/OfficeController.php` — resource controller; validate city, country, address, phone, email, is_headquarters, display_order
- [ ] 8.2 Create `resources/views/admin/offices/index.blade.php` — paginated table
- [ ] 8.3 Create `resources/views/admin/offices/create.blade.php` — form with is_headquarters checkbox
- [ ] 8.4 Create `resources/views/admin/offices/edit.blade.php` — pre-populated form
- [ ] 8.5 Register routes in `routes/admin.php` — `Route::resource('offices', OfficeController::class)`

## Task 9: Statistics CRUD

- [ ] 9.1 Create `app/Http/Controllers/Admin/StatisticController.php` — resource controller; validate label, value, icon, display_order, is_active
- [ ] 9.2 Create `resources/views/admin/statistics/index.blade.php` — paginated table
- [ ] 9.3 Create `resources/views/admin/statistics/create.blade.php` — form with icon selector
- [ ] 9.4 Create `resources/views/admin/statistics/edit.blade.php` — pre-populated form
- [ ] 9.5 Register routes in `routes/admin.php` — `Route::resource('statistics', StatisticController::class)`

## Task 10: Timeline Entries CRUD

- [ ] 10.1 Create `app/Http/Controllers/Admin/TimelineController.php` — resource controller; validate year, title, description, display_order
- [ ] 10.2 Create `resources/views/admin/timeline/index.blade.php` — paginated table sorted by year
- [ ] 10.3 Create `resources/views/admin/timeline/create.blade.php` — form
- [ ] 10.4 Create `resources/views/admin/timeline/edit.blade.php` — pre-populated form
- [ ] 10.5 Register routes in `routes/admin.php` — `Route::resource('timeline', TimelineController::class)`

## Task 11: Banners CRUD

- [ ] 11.1 Create `app/Http/Controllers/Admin/BannerController.php` — resource controller; validate title, subtitle, image, link, position (hero/page), is_active
- [ ] 11.2 Create `resources/views/admin/banners/index.blade.php` — paginated table with image preview
- [ ] 11.3 Create `resources/views/admin/banners/create.blade.php` — form with file upload and position dropdown
- [ ] 11.4 Create `resources/views/admin/banners/edit.blade.php` — pre-populated form with current image preview
- [ ] 11.5 Register routes in `routes/admin.php` — `Route::resource('banners', BannerController::class)`

## Task 12: Newsletter Subscribers Management

- [ ] 12.1 Create `app/Http/Controllers/Admin/NewsletterController.php` — index method with paginated list, export method generating CSV download
- [ ] 12.2 Create `resources/views/admin/newsletters/index.blade.php` — table with email, subscription date, and "Export CSV" button
- [ ] 12.3 Register routes in `routes/admin.php` — GET `/newsletters` (index) and GET `/newsletters/export` (CSV export)

## Task 13: Reusable UI Components

- [ ] 13.1 Create `resources/views/components/admin/confirm-modal.blade.php` — Alpine.js confirmation dialog that intercepts delete form submissions
- [ ] 13.2 Update all delete buttons across existing and new views to use the confirm-modal component instead of `onclick="return confirm(...)"`

## Task 14: Final Integration and Testing

- [ ] 14.1 Verify all new routes are registered and accessible — run `php artisan route:list --path=admin` and confirm all expected routes exist
- [ ] 14.2 Verify sidebar displays all navigation items and groups expand/collapse correctly
- [ ] 14.3 Verify product edit page loads with pre-populated data and saves updates correctly
- [ ] 14.4 Verify settings page shows all tabs and saves API keys correctly
