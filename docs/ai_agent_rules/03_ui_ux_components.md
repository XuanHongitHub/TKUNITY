# UI/UX Consistency & Component Rules

## 1. Component-First Development
*   Tuyệt đối tránh viết code UI lặp đi lặp lại. Nếu một đoạn UI (ví dụ: Badge trạng thái, SEO Preview) dùng trên 2 lần, hãy tách nó thành **Filament View Component** hoặc **Blade Component**.
*   Vị trí file: `resources/views/components/` cho Blade và `resources/views/filament/components/` cho Filament.

## 2. Design Tokens
*   Sử dụng bảng màu Tailwind mặc định đã được cấu hình trong `tailwind.config.js`.
*   Primary Color của dự án phải được thống nhất qua tất cả các module.

## 3. Micro-interactions
*   Mọi nút bấm phải có trạng thái `loading` (dùng `wire:loading`).
*   Sử dụng `Notification::make()` của Filament để thông báo kết quả thao tác, không dùng `alert()` của browser.

## 4. Layout Standard
*   Tận dụng hệ thống Section, Card, Group của Filament để phân cấp thông tin.
*   Header của các trang phải có `breadcrumbs` rõ ràng.

## 5. Responsive
*   Kiểm tra giao diện Mobile cho mọi Resource. Sử dụng `columnSpan(['default' => 12, 'lg' => 6])` để đảm bảo responsive.
