import re

filepath = r'f:\Herd\tkunity\resources\css\app.css'

with open(filepath, 'r', encoding='utf-8', newline='') as f:
    content = f.read()

# 1. Boost Header Z-Index dramatically
content = content.replace('z-index: 1300;', 'z-index: 99999 !important;')

# 2. Synchronize all navigation transitions
# Unified 0.4s cubic-bezier(0.4, 0, 0.2, 1)
content = re.sub(r'transition:\s*all\s*0\.4s\s*cubic-bezier\([^\)]+\);', 
                 'transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);', content)

# 3. Ensure menu-btn is visible whenever menu is open
nav_open_btn = """body.nav-open .menu-btn {
    display: flex !important;
    transform: rotate(180deg);
}"""
content = re.sub(r'body\.nav-open\s+\.menu-btn\s*\{\s*transform:\s*rotate\(180deg\);\s*\}', nav_open_btn, content)

# 4. Make Close button (X) White instead of Red for better visibility
# (The user might find red on black hard to see or think it's part of the background)
old_nav_open_span = """body.nav-open .menu-btn span {
    background: var(--red);
}"""
new_nav_open_span = """body.nav-open .menu-btn span {
    background: #FFFFFF !important;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}"""
content = content.replace(old_nav_open_span, new_nav_open_span)

# 5. Fix any remaining display: none/block conflicts in media queries
content = content.replace('    .menu-btn {\n        display: flex;\n    }', '    .menu-btn {\n        display: flex !important;\n    }')

# 6. Ensure backdrop and nav use visibility: hidden when closed
# (This was partially done but let's be thorough)
content = re.sub(r'\.mobile-nav,\s*\.mobile-nav-backdrop\s*\{\s*opacity:\s*0;\s*visibility:\s*hidden;\s*pointer-events:\s*none;\s*\}', 
                '.mobile-nav,\n.mobile-nav-backdrop {\n    opacity: 0 !important;\n    visibility: hidden !important;\n    pointer-events: none !important;\n    display: block !important; \n}', content)

with open(filepath, 'w', encoding='utf-8', newline='') as f:
    f.write(content)

print("Mobile menu visibility and flash fix v3 (Robust) applied.")
