# Step 9: Navigation & Menu

## Current Implementation

Navigation is managed through hardcoded Blade components with support for dynamic site settings:

### Components
- **`<x-site-header />`** - Shared header component with two variants:
  - `landing` - Full navigation with mega menu dropdown
  - `default` - Standard navigation for inner pages
- **`<x-site-footer />`** - Shared footer component

### Configuration
Navigation items are defined in `resources/views/components/site-header.blade.php`:

```blade
$navItems = [
    ['label' => 'Home', 'url' => route('home'), 'target' => '_self', 'active' => request()->routeIs('home')],
    ['label' => 'Games', 'url' => '#games', 'target' => '_self', 'active' => false],
    ['label' => 'About', 'url' => route('about'), 'target' => '_self', 'active' => request()->routeIs('about')],
    ['label' => 'News', 'url' => route('news.index'), 'target' => '_self', 'active' => request()->routeIs('news.index', 'news.show')],
    ['label' => 'Contact', 'url' => route('contact'), 'target' => '_self', 'active' => request()->routeIs('contact')],
];
```

### Usage in Pages
Pages specify which navigation variant to use:
```blade
@section('nav_variant', 'landing')  <!-- or 'default' -->
```

### Dynamic Elements
- Site name from `setting('site_name')`
- Logo from `setting_url('site_logo')`
- Hero banner from `setting_url('hero_banner')`
- Theme color from `setting('theme_color')`

## Future Enhancement
For dynamic menu management without coding, consider implementing:
- Filament-based navigation admin panel
- Drag-and-drop reordering
- Mega menu configuration
- Multi-level menu support
