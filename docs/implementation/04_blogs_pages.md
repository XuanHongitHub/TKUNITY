# Step 4: Blogs & Pages (Content Engine)

## 1. Database & Models
*   `Category`: Hỗ trợ nested sets (đa cấp).
*   `Post`: Tích hợp Spatie Sluggable (auto-slug) và Spatie Media Library (thumbnail).
*   `Page`: Tương tự Post nhưng có thêm field `layout_type`.

## 2. Tiptap RichText Editor
*   Cài đặt plugin Tiptap cho Filament.
*   Cấu hình Toolbar: Bold, Italic, Heading, Image, Video, Code Block, Table.
*   Custom Blocks: Cho phép chèn các component đặc thù (Banner, CTA, Product Highlight).

## 3. SEO Suite
*   Tạo một **View Component** dùng chung cho Blogs và Pages.
*   Fields: Meta Title, Meta Description, Keywords, Social Image.
*   **Real-time Preview:** Hiển thị snippet giả lập Google Search kết quả khi đang nhập liệu.

## 4. Quản lý Trạng thái
*   Sử dụng Enum cho `PostStatus` (Draft, Published, Scheduled).
*   Tích hợp bộ chọn ngày giờ (DateTimePicker) cho `published_at`.
