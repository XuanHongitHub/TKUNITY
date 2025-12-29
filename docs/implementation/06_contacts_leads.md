# Step 6: Contacts, Leads & Notifications

## 1. Lead Management
*   Tạo migration cho bảng `contacts`: `name`, `email`, `phone`, `subject`, `message`, `status`.
*   Filament Resource: Table hiển thị danh sách, Form chỉ cho phép xem và đổi trạng thái (không cho user sửa nội dung gốc của khách).

## 2. Mail System
*   Cài đặt `spatie/laravel-mail-log` (nếu cần quản lý log mail).
*   Tạo các Mailables chuyên nghiệp dùng Markdown hoặc Blade template đẹp.

## 3. Notifications
*   Sử dụng **Filament Notifications** để gửi thông báo real-time cho Admin khi có người điền form contact.
*   Tích hợp gửi tin nhắn qua **Telegram/Slack** (Optional) cho các lead quan trọng.
