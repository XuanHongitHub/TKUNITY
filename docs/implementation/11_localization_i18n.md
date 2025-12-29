# Step 11: Backend Localization & i18n Pro

## 1. Quản lý bản dịch tĩnh (Static Translations)
*   **Mục tiêu:** Dịch các câu chữ như "Gửi ngay", "Đọc thêm", "Tìm thấy 0 kết quả" mà không cần sửa file JSON trong code.
*   **Package:** `kenepa/translation-manager`.
*   **UI:** Một bảng tra cứu từ khóa và ô nhập bản dịch cho từng ngôn ngữ (VN, EN...).

## 2. Nội dung Model đa ngôn ngữ (Translatable Content)
*   **Mục tiêu:** Một bài Blog có thể có cả nội dung tiếng Anh và tiếng Việt.
*   **Kỹ thuật:** Sử dụng `spatie/laravel-translatable`.
*   **UI:** Trong Filament Form, thêm nút chuyển đổi tab ngôn ngữ ngay trên đầu các field (Title, Content).

## 3. Language Switcher
*   Tự động phát hiện ngôn ngữ trình duyệt hoặc cho phép người dùng chọn qua URL (ví dụ: `domain.com/en/...`).
*   Lưu lựa chọn ngôn ngữ vào Session/Cookie.
