# Error Prevention & Blacklist (DO NOT DO)

## 1. Lỗi logic & Framework
*   **N+1 Query:** Tuyệt đối không gọi query database bên trong vòng lặp hoặc trong method `Label` của Filament Table. Dùng `with()` hoặc `RelationshipQueries`.
*   **Mass Assignment:** Tuyệt đối không dùng `$guarded = []`. Hãy liệt kê rõ `$fillable`.
*   **Hardcoded Values:** Không để các giá trị fix cứng (như URL, API Key) trong code. Hãy dùng `.env` hoặc hệ thống Settings.

## 2. Lỗi Filament/Livewire đặc thù
*   **Z-index issues:** Cẩn thận với các modal và dropdown chồng chéo nhau.
*   **State Hydration:** Không lưu các object quá lớn vào `state` của Livewire, chỉ lưu ID hoặc Array.
*   **JS Conflicts:** Hạn chế dùng thư viện JS ngoài trực tiếp vào Blade mà không thông qua Alpine.js hoặc Filament Asset Manager.

## 3. Lỗi "Lặp lại 2 lần" - Tuyệt đối tránh
1.  Quên `php artisan storage:link` dẫn đến không hiện ảnh.
2.  Quên `namespace` khi tạo Model/Action mới thủ công.
3.  Để lộ file nhạy cảm trong `.gitignore`.
4.  Viết logic business (như tính toán tiền, gửi mail) trực tiếp trong file View/Blade.

## 4. Critical Checks trước khi kết thúc task
*   Code có chạy được không? (Syntax Check).
*   Có làm hỏng tính năng cũ không? (Regression Check).
*   Có đúng chuẩn UI/UX đã đề ra không?
