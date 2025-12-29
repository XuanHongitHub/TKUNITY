# Strict Filament v4 Standards & Conventions

## 1. Phiên bản & Khả năng tương thích
*   Dự án sử dụng **Filament v4**. Tuyệt đối KHÔNG sử dụng các class, method hoặc syntax của v2 (ví dụ: `Filament::registerResources`) hoặc các dự đoán sai về v4.
*   Luôn kiểm tra namespace chính xác: `Filament\Resources`, `Filament\Forms`, `Filament\Tables`.

## 2. Cấu trúc Resource
*   **Schema Separation:** Đối với các Form/Table phức tạp, hãy tách Schema ra các method riêng (ví dụ: `getGeneralFormSchema()`) thay vì nhồi nhét vào `form()`.
*   **Infolists:** Sử dụng `Infolist` cho chế độ View thay vì dùng `disabled form fields`.

## 3. Form & Input Rules
*   Luôn sử dụng `required()` và `unique()` kèm `ignoreRecord: true` khi cần thiết.
*   Sử dụng `placeholder()` cho mọi input để tăng trải nghiệm người dùng.
*   Tận dụng `columnSpan('full')` hoặc `grid()` để tạo form đẹp, không bị lệch.

## 4. Table & Actions
*   Luôn có `searchable()` và `sortable()` cho các cột quan trọng.
*   Sử dụng `BulkActionGroup` để giữ giao diện gọn gàng.
*   Ưu tiên `Action::make()` thay vì viết logic xử lý trực tiếp trong controller.

## 5. Tránh lỗi phổ biến
*   **Lỗi Livewire:** Không bao giờ để Livewire component có nhiều hơn 1 root element.
*   **Namespace:** Luôn import đúng Class thay vì dùng đường dẫn tuyệt đối trong code.
