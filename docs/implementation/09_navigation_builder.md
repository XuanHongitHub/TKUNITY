# Step 9: Navigation & Menu Builder

## 1. Mục tiêu
Cho phép Admin quản lý các thanh Menu (Header, Footer, Mobile) một cách linh hoạt mà không cần can thiệp vào code.

## 2. Kiến trúc & Package
*   **Package gợi ý:** `biostack/filament-menu-builder` hoặc tự build bằng `filament-forms` (Repeater).
*   **Cấu trúc bảng `menus`:** `name`, `location` (key để gọi ngoài frontend).
*   **Cấu trúc bảng `menu_items`:** `label`, `url`, `type` (internal/external), `parent_id`, `order`, `new_tab` (boolean).

## 3. UI/UX Chức năng
*   **Drag & Drop:** Sử dụng thư viện Reorderable để kéo thả sắp xếp thứ tự và cấp độ menu.
*   **Searchable links:** Khi chọn link nội bộ, cho phép tìm kiếm nhanh theo tiêu đề bài viết (Post) hoặc trang (Page) để tự động lấy URL.
*   **Icon Support:** Cho phép chọn icon (Heroicons) cho từng menu item.

## 4. Frontend Integration
*   Tạo một **View Composer** để luôn cung cấp biến menu cho các Layout Blade.
*   Viết Blade Component `@menu('header')` để render menu theo cấu trúc đa cấp.
