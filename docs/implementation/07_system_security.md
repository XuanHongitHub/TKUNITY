# Step 7: System, Backup & Security

## 1. Backup Manager
*   Cài đặt `spatie/laravel-backup`.
*   Tạo giao diện trong Filament để:
    *   Bấm nút Backup ngay lập tức.
    *   Xem danh sách các bản backup cũ.
    *   Tải về hoặc xóa bản backup.

## 2. System Health
*   Cài đặt `spatie/laravel-health`.
*   Thêm các check quan trọng: Database connection, CPU Load, RAM usage, Used Disk Space.
*   Hiển thị Dashboard Widget cảnh báo nếu hệ thống gặp vấn đề.

## 3. Log Viewer
*   Tích hợp `opcodesio/log-viewer`.
*   Tạo link truy cập trực tiếp từ Sidebar của Filament.
*   Thiết kế giao diện dễ đọc, có filter theo ngày và loại lỗi.
