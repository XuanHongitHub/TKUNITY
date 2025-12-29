# Step 5: Global Settings System

## 1. Kiến trúc Spatie Settings
*   Tạo các class kế thừa `Spatie\LaravelSettings\Settings`.
    *   `GeneralSettings`: Website name, logos, favicon.
    *   `SeoSettings`: Global fallback SEO tags.
    *   `IntegrationsSettings`: Scripts (GTAG, Pixel...), API Keys.

## 2. Filament Settings Page
*   Tạo trang Setting chuyên dụng với giao diện **Tabs**.
*   Sử dụng Field `ColorPicker` cho Brand Colors.
*   Sử dụng Field `FileUpload` cho Logo (tích hợp Media Library).
*   Sử dụng Field `CodeEditor` hoặc `Textarea` cho các đoạn mã JavaScript integration.

## 3. Helper & Blade Directives
*   Tạo helper `setting('key')` để gọi nhanh giá trị từ bất kỳ đâu trong dự án.
*   Tạo Blade Component `@settings('key')` để render script vào Header/Footer.
