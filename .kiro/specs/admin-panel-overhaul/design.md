# Design Document: Admin Panel Overhaul

## Overview

This design describes the technical approach for overhauling the Surma Agro admin panel. The implementation follows existing Laravel/Blade conventions already established in the project, extending the current admin architecture with grouped navigation, complete CRUD for all entities, a tabbed settings page, and a functional product editor with inline image management.

## Architecture

### Existing Patterns (Preserved)

- **Layout**: `admin.layouts.admin` Blade layout with sidebar + main content area
- **Styling**: Tailwind CSS with custom color tokens (`forest-*`, `warm-*`, `cream`, `earth-*`)
- **Controllers**: Resource controllers in `App\Http\Controllers\Admin`
- **Routes**: Grouped under `admin` prefix with `auth` middleware in `routes/admin.php`
- **Models**: Eloquent models in `App\Models` with fillable arrays and casts

### Component Structure

```
resources/views/admin/
├── layouts/
│   └── admin.blade.php          (modified: grouped sidebar with collapsible nav)
├── components/
│   ├── sidebar-group.blade.php  (new: reusable collapsible nav group)
│   ├── data-table.blade.php     (new: reusable table with search/pagination)
│   ├── form-input.blade.php     (new: reusable form field component)
│   └── confirm-modal.blade.php  (new: reusable delete confirmation dialog)
├── dashboard/
│   └── index.blade.php          (modified: add summary cards + recent activity)
├── products/
│   ├── index.blade.php          (existing)
│   ├── create.blade.php         (existing)
│   └── edit.blade.php           (new: product edit with image management)
├── settings/
│   └── index.blade.php          (modified: tabbed layout with API section)
├── team/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── testimonials/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── certificates/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── offices/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── statistics/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── timeline/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
├── banners/
│   ├── index.blade.php          (new)
│   ├── create.blade.php         (new)
│   └── edit.blade.php           (new)
└── newsletters/
    └── index.blade.php          (new: list + CSV export)
```

### Controllers (New)

```
app/Http/Controllers/Admin/
├── TeamController.php           (new: resource controller)
├── TestimonialController.php    (new: resource controller)
├── CertificateController.php    (new: resource controller)
├── OfficeController.php         (new: resource controller)
├── StatisticController.php      (new: resource controller)
├── TimelineController.php       (new: resource controller)
├── BannerController.php         (new: resource controller)
└── NewsletterController.php     (new: index + export)
```

## Design Details

### 1. Sidebar Navigation Redesign

**Approach**: Replace the flat list of links in `admin.blade.php` with grouped, collapsible sections using Alpine.js (already available via Vite).

**Navigation Groups**:
| Group | Items |
|-------|-------|
| Catalog | Products, Categories |
| Content | Blogs, Gallery, Banners, Timeline |
| People | Team Members, Testimonials, Careers |
| Business | Inquiries, Newsletters, Offices, Certificates, Statistics |
| System | Image Manager, Settings |

**Implementation**:
- Each group uses an Alpine.js `x-data="{ open: true }"` toggle
- Active state detection via `request()->routeIs('admin.products.*')` pattern
- Groups containing the active route auto-expand on page load
- Mobile: hamburger button toggles sidebar overlay with `x-show` transition

### 2. Settings Page — Tabbed with API Integrations

**Approach**: Convert the single-form settings page to a tabbed interface using Alpine.js tabs.

**Tabs**:
1. **Company** — existing company name, email, phone, address fields
2. **Social Media** — existing Facebook, Twitter, LinkedIn, WhatsApp fields
3. **API Integrations** — Unsplash access key, Unsplash secret key, Pexels API key
4. **SEO** — meta title, meta description, Google Analytics ID, Facebook Pixel ID

**Data Model**: Uses existing `Setting` model with `group` column. API settings stored with `group = 'api'`, SEO settings with `group = 'seo'`.

**Security**: API key inputs use `type="password"` by default with a toggle eye icon to reveal. Values are stored in the database (not .env) for admin editability.

### 3. Product Edit View

**Approach**: Create `edit.blade.php` mirroring the create form but pre-populated with existing data, plus an image management section.

**Form Fields** (pre-populated via `$product`):
- Category (select), Name, Slug (with JS auto-generate from name)
- Short Description, Description (textareas)
- Origin, MOQ, Packaging, Export Capacity, Shipment Details, Shelf Life
- Specifications (JSON editor — simple key-value pairs UI)
- Is Featured, Is Active (checkboxes)

**Image Management Section** (below the form):
- Grid display of current product images with primary badge
- "Set as Primary" button per image
- "Delete" button per image (with confirmation)
- "Add Images" button opens an inline search panel:
  - Text input for search query
  - Source selector (Unsplash / Pexels)
  - Results grid with "Download & Attach" button per image
  - Uses existing `ImageManagerController` endpoints via fetch API

**Slug Auto-generation**:
- JavaScript listener on the name input
- On blur (if slug is empty), generates slug: lowercase, replace spaces with hyphens, remove special chars
- Admin can override manually

### 4. Dashboard Enhancement

**Approach**: Modify `DashboardController` to pass aggregate counts and recent records.

**Data passed to view**:
```php
$stats = [
    'products' => Product::count(),
    'categories' => Category::count(),
    'blogs' => Blog::count(),
    'inquiries' => Inquiry::count(),
    'newsletters' => Newsletter::count(),
    'applications' => JobApplication::count(),
];
$recentInquiries = Inquiry::latest()->take(5)->get();
$recentBlogs = Blog::latest()->take(5)->get();
```

**UI**: Summary cards in a responsive grid (3 columns on desktop, 2 on tablet). Each card is clickable, linking to the corresponding index page. Below cards: two-column layout with recent inquiries and recent blogs tables.

### 5. CRUD for Missing Entities

**Pattern**: Each new entity follows the same resource controller pattern:

```php
// Controller pattern (example: TeamController)
class TeamController extends Controller
{
    public function index() { /* paginated list */ }
    public function create() { /* show form */ }
    public function store(Request $request) { /* validate + create */ }
    public function edit(Model $model) { /* show form with data */ }
    public function update(Request $request, Model $model) { /* validate + update */ }
    public function destroy(Model $model) { /* delete + redirect */ }
}
```

**Entity-specific fields**:

| Entity | Fields |
|--------|--------|
| TeamMember | name, role, bio, photo (file upload), display_order, is_active |
| Testimonial | author_name, company, quote, photo, rating (1-5), is_active |
| Certificate | title, issuer, image (file upload), date, display_order |
| Office | city, country, address, phone, email, is_headquarters, display_order |
| Statistic | label, value, icon, display_order, is_active |
| TimelineEntry | year, title, description, display_order |
| Banner | title, subtitle, image (file upload), link, position (enum: hero/page), is_active |
| Newsletter | email, created_at (read-only list + CSV export) |

**File Uploads**: Use Laravel's `Storage::disk('public')` with `store()` method. Images stored in `storage/app/public/{entity}/` directories.

### 6. Consistent UI Components

**Blade Components** (anonymous components in `resources/views/components/admin/`):

- **`<x-admin.data-table>`** — wraps table with search input, column headers, and pagination slot
- **`<x-admin.form-input>`** — label + input with error display, accepts type/name/value/required props
- **`<x-admin.confirm-modal>`** — Alpine.js modal triggered by delete buttons, dispatches form submission on confirm

**Shared Patterns**:
- All list views: header with title + "Create New" button, table, pagination
- All forms: `max-w-2xl` container, consistent spacing, submit + cancel buttons
- Flash messages: already handled in layout via `session('success')`
- Error display: `@error('field')` blocks below each input

### 7. Routes Registration

All new routes added to `routes/admin.php`:

```php
// New resource routes
Route::resource('team', TeamController::class);
Route::resource('testimonials', TestimonialController::class);
Route::resource('certificates', CertificateController::class);
Route::resource('offices', OfficeController::class);
Route::resource('statistics', StatisticController::class);
Route::resource('timeline', TimelineController::class);
Route::resource('banners', BannerController::class);

// Newsletter (read-only + export)
Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
Route::get('/newsletters/export', [NewsletterController::class, 'export'])->name('newsletters.export');
```

### 8. Database Seeding for Settings

Seed default API and SEO settings so the settings page has entries to display:

```php
// database/seeders/SettingsSeeder.php
Setting::firstOrCreate(['key' => 'unsplash_access_key'], ['value' => '', 'group' => 'api']);
Setting::firstOrCreate(['key' => 'unsplash_secret_key'], ['value' => '', 'group' => 'api']);
Setting::firstOrCreate(['key' => 'pexels_api_key'], ['value' => '', 'group' => 'api']);
Setting::firstOrCreate(['key' => 'meta_title'], ['value' => '', 'group' => 'seo']);
Setting::firstOrCreate(['key' => 'meta_description'], ['value' => '', 'group' => 'seo']);
Setting::firstOrCreate(['key' => 'google_analytics_id'], ['value' => '', 'group' => 'seo']);
Setting::firstOrCreate(['key' => 'facebook_pixel_id'], ['value' => '', 'group' => 'seo']);
```

## Dependencies

- **Alpine.js**: Already included via Vite for interactive UI (collapsible nav, tabs, modals)
- **Tailwind CSS**: Already configured with custom theme tokens
- **Laravel Storage**: For file uploads (public disk, already configured)
- No new package dependencies required

## Migration Considerations

- No database migrations needed — all models and tables already exist
- Settings seeder adds default rows for new settings keys
- Existing admin views remain functional during incremental rollout
