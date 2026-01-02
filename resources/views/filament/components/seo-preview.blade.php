<div class="seo-preview-container" style="font-family: arial, sans-serif; background: #fff; border: 1px solid #dfe1e5; border-radius: 8px; padding: 16px; max-width: 600px;">
    <h3 style="color: #202124; font-size: 16px; margin: 0 0 12px 0; font-weight: 400;">Google Search Preview</h3>
    
    <div class="google-result">
        <!-- Breadcrumb / URL Line -->
        <div class="url-line" style="display: flex; align-items: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 4px;">
            <div class="favicon-wrapper" style="margin-right: 12px; background: #f1f3f4; border-radius: 50%; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <img src="{{ setting_url('favicon') ?? asset('favicon.ico') }}" 
                     alt="Favicon" 
                     style="width: 16px; height: 16px; object-fit: contain;"
                     onerror="this.style.display='none'">
            </div>
            <div class="site-info" style="display: flex; flex-direction: column; line-height: 1.3;">
                <span style="font-size: 14px; color: #202124;">{{ $site_name ?? 'Site Name' }}</span>
                <span style="font-size: 12px; color: #4d5156;">{{ url('/') }}</span>
            </div>
        </div>

        <!-- Title -->
        <a href="#" onclick="return false;" style="text-decoration: none;">
            <h3 style="color: #1a0dab; font-size: 20px; line-height: 1.3; font-weight: 400; margin: 0 0 4px 0;">
                {{ $seo_title ?: ($site_name . ' - ' . ($seo_description ? substr($seo_description, 0, 20).'...' : 'Home')) }}
            </h3>
        </a>

        <!-- Description -->
        <div class="description" style="color: #4d5156; font-size: 14px; line-height: 1.58;">
            {{ $seo_description ?? 'This is a preview of how your page might appear in Google search results. Add a meta description to control this text.' }}
        </div>
    </div>
</div>
