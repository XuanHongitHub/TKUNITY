
import re

file_path = r'F:\Herd\tkunity\public\css\filament\admin.css'

new_css = """/* TKUnity Admin theme overrides - shared across Filament panels */

/* Global Variables (Default / Light Mode can define their own if needed) */
:root {
    --tk-admin-red: #e31837;
    --tk-admin-red-dark: #b01428;
    --tk-admin-ink: #0d0d0d;
    --tk-admin-surface: #141414;
    --tk-admin-surface-alt: #1a1a1a;
    --tk-admin-border: rgba(255, 255, 255, 0.08);
    --tk-admin-border-strong: rgba(255, 255, 255, 0.16);
    --tk-admin-muted: #9ca3af;
    --tk-admin-text: #f5f5f5;
    --tk-admin-text-strong: #ffffff;
    --tk-admin-input-bg: #0f0f0f;
    --fi-sidebar-width: 16rem;
}

/* Global Font - Applied everywhere */
body, .fi-body {
    font-family: 'Source Sans 3', system-ui, sans-serif !important;
}

/* Dark Mode Overrides */
html.dark body,
html.dark .fi-body {
    background: var(--tk-admin-ink);
    color: var(--tk-admin-text);
}

html.dark .fi-main,
html.dark .fi-main-ctn,
html.dark .fi-page {
    background: var(--tk-admin-ink) !important;
    color: var(--tk-admin-text);
}

html.dark .fi-topbar-title,
html.dark .fi-section-header-heading,
html.dark .fi-header-heading,
html.dark .fi-modal-heading,
html.dark .fi-ta-header-heading {
    font-family: 'Oswald', 'Arial Narrow', sans-serif !important;
    letter-spacing: 0.02em;
}

html.dark .fi-topbar-ctn { background: var(--tk-admin-ink); }

html.dark .fi-topbar {
    background: var(--tk-admin-ink) !important;
    border-bottom: 1px solid var(--tk-admin-border) !important;
    box-shadow: none !important;
}

html.dark .fi-topbar-item-btn { border-radius: 2px !important; }
html.dark .fi-topbar-item-label { color: var(--tk-admin-muted) !important; }
html.dark .fi-topbar-item.fi-active .fi-topbar-item-label { color: var(--tk-admin-red) !important; }

html.dark .fi-sidebar {
    background: #0b0b0b !important;
    border-right: 1px solid var(--tk-admin-border) !important;
}

html.dark .fi-sidebar-item-btn { border-radius: 2px !important; }

html.dark .fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
    background: rgba(227, 24, 55, 0.18) !important;
}

html.dark .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-label {
    color: var(--tk-admin-text-strong) !important;
}

html.dark .fi-sidebar-item.fi-active > .fi-sidebar-item-btn > .fi-icon {
    color: var(--tk-admin-red) !important;
}

html.dark .fi-sidebar-item-btn:hover,
html.dark .fi-sidebar-item.fi-sidebar-item-has-url > .fi-sidebar-item-btn:hover {
    background: var(--tk-admin-surface-alt) !important;
}

html.dark .fi-sidebar-item-label { color: var(--tk-admin-muted) !important; }

html.dark .fi-btn,
html.dark .fi-btn-primary,
html.dark .fi-btn-secondary,
html.dark .fi-card,
html.dark .fi-section,
html.dark .fi-input-wrp,
html.dark .fi-select-input,
html.dark .fi-fo-rich-editor,
html.dark .fi-fo-textarea,
html.dark .fi-ta-ctn,
html.dark .fi-modal-window {
    border-radius: 2px !important;
    box-shadow: none !important;
}

html.dark .fi-btn-primary { background-color: var(--tk-admin-red) !important; }
html.dark .fi-btn-primary:hover { background-color: var(--tk-admin-red-dark) !important; }

html.dark .fi-section,
html.dark .fi-card,
html.dark .fi-ta-ctn,
html.dark .fi-modal-window {
    background: var(--tk-admin-surface) !important;
    border: 1px solid var(--tk-admin-border) !important;
}

html.dark .fi-section-header {
    background: var(--tk-admin-surface-alt) !important;
    border-bottom: 1px solid var(--tk-admin-border) !important;
}

html.dark .fi-section-header-description { color: var(--tk-admin-muted) !important; }

html.dark .fi-fo-field-label-content {
    color: var(--tk-admin-muted) !important;
    font-size: 0.75rem !important;
    text-transform: uppercase;
    letter-spacing: 0.12em;
}

html.dark .fi-fo-field-label-required-mark { color: var(--tk-admin-red) !important; }

html.dark .fi-input-wrp,
html.dark .fi-select-input,
html.dark .fi-fo-rich-editor,
html.dark .fi-fo-textarea {
    background: var(--tk-admin-input-bg) !important;
    border: 1px solid var(--tk-admin-border-strong) !important;
}

html.dark .fi-input,
html.dark .fi-fo-textarea textarea,
html.dark .fi-select-input select,
html.dark .fi-select-input input {
    color: var(--tk-admin-text) !important;
}

html.dark .fi-input::placeholder,
html.dark .fi-fo-textarea textarea::placeholder,
html.dark .fi-select-input input::placeholder {
    color: var(--tk-admin-muted) !important;
}

html.dark .fi-fo-field-wrp-error-message,
html.dark .fi-fo-field-wrp-error-list {
    color: #f87171 !important;
}

html.dark .fi-input-wrp-prefix .fi-icon,
html.dark .fi-input-wrp-suffix .fi-icon,
html.dark .fi-input-wrp-label {
    color: var(--tk-admin-muted) !important;
}

html.dark .fi-input-wrp:focus-within,
html.dark .fi-select-input:focus-within,
html.dark .fi-fo-rich-editor:focus-within,
html.dark .fi-fo-textarea:focus-within {
    border-color: var(--tk-admin-red) !important;
}

html.dark .fi-fo-rich-editor .trix-editor {
    background: var(--tk-admin-input-bg) !important;
    color: var(--tk-admin-text) !important;
}

html.dark .fi-fo-rich-editor .trix-toolbar {
    background: var(--tk-admin-surface-alt) !important;
    border-bottom: 1px solid var(--tk-admin-border) !important;
}

html.dark .fi-fo-tags-input-tags-ctn { border-top: 1px solid var(--tk-admin-border) !important; }

html.dark .fi-checkbox-input {
    background: var(--tk-admin-input-bg) !important;
    border-color: var(--tk-admin-border-strong) !important;
    border-radius: 2px !important;
}

html.dark .fi-checkbox-input:checked {
    background-color: var(--tk-admin-red) !important;
    border-color: var(--tk-admin-red) !important;
}

html.dark .fi-toggle { border-radius: 999px !important; }

html.dark .fi-fo-file-upload .filepond--root {
    background: var(--tk-admin-input-bg) !important;
    border: 1px solid var(--tk-admin-border-strong) !important;
    border-radius: 2px !important;
    box-shadow: none !important;
}

html.dark .fi-fo-file-upload .filepond--drop-label label { color: var(--tk-admin-muted) !important; }
html.dark .fi-fo-file-upload .filepond--item,
html.dark .fi-fo-file-upload .filepond--item-panel { border-radius: 2px !important; }

html.dark .fi-fo-file-upload:not(.fi-fo-file-upload-avatar) .filepond--image-preview-wrapper,
html.dark .fi-fo-file-upload:not(.fi-fo-file-upload-avatar) .filepond--image-preview,
html.dark .fi-fo-file-upload:not(.fi-fo-file-upload-avatar) .filepond--file {
    height: 140px !important;
}

html.dark .fi-select-input .fi-select-input-btn {
    background: var(--tk-admin-input-bg) !important;
    border: 1px solid var(--tk-admin-border-strong) !important;
    color: var(--tk-admin-text) !important;
    border-radius: 2px !important;
}

html.dark .fi-select-input .fi-select-input-placeholder,
html.dark .fi-select-input .fi-select-input-message,
html.dark .fi-select-input .fi-select-input-option-group .fi-dropdown-header {
    color: var(--tk-admin-muted) !important;
}

html.dark .fi-select-input .fi-select-input-search-ctn { background: var(--tk-admin-surface-alt) !important; }

html.dark .fi-dropdown-panel,
html.dark .fi-select-input .fi-dropdown-panel {
    background: var(--tk-admin-surface) !important;
    border: 1px solid var(--tk-admin-border) !important;
    box-shadow: none !important;
}

html.dark .fi-dropdown-list-item { color: var(--tk-admin-text) !important; }

html.dark .fi-dropdown-list-item:hover,
html.dark .fi-dropdown-list-item[aria-selected='true'] {
    background: var(--tk-admin-surface-alt) !important;
}

html.dark .fi-ta-ctn,
html.dark .fi-ta-content,
html.dark .fi-ta-table,
html.dark .fi-ta-empty-state {
    background: var(--tk-admin-surface) !important;
    border-color: var(--tk-admin-border) !important;
}

html.dark .fi-ta-header,
html.dark .fi-ta-header-ctn,
html.dark .fi-ta-content-header {
    background: var(--tk-admin-surface-alt) !important;
    border-color: var(--tk-admin-border) !important;
}

html.dark .fi-ta-header-heading { color: var(--tk-admin-text-strong) !important; }
html.dark .fi-ta-header-description,
html.dark .fi-ta-text-description,
html.dark .fi-ta-text-list-limited-message { color: var(--tk-admin-muted) !important; }

html.dark .fi-ta-row { border-bottom: 1px solid var(--tk-admin-border) !important; }
html.dark .fi-ta-row:hover { background: var(--tk-admin-surface-alt) !important; }

html.dark .fi-ta-header-cell {
    color: var(--tk-admin-muted) !important;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.7rem;
}

html.dark .fi-ta-cell { color: var(--tk-admin-text) !important; }

html.dark .fi-modal-window,
html.dark .fi-modal-content { background: var(--tk-admin-surface) !important; }

html.dark .fi-modal-header,
html.dark .fi-modal-footer {
    background: var(--tk-admin-surface-alt) !important;
    border-color: var(--tk-admin-border) !important;
}

html.dark .fi-modal-description { color: var(--tk-admin-muted) !important; }

/* Compact Sidebar */
html.dark .fi-sidebar-header {
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
    height: auto !important;
}

html.dark .fi-sidebar-nav { gap: 0.125rem !important; }
html.dark .fi-sidebar-item {
    padding-block: 0.25rem !important;
    padding-inline: 0.5rem !important;
}

html.dark .fi-sidebar-item-label {
    font-size: 0.8125rem !important;
    font-weight: 500 !important;
}

html.dark .fi-sidebar-group-label {
    padding-block: 0.5rem !important;
    font-size: 0.75rem !important;
}

/* Settings page adjustments */
html.dark .tk-admin-settings .fi-section {
    border-radius: 2px !important;
    box-shadow: none !important;
}

html.dark .tk-admin-settings .fi-section-header {
    padding: 0.85rem 1.25rem !important;
    position: relative;
}

html.dark .tk-admin-settings .fi-section-header::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--tk-admin-red);
}

html.dark .tk-admin-settings .fi-section-content { padding: 1.25rem !important; }

html.dark .tk-admin-settings .tk-file-row {
    background: var(--tk-admin-input-bg) !important;
    border-color: var(--tk-admin-border-strong) !important;
}

html.dark .tk-admin-settings .tk-file-row label {
    background: var(--tk-admin-surface-alt) !important;
    border-color: var(--tk-admin-border-strong) !important;
    color: var(--tk-admin-text) !important;
}

html.dark .tk-admin-settings .tk-file-row .text-gray-500 { color: var(--tk-admin-muted) !important; }

html.dark .tk-admin-settings input,
html.dark .tk-admin-settings textarea {
    border-radius: 2px !important;
    box-shadow: none !important;
    background: var(--tk-admin-input-bg) !important;
    color: var(--tk-admin-text) !important;
    border: 1px solid var(--tk-admin-border-strong) !important;
}

html.dark .tk-admin-settings input::placeholder,
html.dark .tk-admin-settings textarea::placeholder {
    color: var(--tk-admin-muted) !important;
}

html.dark .tk-admin-settings input:focus,
html.dark .tk-admin-settings textarea:focus {
    border-color: var(--tk-admin-red) !important;
}

/* Admin login */
html.dark .fi-simple-header { display: none !important; }

html.dark .fi-simple-layout,
html.dark .fi-simple-main,
html.dark .fi-simple-page {
    background: transparent !important;
    box-shadow: none !important;
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
}

html.dark .tk-admin-login {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1.5rem;
    background: var(--tk-admin-ink);
    color: var(--tk-admin-text);
}

html.dark .tk-admin-login__grid {
    width: 100%;
    max-width: 1024px;
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 3rem;
    align-items: center;
}

@media (max-width: 1024px) {
    html.dark .tk-admin-login__grid {
        grid-template-columns: 1fr;
        max-width: 560px;
    }

    html.dark .tk-admin-login__brand {
        display: none;
    }
}

html.dark .tk-admin-login__brand {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

html.dark .tk-admin-login__eyebrow {
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-size: 0.7rem;
    color: var(--tk-admin-muted);
}

html.dark .tk-admin-login__title {
    font-family: 'Bebas Neue', 'Impact', sans-serif;
    font-size: 3.75rem;
    letter-spacing: 0.04em;
    line-height: 0.95;
    text-transform: uppercase;
}

html.dark .tk-admin-login__title span { color: var(--tk-admin-red); }
html.dark .tk-admin-login__copy {
    color: var(--tk-admin-muted);
    max-width: 28rem;
    font-size: 1rem;
}

html.dark .tk-admin-login__panel {
    background: #141414;
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 2.5rem;
}

html.dark .tk-admin-login__panel-header h2 {
    font-family: 'Oswald', 'Arial Narrow', sans-serif;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 0.35rem;
}

html.dark .tk-admin-login__panel-header p {
    color: var(--tk-admin-muted);
    font-size: 0.95rem;
}

html.dark .tk-admin-login .fi-input-wrp {
    background: #0f0f0f !important;
    border-color: rgba(255, 255, 255, 0.12) !important;
    border-radius: 2px !important;
}

html.dark .tk-admin-login .fi-input { color: var(--tk-admin-text-strong) !important; }

html.dark .tk-admin-login .fi-fo-field-wrp-label span {
    color: var(--tk-admin-muted) !important;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    font-size: 0.7rem !important;
}

html.dark .tk-admin-login .fi-checkbox-input {
    border-radius: 2px !important;
    border-color: rgba(255, 255, 255, 0.25) !important;
}

html.dark .tk-admin-login .fi-checkbox-input:checked {
    background-color: var(--tk-admin-red) !important;
    border-color: var(--tk-admin-red) !important;
}

html.dark .tk-admin-login .fi-btn,
html.dark .tk-admin-login .fi-btn-primary,
html.dark .tk-admin-login button[type='submit'] {
    width: 100% !important;
    padding-block: 0.75rem !important;
    border-radius: 2px !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-top: 1.5rem !important;
    box-shadow: none !important;
}

html.dark .tk-admin-login .fi-btn-primary:hover,
html.dark .tk-admin-login button[type='submit']:hover {
    background-color: var(--tk-admin-red-dark) !important;
}
"""

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_css)
