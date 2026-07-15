# Requirements Document

## Introduction

This document defines the requirements for a complete overhaul of the Surma Agro admin panel. The current admin panel has several issues: missing sidebar navigation items, incomplete settings page (only shows company info and social media, missing API integration settings), a broken product edit flow (missing edit view), and poor overall organization. The overhaul will deliver a well-organized, fully functional admin panel that covers all content entities in the system.

## Glossary

- **Admin_Panel**: The authenticated administrative interface for managing all Surma Agro website content and settings
- **Sidebar**: The left-side navigation component within the Admin_Panel that provides access to all management sections
- **Settings_Page**: The admin page for managing application configuration including company info, social media, and API integrations
- **Product_Editor**: The admin interface for creating and editing product records including all fields and image management
- **Dashboard**: The landing page of the Admin_Panel showing key metrics and recent activity
- **Content_Entity**: Any manageable data type in the system (Products, Categories, Blogs, Gallery, Careers, Team Members, Testimonials, Certificates, Offices, Statistics, Timeline, Banners, Newsletter Subscribers, Inquiries)
- **Navigation_Group**: A logical grouping of related sidebar menu items under a collapsible section header
- **API_Settings**: Configuration values for third-party image service integrations (Unsplash, Pexels, and future providers)

## Requirements

### Requirement 1: Complete Sidebar Navigation

**User Story:** As an admin, I want to see all management sections in the sidebar, so that I can access every content entity without needing to know URLs.

#### Acceptance Criteria

1. THE Sidebar SHALL display navigation links for all Content_Entities: Products, Categories, Blogs, Gallery, Careers, Team Members, Testimonials, Certificates, Offices, Statistics, Timeline Entries, Banners, Newsletter Subscribers, and Inquiries
2. THE Sidebar SHALL organize navigation links into Navigation_Groups: "Catalog" (Products, Categories), "Content" (Blogs, Gallery, Banners, Timeline), "People" (Team Members, Testimonials, Careers), "Business" (Inquiries, Newsletter Subscribers, Offices, Certificates, Statistics), and "System" (Image Manager, Settings)
3. WHEN a Navigation_Group header is clicked, THE Sidebar SHALL expand or collapse the group's child links
4. THE Sidebar SHALL visually highlight the currently active navigation link and its parent Navigation_Group
5. THE Sidebar SHALL remain accessible on mobile devices via a toggle button visible in the header

### Requirement 2: Complete Settings Page with API Integrations

**User Story:** As an admin, I want to manage all application settings including API keys for image services, so that I can configure integrations without editing environment files.

#### Acceptance Criteria

1. THE Settings_Page SHALL display settings organized into tabbed sections: "Company", "Social Media", "API Integrations", and "SEO"
2. THE Settings_Page SHALL display configuration fields for Unsplash API (access key, secret key) within the "API Integrations" tab
3. THE Settings_Page SHALL display configuration fields for Pexels API (API key) within the "API Integrations" tab
4. WHEN a new API integration is added to the system, THE Settings_Page SHALL accommodate additional API configuration fields within the "API Integrations" tab without code changes by reading settings from the database grouped by their group attribute
5. WHEN the admin submits the settings form, THE Settings_Page SHALL validate required API key fields are non-empty before saving
6. THE Settings_Page SHALL mask API key values by default and provide a toggle to reveal them
7. THE Settings_Page SHALL include an "SEO" tab with fields for meta title, meta description, Google Analytics ID, and Facebook Pixel ID

### Requirement 3: Functional Product Edit

**User Story:** As an admin, I want to edit existing products with all their fields and images, so that I can keep product information up to date.

#### Acceptance Criteria

1. WHEN the admin navigates to the product edit page, THE Product_Editor SHALL pre-populate all form fields with the existing product data including category, name, slug, descriptions, origin, MOQ, packaging, export capacity, shipment details, shelf life, and specifications
2. WHEN the admin submits the product edit form, THE Product_Editor SHALL validate all fields using the same rules as product creation, excluding the current product from slug uniqueness checks
3. WHEN the admin submits valid product data, THE Product_Editor SHALL update the product record and redirect to the products list with a success message
4. THE Product_Editor SHALL display the product's current images with options to set a primary image, delete images, and add new images via the Image Manager
5. IF the product edit form submission fails validation, THEN THE Product_Editor SHALL redisplay the form with validation errors and preserve the previously entered data
6. THE Product_Editor SHALL provide a slug auto-generation feature that creates a URL-friendly slug from the product name

### Requirement 4: Organized Admin Dashboard

**User Story:** As an admin, I want a dashboard that gives me a quick overview of the site's content and recent activity, so that I can understand the current state at a glance.

#### Acceptance Criteria

1. THE Dashboard SHALL display summary cards showing total counts for Products, Categories, Blog Posts, Inquiries, Newsletter Subscribers, and Job Applications
2. THE Dashboard SHALL display a list of the 5 most recent inquiries with customer name, product, and date
3. THE Dashboard SHALL display a list of the 5 most recent blog posts with title, status, and publish date
4. WHEN a summary card is clicked, THE Dashboard SHALL navigate to the corresponding management section

### Requirement 5: CRUD for Missing Content Entities

**User Story:** As an admin, I want full create, read, update, and delete functionality for all content entities, so that I can manage the entire website from the admin panel.

#### Acceptance Criteria

1. THE Admin_Panel SHALL provide list, create, edit, and delete views for Team Members (name, role, bio, photo, display order)
2. THE Admin_Panel SHALL provide list, create, edit, and delete views for Testimonials (author name, company, quote, photo, rating)
3. THE Admin_Panel SHALL provide list, create, edit, and delete views for Certificates (title, issuer, image, date)
4. THE Admin_Panel SHALL provide list, create, edit, and delete views for Offices (city, country, address, phone, email, is_headquarters flag)
5. THE Admin_Panel SHALL provide list, create, edit, and delete views for Statistics (label, value, icon, display order)
6. THE Admin_Panel SHALL provide list, create, edit, and delete views for Timeline Entries (year, title, description, display order)
7. THE Admin_Panel SHALL provide list, create, edit, and delete views for Banners (title, subtitle, image, link, position, is_active flag)
8. THE Admin_Panel SHALL provide a list view for Newsletter Subscribers with email, subscription date, and an option to export as CSV
9. WHEN the admin deletes a Content_Entity record, THE Admin_Panel SHALL display a confirmation dialog before executing the deletion

### Requirement 6: Consistent UI and Layout

**User Story:** As an admin, I want a consistent, clean interface across all admin pages, so that the panel is easy to learn and use.

#### Acceptance Criteria

1. THE Admin_Panel SHALL use a consistent page layout with a page title, optional action buttons (e.g., "Create New"), and a content area across all management sections
2. THE Admin_Panel SHALL use consistent table styling for all list views with sortable columns, pagination, and a search/filter input
3. THE Admin_Panel SHALL use consistent form styling for all create and edit views with labeled inputs, validation error display, and submit/cancel buttons
4. WHEN a form action completes successfully, THE Admin_Panel SHALL display a flash notification with the success message
5. IF a server error occurs during a form submission, THEN THE Admin_Panel SHALL display an error notification without losing the entered form data
6. THE Admin_Panel SHALL be responsive and usable on tablet-sized screens (768px width and above)

### Requirement 7: Product Image Management within Product Editor

**User Story:** As an admin, I want to manage product images directly from the product edit page, so that I do not need to navigate to a separate tool to associate images.

#### Acceptance Criteria

1. THE Product_Editor SHALL display a dedicated image management section showing all images currently associated with the product
2. WHEN the admin clicks "Add Images", THE Product_Editor SHALL open an inline interface to search and download images from configured API sources (Unsplash, Pexels)
3. WHEN an image is downloaded and associated with a product, THE Product_Editor SHALL display the new image in the image management section without a full page reload
4. WHEN the admin marks an image as primary, THE Product_Editor SHALL unset the previous primary image and set the selected image as primary
5. WHEN the admin deletes a product image, THE Product_Editor SHALL remove the image file from storage and the database record after confirmation
