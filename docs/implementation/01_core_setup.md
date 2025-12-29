# Step 1: Core Setup & Foundation

## 1. Cài đặt Framework & Tooling
*   **Database:** Cấu hình file `.env` (MySQL/PostgreSQL).
*   **Filament Installation:**
    ```bash
    composer require filament/filament:"^3.2" -W
    php artisan filament:install --panels
    ```
*   **Tạo tài khoản Admin đầu tiên:**
    ```bash
    php artisan make:filament-user
    ```

## 2. Các Package nòng cốt (Must-have Packages)
*   **Phân quyền:** `spatie/laravel-permission` & `bezhansalleh/filament-shield`.
*   **Media:** `spatie/laravel-medialibrary` & `filament/spatie-laravel-media-library-plugin`.
*   **Settings:** `spatie/laravel-settings` & `outermost/filament-settings`.
*   **Activity Log:** `spatie/laravel-activitylog` & `z3ns/filament-activitylog`.

## 3. Cấu trúc thư mục chuẩn
*   `app/Actions`: Chứa các class xử lý logic nghiệp vụ.
*   `app/Settings`: Chứa các class định nghĩa cài đặt hệ thống.
*   `app/Filament/Resources`: Chứa UI cho Admin.

## 4. Cấu hình chung cho Filament
*   Bật **Dark Mode**.
*   Thiết lập **Brand Logo & Colors**.
*   Cấu hình **Vite** để compile asset cho Admin Panel.
