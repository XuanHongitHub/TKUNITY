# Bepack Laravel - Backend for All
## Tài liệu đặc tả chức năng (Functional Specifications)

Tài liệu này mô tả chi tiết các module và tính năng trong gói **Bepack Laravel**, được thiết kế để làm nền tảng (boilerplate) chuyên nghiệp, linh hoạt và dễ mở rộng cho mọi dự án Web/App.

---

### 1. Kiến trúc tổng thể (Core Architecture)
*   **Framework:** Laravel 11.x
*   **Admin Panel:** Filament PHP v3 (TALL Stack: Tailwind, Alpine.js, Laravel, Livewire).
*   **Design Style:** Modern, Premium, Dark/Light Mode support.
*   **Strategy:** Action-based Logic (Logic được tách rời khỏi UI để dễ dàng scale và tái sử dụng cho API).

---

### 2. Module: Users & Authorization (Quản trị & Phân quyền)
**Mục tiêu:** Quản lý người dùng và cấp quyền chi tiết cho từng thành viên tham gia hệ thống.

*   **Database:**
    *   `users`: `name`, `email`, `password`, `avatar`, `status`, `last_login_at`.
    *   `roles` & `permissions`: Quản lý vai trò (Admin, Editor, User...) và quyền hạn (View, Create, Edit, Delete).
*   **Tính năng chính:**
    *   **User Management:** Danh sách người dùng với bộ lọc theo trạng thái, tìm kiếm nhanh và avatar.
    *   **Role Manager (Filament Shield):** Giao diện cấp quyền trực quan theo từng Resource.
    *   **Profile:** Trang cá nhân cho phép Admin tự đổi thông tin và mật khẩu.
*   **UI/UX:** Dùng Table với Badge màu sắc, hỗ trợ Bulk Action (xóa hàng loạt, đổi trạng thái hàng loạt).

---

### 3. Module: Blogs & Content (Quản trị nội dung)
**Mục tiêu:** Tạo ra một trình soạn thảo nội dung cao cấp, chuẩn SEO cho tin tức, bài viết.

*   **Database:**
    *   `categories`: Danh mục bài viết (hỗ trợ đa cấp).
    *   `posts`: Tiêu đề, Slug (SEO friendly), nội dung (JSON/HTML), thumbnail, tag, trạng thái, ngày đăng.
    *   `tags`: Nhãn phân loại bài viết.
*   **Tính năng chính:**
    *   **Tiptap Editor:** Trình soạn thảo RichText hiện đại, hỗ trợ chèn ảnh/video linh hoạt, output sạch.
    *   **Auto-Slug:** Tự động tạo slug không dấu từ tiêu đề.
    *   **SEO Suite:** Widget chỉnh sửa Meta Title, Description với thanh đo độ dài chuẩn Google.
    *   **Scheduled Post:** Hẹn giờ bài viết tự động hiển thị.
*   **UI/UX:** Bố cục kiểu Gutenberg (Content chính ở giữa, Settings bổ trợ ở Sidebar phải).

---

### 4. Module: Pages (Quản lý trang tĩnh)
**Mục tiêu:** Quản lý các trang như Giới thiệu, Liên hệ, Chính sách bảo mật mà không cần can thiệp code.

*   **Tính năng chính:**
    *   Quản lý danh sách trang tĩnh.
    *   Hỗ trợ chọn Layout/Template khác nhau cho từng trang.
    *   Tích hợp SEO tương tự Module Blogs.

---

### 5. Module: Settings (Cấu hình hệ thống)
**Mục tiêu:** Cung cấp giao diện trực quan để thay đổi mọi cài đặt của website mà không cần sửa file `.env`.

*   **Cấu trúc Tabbed:**
    *   **General:** Tên site, Slogan, Logo (Light/Dark), Favicon.
    *   **SEO:** Default SEO Title, Meta Description, Social OG Image.
    *   **Scripts:** Nơi chèn mã theo dõi (Google Analytics, GTM, FB Pixel) vào Header hoặc Footer.
    *   **Maintenance:** Bật/tắt chế độ bảo trì toàn trang.
*   **Kỹ thuật:** Sử dụng `spatie/laravel-settings` để lưu trữ dữ liệu an toàn và hiệu quả.

---

### 6. Module: Media Library (Thư viện tài nguyên)
**Mục tiêu:** Quản lý tập trung toàn bộ hình ảnh, tài liệu đã upload lên hệ thống.

*   **Tính năng chính:**
    *   **File Manager:** Giao diện lưới (Grid) hiển thị toàn bộ ảnh.
    *   **Automatic Optimization:** Tự động chuyển đổi ảnh sang định dạng WebP/Avif và resize theo các kích thước định sẵn.
    *   **Drag & Drop:** Tải lên nhiều file cùng lúc bằng cách kéo thả.
    *   **Copy Link:** Nút sao chép URL ảnh nhanh để sử dụng ở nơi khác.
*   **Kỹ thuật:** Tích hợp `spatie/laravel-medialibrary`.

---

### 7. Module: Contact & Leads (Quản lý thu thập thông tin)
**Mục tiêu:** Lưu trữ và quản lý các yêu cầu liên hệ từ người dùng ngoài Frontend.

*   **Tính năng chính:**
    *   **Contact Management:** Ghi nhận Họ tên, Email, Số điện thoại và Nội dung tin nhắn.
    *   **Status labels:** Đánh dấu tin nhắn đã được xử lý hay chưa.
    *   **Email Notifications:** Tự động gửi mail thông báo cho Admin khi có liên hệ mới.

---

### 8. Module: System & Security (Hệ thống & Bảo mật)
**Mục tiêu:** Giúp Admin kiểm soát sức khỏe hệ thống và an toàn dữ liệu.

*   **Tính năng chính:**
    *   **Activity Logs:** Lưu lại lịch sử "Ai đã làm gì" trên hệ thống (Sửa bài, Xóa user...).
    *   **Database Backup:** Tự động sao lưu database hàng ngày và cho phép tải về thủ công.
    *   **Health Monitor:** Xem trạng thái CPU, RAM, Disk, Database ngay trên Dashboard.
    *   **Log Viewer:** Xem file lỗi hệ thống chuyên nghiệp trực tiếp từ Admin.

---

### 9. Module: Dashboard (Trung tâm điều khiển)
**Mục tiêu:** Hiển thị cái nhìn tổng quan nhất về tình hình website.

*   **Widgets:**
    *   **Stats:** Tổng số bài viết, người dùng mới, số liên hệ chưa xử lý.
    *   **Charts:** Biểu đồ biểu diễn tăng trưởng nội dung/traffic.
    *   **Latest Activity:** Danh sách các hoạt động mới nhất vừa diễn ra.

---

**Kết luận:** Với gói dự án này, bạn có thể triển khai một website hoàn chỉnh chỉ trong vài giờ và sẵn sàng mở rộng cho bất kỳ tính năng phức tạp nào trong tương lai.
