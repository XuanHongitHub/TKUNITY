<div class="filament-login-page min-h-screen flex items-center justify-center p-4">
    <style>
        /* Import Font */
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');

        :root {
            /* Light Mode Red/White Theme */
            --accent: #dc2626;      /* Red-600 */
            --accent-dark: #b91c1c; /* Red-700 */
            --text: #111827;        /* Gray-900 */
            --text-muted: #4b5563;  /* Gray-600 */
            --text-dim: #9ca3af;    /* Gray-400 */
            --bg: #ffffff;          /* White */
            --bg-alt: #f9fafb;      /* Gray-50 */
            --bg-elevated: #f3f4f6; /* Gray-100 */
            --border: #e5e7eb;      /* Gray-200 */
            --success: #059669;     /* Emerald-600 */
        }

        /* RESET & BODY OVERRIDES */
        body, .fi-simple-layout {
            background-color: var(--bg) !important;
            color: var(--text) !important;
            font-family: 'Space Grotesk', sans-serif !important;
        }
        
        .fi-simple-main, 
        .fi-simple-page {
            background-color: transparent !important;
            box-shadow: none !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Hide default Filament logo/heading */
        .fi-simple-header { display: none !important; }

        /* MAIN CONTAINER */
        .filament-login-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg);
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            max-width: 1000px;
            width: 100%;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
            .auth-info {
                display: none;
            }
        }

        /* LEFT SIDE CONTENT */
        .auth-info h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            color: var(--text);
        }
        .auth-info h1 span { color: var(--accent); }
        .auth-info p {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .auth-features { list-style: none; padding: 0; }
        .auth-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 1rem;
            color: var(--text-muted);
        }
        .auth-features li svg { color: var(--success); width: 20px; height: 20px; }

        /* RIGHT SIDE - FORM CARD */
        .auth-form-wrapper {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        }

        .auth-header { text-align: center; margin-bottom: 2rem; }
        .auth-header h2 { font-size: 1.5rem; font-weight: 700; color: var(--text); }
        .auth-header p { color: var(--text-muted); margin-top: 0.5rem; }

        /* FILAMENT FORM OVERRIDES */
        .fi-form { gap: 1.5rem; }
        
        /* Input Fields */
        .fi-input-wrp {
            background-color: white !important;
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s;
        }
        .fi-input-wrp:focus-within {
            border-color: var(--accent) !important;
            ring: 2px solid rgba(220, 38, 38, 0.1) !important;
        }
        .fi-input {
            color: var(--text) !important;
            font-family: 'Space Grotesk', sans-serif !important;
        }
        
        /* Labels */
        .fi-fo-field-wrp-label span {
            color: var(--text-muted) !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em;
        }
        .fi-fo-field-wrp-label span sup { color: var(--accent) !important; }

        /* Checkbox */
        .fi-checkbox-input {
            background-color: white !important;
            border-color: var(--text-dim) !important;
            color: var(--accent) !important;
            border-radius: 4px !important;
        }
        .fi-checkbox-input:checked {
            background-color: var(--accent) !important;
            border-color: var(--accent) !important;
        }

        /* Submit Button */
        .fi-btn,
        .fi-btn-primary,
        button[type="submit"] {
            background-color: var(--accent) !important;
            color: white !important;
            text-transform: uppercase !important;
            font-weight: 700 !important;
            letter-spacing: 0.05em !important;
            border-radius: 8px !important;
            padding-block: 0.75rem !important;
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2) !important;
            width: 100% !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            opacity: 1 !important;
            visibility: visible !important;
            margin-top: 2rem !important;
        }
        .fi-btn:hover,
        .fi-btn-primary:hover,
        button[type="submit"]:hover {
            background-color: var(--accent-dark) !important;
        }
        
        /* Ensure form actions container is visible */
        .fi-form-actions {
            display: block !important;
            visibility: visible !important;
        }
    </style>

    <div class="auth-wrapper">
        <!-- Left Side -->
        <div class="auth-info">
            <h1>TKUnity <span>Admin</span></h1>
            <p>Admin Access Portal. Manage your gaming empire securely.</p>
        </div>

        <!-- Right Side - Form -->
        <div class="auth-form-wrapper">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Sign in to access the TKUnity Dashboard</p>
            </div>

            {{ $this->form }}
        </div>
    </div>
</div>
