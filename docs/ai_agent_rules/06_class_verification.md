# Class Verification & Tool Usage (MCP Strategy)

## 1. Nguyên tắc "Kiểm tra trước khi dùng"
Tuyệt đối KHÔNG giả định một Class hoặc Method của Filament v4 tồn tại chỉ dựa trên trí nhớ của AI. Vì v4 là bản cập nhật mới, các namespace và tên hàm có thể thay đổi hoàn toàn.

## 2. Quy trình xác minh bắt buộc (Force Verification)
Trước khi viết một Model, Resource hoặc Component liên quan đến Filament, Agent phải thực hiện ít nhất 1 trong các bước sau:
*   **Grep Search:** Sử dụng `grep_search` trong thư mục `vendor/filament` để tìm kiếm namespace chính xác của Class định dùng.
*   **Web Search:** Sử dụng `search_web` với từ khóa `Filament PHP v4 + [tên component]` để cập nhật version mới nhất từ trang chủ `filamentphp.com`.
*   **File View:** Nếu đã cài đặt package, hãy dùng `view_file` để đọc trực tiếp code trong `vendor` nhằm xác nhận các trường dữ liệu hoặc method được hỗ trợ.

## 3. Quản lý Namespace
*   Luôn kiểm tra file `composer.json` để biết chính xác version của Filament đang được cài đặt.
*   Nếu phát hiện sự khác biệt giữa tài liệu (v3) và thực tế cài đặt (v4), Agent phải cảnh báo người dùng và cập nhật lại `ai_agent_rules`.

## 4. Xử lý lỗi Class not found
Nếu gặp lỗi `Class not found` hoặc `Undefined method`, Agent không được phép "đoán" bản sửa lỗi. Phải thực hiện điều tra bằng lệnh:
```powershell
# Tìm kiếm class trong toàn bộ vendor của filament
findstr /s /i /c:"class [ClassName]" vendor\filament\*.php
```
(Hoặc dùng các tool nội bộ tương đương như `grep_search`).

## 5. Sử dụng công cụ như một MCP (Model Context Protocol)
Agent phải coi việc truy cập File System và Web Search là nguồn sự thật duy nhất (Source of Truth), thay vì dựa vào dữ liệu training cũ.
*   **Bước 1:** Xác định nhu cầu (cần dùng Action, Table Column, v.v.)
*   **Bước 2:** Dùng tool để lấy "Schema" hoặc "Code mẫu" từ chính source code của Filament.
*   **Bước 3:** Áp dụng vào dự án.
