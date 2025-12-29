# Production Excellence & Error Handling

## 1. Zero-Silent-Failure Policy
*   **Handle All Exceptions:** Tuyệt đối không để xảy ra tình trạng "bấm nút mà không thấy gì". Mọi khối lệnh `try-catch` phải có phần `catch` để xử lý và thông báo lỗi.
*   **Friendly Error Messages:** Không bao giờ hiển thị lỗi raw từ Database (ví dụ: `SQLSTATE[23000]...`). Phải chuyển đổi thành câu thông báo dễ hiểu cho người dùng (ví dụ: "Dữ liệu này đã tồn tại trong hệ thống").

## 2. Real-time Feedback Loop
*   **Success Notifications:** Mọi thao tác thành công (Lưu, Cập nhật, Xóa, Gửi mail) ĐỀU PHẢI có `Notification::make()->success()` hiển thị ngay lập tức.
*   **Warning & Confirmation:** Các thao tác nguy hiểm (Xóa dữ liệu, Ghi đè cấu hình) phải có bước xác nhận (Confirmation Modal) và cảnh báo rõ ràng.
*   **Validation Feedback:** Lỗi validate form phải được hiển thị ngay tại field tương ứng với thông điệp tiếng Việt rõ ràng.

## 3. Loading States & Interaction
*   **No Stuck UI:** Tuyệt đối không để User phải đoán xem hệ thống có đang chạy hay không. 
    *   Sử dụng `wire:loading` trên các nút bấm.
    *   Sử dụng `loading-indicator` của Filament cho các trang tải chậm.
*   **Disabled State:** Vô hiệu hóa nút bấm ngay khi bắt đầu request để tránh tình trạng User bấm liên hục (Double submission).

## 4. Production Readiness
*   **Graceful Degradation:** Nếu một service bên thứ ba (như API Gửi mail, S3) bị sập, hệ thống phải ghi log lỗi và thông báo nhẹ nhàng cho người dùng thay vì văng lỗi 500 trắng trang.
*   **Logging:** Mọi lỗi nghiêm trọng phải được ghi vào `Log::error()` kèm theo Context (User ID, Input dữ liệu) để dễ dàng trace lỗi trong production.
*   **Environment Check:** Luôn kiểm tra sự tồn tại của các key liên quan trong `.env` trước khi sử dụng.

## 5. Clean Up
*   Sau khi thực hiện xong task, Agent phải xóa toàn bộ các file rác, file nháp, hoặc các lệnh `dd()`, `dump()`, `console.log()` đã dùng để debug.
