# Step 2: Users, Roles & Permissions

## 1. Database Schema
*   Update bảng `users`: Thêm `avatar`, `status`, `last_login_at`.
*   Tích hợp Trait của Spatie Permission vào model `User`.

## 2. Phân quyền với Filament Shield
*   Cài đặt Shield để tự động tạo quyền (Permissions) dựa trên các Resource.
*   Tạo vai trò mặc định: `Super Admin`, `Admin`, `Editor`.
*   Tùy chỉnh Resource `RoleResource` để có UI phân quyền chuyên nghiệp.

## 3. UI/UX User Management
*   **Table:** Hiển thị danh mục User với bộ lọc Avatar, Email, Role, Status.
*   **Form:** Tích hợp field upload Avatar (dùng Spatie Media Library), dropdown chọn Role.
*   **Security:** Thêm tính năng đổi mật khẩu an toàn từ Admin.

## 4. Activity Logs UI
*   Tích hợp trang xem lịch sử hoạt động vào menu User để dễ dàng kiểm tra "Ai đã sửa gì".
