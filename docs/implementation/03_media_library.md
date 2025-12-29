# Step 3: Media Library (Trái tim của hệ thống)

## 1. Cấu hình Filesystem
*   Setup Disk `public` và `s3` (nếu cần).
*   Cấu hình Media Library: Định dạng ảnh mặc định (WebP), kích thước mặc định (Thumb, Medium, Large).

## 2. Media Resource
*   Tạo Resource để quản lý tập trung toàn bộ file đã upload.
*   **UI Grid View:** Hiển thị ảnh dạng ô như Google Photos.
*   **Meta Data:** Sidebar hiển thị Alt text, Title, URL, Kích thước file.

## 3. Tích hợp vào các Resource khác
*   Tạo Custom Field `SpatieMediaLibraryFileUpload` dùng chung cho toàn dự án.
*   Hỗ trợ kéo thả (Drag & Drop) và tối ưu hóa ảnh tự động ngay khi upload.
