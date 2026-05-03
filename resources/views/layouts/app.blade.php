<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Alumni')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-bg: #f1f4f6;
            --color-surface: #ffffff;
            --color-surface-soft: #eff6ff;
            --color-border: #d9e2ef;
            --color-border-strong: #c8d2e0;
            --color-primary: #005792;
            --color-primary-dark: #003f87;
            --color-primary-soft: #e7f2ff;
            --color-secondary: #191c21;
            --color-text: #222b3d;
            --color-muted: #64748b;
            --color-success: #047857;
            --color-danger: #d12924;
            --color-danger-soft: rgba(209, 41, 36, 0.12);
            --font-heading: 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Inter', sans-serif;
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 2.5rem;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 25px rgba(15, 23, 42, 0.08);
            --max-content-width: 1200px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--font-body);
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .page-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-content {
            width: min(100%, var(--max-content-width));
            margin: 0 auto;
            padding: 1.5rem;
        }

        .account-shell {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .page-title {
            margin: 0;
            font-family: var(--font-heading);
            font-size: clamp(1.625rem, 2vw, 2.25rem);
            letter-spacing: -0.03em;
        }

        .page-subtitle {
            margin: 0.75rem 0 0;
            color: var(--color-muted);
            max-width: 55rem;
            font-size: 1rem;
        }

        .layout-grid {
            display: grid;
            grid-template-columns: minmax(16rem, 1fr) minmax(32rem, 2fr);
            gap: 1.5rem;
        }

        .account-sidebar {
            background-color: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-heading {
            margin: 0 0 1rem;
            font-family: var(--font-heading);
            font-size: 1rem;
            color: var(--color-secondary);
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1rem;
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            color: var(--color-muted);
            background-color: transparent;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .sidebar-link.active,
        .sidebar-link:hover {
            color: var(--color-primary);
            background-color: var(--color-primary-soft);
            border-color: var(--color-border);
        }

        .sidebar-note {
            margin: 1.75rem 0 0;
            padding: 1rem;
            border-radius: var(--radius-md);
            background-color: var(--color-primary-soft);
            color: var(--color-secondary);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .account-panel {
            display: grid;
            gap: 1.5rem;
        }

        .panel-card {
            background-color: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .panel-card-header {
            margin: 0 0 1rem;
            font-family: var(--font-heading);
            font-size: 1.125rem;
            color: var(--color-secondary);
        }

        .profile-grid {
            display: grid;
            gap: 1rem;
        }

        .profile-item {
            display: grid;
            gap: 0.35rem;
        }

        .profile-item dt {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--color-muted);
        }

        .profile-item dd {
            margin: 0;
            font-size: 1rem;
            color: var(--color-text);
            font-weight: 600;
        }

        .form-group {
            display: grid;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .form-group label {
            display: inline-flex;
            font-size: 0.9rem;
            color: var(--color-secondary);
            font-weight: 600;
        }

        .form-control,
        .form-control:disabled {
            width: 100%;
            min-height: 3rem;
            padding: 0.9rem 1rem;
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            background-color: var(--color-surface);
            color: var(--color-text);
            font-size: 1rem;
        }

        .form-control:disabled {
            opacity: 0.8;
            cursor: not-allowed;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.9rem 1.2rem;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
            font-weight: 600;
        }

        .button.primary {
            background-color: var(--color-primary);
            color: #ffffff;
        }

        .button.secondary {
            background-color: var(--color-surface-soft);
            color: var(--color-secondary);
            border: 1px solid var(--color-border);
        }

        .button.primary:hover,
        .button.secondary:hover {
            transform: translateY(-1px);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.75rem;
            border-radius: 9999px;
            background-color: var(--color-primary-soft);
            color: var(--color-primary);
            font-size: 0.9rem;
            font-weight: 700;
        }

        .field-note {
            margin: 0.25rem 0 0;
            color: var(--color-muted);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .divider {
            height: 1px;
            background-color: var(--color-border);
            border: none;
            margin: 1.5rem 0;
        }

        @media (max-width: 860px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 580px) {
            .page-content {
                padding: 1rem;
            }

            .sidebar-link {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="page-shell">
        <div class="page-content">
            @yield('content')
        </div>
    </div>
</body>
</html>