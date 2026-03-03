@once
<style>
/* Theme Toggle Button - LaFatour Style */
.theme-toggle-wrapper {
    position: fixed;
    top: 1rem;
    right: 1.25rem;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(14, 165, 233, 0.1) 100%);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(251, 191, 36, 0.3);
    border-radius: 50px;
    box-shadow: 0 4px 20px rgba(251, 191, 36, 0.2);
    transition: all 0.3s ease;
}

.theme-toggle-wrapper:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(251, 191, 36, 0.3);
    border-color: rgba(251, 191, 36, 0.5);
}

.theme-toggle-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #fbbf24;
    margin: 0;
}

.theme-toggle-switch {
    position: relative;
    width: 56px;
    height: 28px;
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid rgba(251, 191, 36, 0.3);
}

.theme-toggle-switch.light {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
}

.theme-toggle-switch::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.theme-toggle-switch.light::before {
    left: 30px;
    background: #1e293b;
}

.theme-toggle-switch::after {
    content: '🌙';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 14px;
    transition: all 0.3s ease;
    opacity: 1;
}

.theme-toggle-switch.light::after {
    content: '☀️';
    opacity: 0;
}

[data-theme="dark"] .theme-toggle-switch::after {
    opacity: 1;
}

[data-theme="dark"] .theme-toggle-switch::before {
    content: '☀️';
}

/* Dark Mode Styles */
[data-theme="dark"] .fi-sidebar,
[data-theme="dark"] aside.filament-sidebar {
    background: linear-gradient(180deg, #1E293B 0%, #0F172A 100%) !important;
}

[data-theme="dark"] .fi-main,
[data-theme="dark"] .filament-main {
    background: #0F172A !important;
}

[data-theme="dark"] .filament-card,
[data-theme="dark"] .fi-card {
    background: #1E293B !important;
    border-color: #334155 !important;
}

[data-theme="dark"] .filament-table,
[data-theme="dark"] .fi-table {
    background: #1E293B !important;
    border-color: #334155 !important;
}

[data-theme="dark"] .filament-table th,
[data-theme="dark"] .fi-table th {
    background: #334155 !important;
    color: #E2E8F0 !important;
}

[data-theme="dark"] .filament-table td,
[data-theme="dark"] .fi-table td {
    border-color: #334155 !important;
    color: #E2E8F0 !important;
}

[data-theme="dark"] .filament-table tbody tr:hover,
[data-theme="dark"] .fi-table tbody tr:hover {
    background: #334155 !important;
}

[data-theme="dark"] input,
[data-theme="dark"] textarea,
[data-theme="dark"] select {
    background: #334155 !important;
    border-color: #475569 !important;
    color: #E2E8F0 !important;
}

[data-theme="dark"] .filament-heading,
[data-theme="dark"] .fi-heading {
    color: #F1F5F9 !important;
}

[data-theme="dark"] .filament-topbar,
[data-theme="dark"] header[class*="topbar"] {
    background: #1E293B !important;
    border-color: #334155 !important;
}

[data-theme="dark"] .fi-sidebar-item {
    color: #94A3B8 !important;
}

[data-theme="dark"] .fi-sidebar-item:hover {
    background: rgba(251, 191, 36, 0.1) !important;
    color: #fbbf24 !important;
}

[data-theme="dark"] .fi-sidebar-item-active,
[data-theme="dark"] .filament-sidebar-item-active {
    background: linear-gradient(90deg, rgba(251, 191, 36, 0.2) 0%, rgba(245, 158, 11, 0.2) 100%) !important;
    color: #fbbf24 !important;
}
</style>

<div class="theme-toggle-wrapper" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :data-theme="darkMode ? 'dark' : 'light'" x-init="document.documentElement.setAttribute('data-theme', darkMode ? 'dark' : 'light')">
    <p class="theme-toggle-label">Theme</p>
    <button
        class="theme-toggle-switch"
        :class="{ 'light': !darkMode }"
        @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); document.documentElement.setAttribute('data-theme', darkMode ? 'dark' : 'light')"
        aria-label="Toggle theme"
        type="button"
    ></button>
</div>
@endonce
