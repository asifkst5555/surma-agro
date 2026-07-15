# Requirements Document

## Introduction

This feature adds inline image management capabilities directly on the product edit page in the admin panel. Currently, administrators must navigate to a separate Image Manager page to manage product images. This feature brings image upload, search/download from Unsplash, library browsing, primary image selection, deletion, and reordering directly into the product edit workflow, reducing context switching and improving productivity.

## Glossary

- **Image_Panel**: The inline image management UI component embedded within the product edit page, built with Alpine.js
- **Upload_Handler**: The server-side controller action responsible for receiving and processing file uploads from the admin's computer
- **Image_Library**: The collection of all previously downloaded/uploaded images stored in the system (ProductImage records)
- **Search_Widget**: The UI component within the Image_Panel that allows searching Unsplash/Pexels for stock images
- **Product_Edit_Page**: The admin view at `resources/views/admin/products/edit.blade.php` where products are edited
- **Primary_Image**: The single ProductImage record marked with `is_primary = true` for a given product, used as the featured display image
- **Image_Grid**: The visual grid display of product images within the Image_Panel showing thumbnails with action overlays

## Requirements

### Requirement 1: Display Current Product Images

**User Story:** As an admin, I want to see all images currently assigned to a product on the edit page, so that I can review the product's visual assets without navigating away.

#### Acceptance Criteria

1. WHEN the Product_Edit_Page loads, THE Image_Panel SHALL display all ProductImage records associated with the current product as a thumbnail grid
2. WHEN a product has a Primary_Image, THE Image_Grid SHALL display a visual badge on the primary image thumbnail to distinguish it from other images
3. WHEN a product has no images assigned, THE Image_Panel SHALL display an empty state message with prompts to upload or search for images
4. THE Image_Grid SHALL display each image thumbnail at a consistent aspect ratio within a responsive grid layout

### Requirement 2: Upload Images from Computer

**User Story:** As an admin, I want to upload images directly from my computer on the product edit page, so that I can add custom product photos without leaving the page.

#### Acceptance Criteria

1. WHEN the admin selects one or more image files via the file input, THE Upload_Handler SHALL accept files with mime types image/jpeg, image/png, image/webp, and image/gif
2. WHEN the admin submits valid image files, THE Upload_Handler SHALL store the images in the configured storage path, generate thumbnails, and create ProductImage records linked to the current product
3. WHEN an upload completes successfully, THE Image_Panel SHALL append the new image thumbnails to the Image_Grid without a full page reload
4. IF the admin submits a file exceeding 5MB, THEN THE Upload_Handler SHALL reject the file and return a validation error message
5. IF the admin submits a file with an unsupported mime type, THEN THE Upload_Handler SHALL reject the file and return a descriptive validation error message
6. WHILE an upload is in progress, THE Image_Panel SHALL display a loading indicator on each file being uploaded

### Requirement 3: Search and Download Images from Unsplash

**User Story:** As an admin, I want to search Unsplash for stock images directly from the product edit page, so that I can find and attach professional product images without leaving the page.

#### Acceptance Criteria

1. WHEN the admin enters a search query and submits, THE Search_Widget SHALL send the query to the existing Unsplash search endpoint and display results as a thumbnail grid without initiating any downloads
2. WHEN the admin clicks a download button on a search result, THE Image_Panel SHALL call the existing download endpoint with the image URL and current product ID
3. WHEN a download completes successfully, THE Image_Panel SHALL add the downloaded image to the Image_Grid without a full page reload
4. WHILE a search request is in progress, THE Search_Widget SHALL display a loading indicator
5. WHILE a download is in progress, THE Image_Panel SHALL display a loading state on the specific image being downloaded
6. IF the Unsplash search returns no results, THEN THE Search_Widget SHALL display a message indicating no images were found for the query

### Requirement 4: Browse and Select from Image Library

**User Story:** As an admin, I want to browse all previously downloaded images in the system and assign them to the current product, so that I can reuse existing images without re-downloading.

#### Acceptance Criteria

1. WHEN the admin opens the library browser, THE Image_Panel SHALL fetch and display all ProductImage records not currently assigned to the product, paginated
2. WHEN the admin selects an image from the Image_Library, THE Image_Panel SHALL call the existing assign endpoint to link the image to the current product
3. WHEN an image is successfully assigned, THE Image_Panel SHALL move the image from the library view to the Image_Grid without a full page reload
4. THE Image_Library browser SHALL support filtering images by type (products, hero, gallery, uploads)

### Requirement 5: Set Primary Image

**User Story:** As an admin, I want to designate one image as the primary image for a product, so that it appears as the featured image on the website.

#### Acceptance Criteria

1. WHEN the admin clicks the "Set Primary" action on a non-primary image, THE Image_Panel SHALL call the existing set-primary endpoint for that image
2. WHEN the set-primary operation succeeds, THE Image_Grid SHALL update the primary badge to reflect the new primary image and remove the badge from the previous primary image without a full page reload
3. THE Image_Grid SHALL display the "Set Primary" action on all non-primary images and hide the action on the image that is already marked as primary

### Requirement 6: Delete Images

**User Story:** As an admin, I want to delete images from a product directly on the edit page, so that I can remove unwanted images without navigating to the Image Manager.

#### Acceptance Criteria

1. WHEN the admin clicks the delete action on an image, THE Image_Panel SHALL display a confirmation prompt before proceeding with the deletion
2. IF the confirmation prompt fails to display, THEN THE Image_Panel SHALL block the deletion entirely
3. WHEN the admin confirms deletion, THE Image_Panel SHALL call the existing destroy endpoint to remove the image record and associated files
4. WHEN deletion succeeds, THE Image_Grid SHALL remove the deleted image thumbnail without a full page reload
5. IF the deleted image was the Primary_Image, THEN THE Image_Panel SHALL indicate that no primary image is set after deletion

### Requirement 7: Reorder Images

**User Story:** As an admin, I want to reorder product images by dragging them, so that I can control the display order on the website.

#### Acceptance Criteria

1. WHEN the admin drags an image thumbnail to a new position in the Image_Grid, THE Image_Panel SHALL visually update the grid to reflect the new order
2. WHEN the admin completes a drag-and-drop reorder, THE Image_Panel SHALL send the new order to the server to persist the sort positions
3. THE Image_Grid SHALL provide a visible drag handle or cursor indicator on each image thumbnail to signal that reordering is available

### Requirement 8: Tabbed Interface Organization

**User Story:** As an admin, I want the image management features organized in tabs, so that the interface remains clean and I can quickly switch between uploading, searching, and browsing.

#### Acceptance Criteria

1. THE Image_Panel SHALL organize image management actions into distinct tabs: Current Images, Upload, Search Unsplash, and Image Library
2. WHEN the admin clicks a tab, THE Image_Panel SHALL display the corresponding content panel and hide all other panels, ensuring exactly one panel is visible at a time
3. WHEN the Product_Edit_Page loads, THE Image_Panel SHALL default to showing the Current Images tab
