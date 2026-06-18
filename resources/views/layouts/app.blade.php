<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'BPSC Tech Official') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- Mobile Header Strip -->
    <div class="mobile-header-strip">
        <button class="hamburger-btn" onclick="toggleSidebar()">
            <i data-lucide="menu"></i>
        </button>
        <span style="margin-left: 15px; font-weight: bold;">BPSC Official</span>
    </div>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="/cropped-QT3Rx6On_400x400.png" alt="BPSC Logo" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid white; background-color: white; margin-bottom: 4px; object-fit: contain;">
                <button class="mobile-close" onclick="toggleSidebar()">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <nav class="sidebar-nav">
                @php
                    $user = auth()->user();
                    $isAdmin = $user && $user->role === 'Admin';
                    $isEmployee = $user && $user->role === 'Employee';
                @endphp

                @if(!$user || (!$isAdmin && !$isEmployee))
                    <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i data-lucide="home"></i><span>Home</span>
                    </a>
                    
                    <div class="nav-item has-dropdown" id="about-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('about-dropdown')">
                            <i data-lucide="info"></i><span>About Us</span><i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('history') }}" class="nav-item submenu-item"><i data-lucide="history" size="14"></i><span>History</span></a>
                            <a href="{{ route('constitutional-provisions') }}" class="nav-item submenu-item"><i data-lucide="shield" size="14"></i><span>Constitutional Provisions</span></a>
                            <a href="{{ route('the-commission') }}" class="nav-item submenu-item"><i data-lucide="users" size="14"></i><span>The Commission</span></a>
                            <a href="{{ route('community') }}" class="nav-item submenu-item"><i data-lucide="heart" size="14"></i><span>Community</span></a>
                            <a href="{{ route('section') }}" class="nav-item submenu-item"><i data-lucide="layers" size="14"></i><span>Section</span></a>
                            <a href="{{ route('gallery') }}" class="nav-item submenu-item"><i data-lucide="image" size="14"></i><span>Gallery</span></a>
                        </div>
                    </div>

                    <div class="nav-item has-dropdown" id="exam-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('exam-dropdown')">
                            <i data-lucide="edit-3"></i><span>Examination</span><i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('syllabus') }}" class="nav-item submenu-item"><i data-lucide="book-open" size="14"></i><span>Syllabus</span></a>
                            <a href="#" class="nav-item submenu-item"><i data-lucide="file-check" size="14"></i><span>Marksheet</span></a>
                        </div>
                    </div>

                    <a href="{{ route('online-application') }}" class="nav-item {{ request()->routeIs('online-application') ? 'active' : '' }}">
                        <i data-lucide="monitor"></i><span>Online Application</span>
                    </a>
                    <a href="{{ route('archives') }}" class="nav-item {{ request()->routeIs('archives') ? 'active' : '' }}">
                        <i data-lucide="archive"></i><span>Archives</span>
                    </a>
                    <a href="{{ route('exam-calendar') }}" class="nav-item {{ request()->routeIs('exam-calendar') ? 'active' : '' }}">
                        <i data-lucide="calendar"></i><span>Exam Calendar</span>
                    </a>
                    <a href="{{ route('asset-declaration') }}" class="nav-item {{ request()->routeIs('asset-declaration') ? 'active' : '' }}">
                        <i data-lucide="database"></i><span>Asset Declaration</span>
                    </a>
                    <a href="{{ route('faqs') }}" class="nav-item {{ request()->routeIs('faqs') ? 'active' : '' }}">
                        <i data-lucide="help-circle"></i><span>FAQs</span>
                    </a>
                    <a href="{{ route('contact-us') }}" class="nav-item {{ request()->routeIs('contact-us') ? 'active' : '' }}">
                        <i data-lucide="phone"></i><span>Contact Us</span>
                    </a>
                @endif

                @if($isAdmin)
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="activity"></i><span>Dashboard</span>
                    </a>
                    <div class="nav-item has-dropdown {{ request()->routeIs('admin.employees') ? 'active-menu' : '' }}" id="admin-emp-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('admin-emp-dropdown')">
                            <i data-lucide="users"></i><span>Employees</span>
                            <i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('admin.employees.create') }}" class="nav-item submenu-item">
                                <i data-lucide="edit-3"></i><span>Create Employee</span>
                            </a>
                            <a href="{{ route('admin.employees') }}" class="nav-item submenu-item">
                                <i data-lucide="list"></i><span>My Employees</span>
                            </a>
                        </div>
                    </div>
                    <div class="nav-item has-dropdown {{ request()->routeIs('admin.tasks*') ? 'active-menu' : '' }}" id="admin-task-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('admin-task-dropdown')">
                            <i data-lucide="file-text"></i><span>Tasks</span>
                            <i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('admin.tasks.create') }}" class="nav-item submenu-item">
                                <i data-lucide="mouse-pointer-2"></i><span>Assign Task</span>
                            </a>
                            <a href="{{ route('admin.tasks') }}" class="nav-item submenu-item">
                                <i data-lucide="database"></i><span>Manage Tasks</span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('admin.projects') }}" class="nav-item {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
                        <i data-lucide="briefcase"></i><span>Projects</span>
                    </a>
                    <div class="nav-item has-dropdown {{ request()->routeIs('admin.teams*') ? 'active-menu' : '' }}" id="admin-team-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('admin-team-dropdown')">
                            <i data-lucide="users"></i><span>Teams</span>
                            <i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('admin.teams.create') }}" class="nav-item submenu-item">
                                <i data-lucide="plus-circle"></i><span>Create Team</span>
                            </a>
                            <a href="{{ route('admin.teams') }}" class="nav-item submenu-item">
                                <i data-lucide="list"></i><span>Manage Teams</span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('admin.profile') }}" class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i data-lucide="contact"></i><span>Profile</span>
                    </a>
                @endif

                @if($isEmployee)
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i data-lucide="activity"></i><span>Dashboard</span>
                    </a>
                    <div class="nav-item has-dropdown {{ request()->routeIs('employee.tasks') ? 'active-menu' : '' }}" id="emp-task-dropdown">
                        <div class="dropdown-trigger" onclick="toggleDropdown('emp-task-dropdown')">
                            <i data-lucide="file-text"></i><span>Tasks</span>
                            <i data-lucide="chevron-down" style="margin-left: auto;"></i>
                        </div>
                        <div class="submenu">
                            <a href="{{ route('employee.tasks') }}" class="nav-item submenu-item">
                                <i data-lucide="list"></i><span>My Tasks</span>
                            </a>
                        </div>
                    </div>
                @endif

                @auth
                    <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
                        @csrf
                        <button type="submit" class="nav-item" style="background: none; border: none; width: 100%; text-align: left; color: #ff4d4d; border-top: 1px solid rgba(255,255,255,0.1);">
                            <i data-lucide="log-out"></i>
                            <span>Logout ({{ auth()->user()->name }})</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-item" style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.1);">
                        <i data-lucide="log-in"></i><span>Login</span>
                    </a>
                @endauth
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="sticky-header-wrapper">
                <!-- Top Header -->
                <header class="top-header" style="background: linear-gradient(135deg, #f0f8fc 0%, #ffffff 50%, #f0f8fc 100%);">
                    <div class="header-center" style="display: flex; flex-direction: column; align-items: center;">
                        <h1 class="header-title">Bihar Public Service Commission (Only for BPSC Office Staff and Administration)</h1>
                        <div class="header-subtitle" style="color: #444;">
                            <span>15, Nehru Path (Bailey Road), Patna – 800001 (Bihar)</span>
                        </div>
                    </div>
                    <div class="header-right" style="display: flex; align-items: center; gap: 12px;">
                        <div class="lang-toggle" style="display: flex; gap: 8px;">
                            <button class="lang-btn active" style="background-color: #0aa4db; color: white; border: none; padding: 6px 16px; border-radius: 4px; cursor: pointer; font-size: 13px; font-weight: bold;">English</button>
                            <button class="lang-btn" style="background-color: transparent; color: #333; border: none; cursor: pointer; font-size: 13px;">हिन्दी</button>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="social-icons" style="display: flex; gap: 8px; align-items: center;">
                                <a href="#" style="display: flex;"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" style="width: 20px;"></a>
                                <a href="#" style="display: flex;"><img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/X_logo_2023.svg" alt="X" style="width: 18px;"></a>
                                <a href="#" style="display: flex;"><img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" alt="Instagram" style="width: 20px;"></a>
                                <a href="#" style="display: flex;"><img src="https://upload.wikimedia.org/wikipedia/commons/0/09/YouTube_full-color_icon_%282017%29.svg" alt="YouTube" style="width: 24px;"></a>
                            </div>
                            <img src="/462-4621574_gog-png-png-download-satyamev-jayate-logo-png-removebg-preview-2.png" style="height: 48px;" alt="Emblem">
                        </div>
                    </div>
                </header>

                <!-- Mobile Hamburger Strip -->
                <div class="mobile-hamburger-strip">
                    <button class="hamburger-btn" onclick="toggleSidebar()">
                        <i data-lucide="menu" size="22"></i>
                    </button>
                </div>
            </div>

            <div class="page-container">
                @yield('content')
            </div>



            <footer class="main-footer">
                <div class="footer-top">
                    <div class="footer-col">
                        <h4>Locate us</h4>
                        <p>15, Nehru Path (Bailey Road), Patna – 800001 (Bihar)</p>
                    </div>
                    <div class="footer-col">
                        <h4>Call Us</h4>
                        <p class="footer-contact"><i data-lucide="phone" size="14" fill="currentColor" style="color:white; margin-right:4px;"></i> 8986422296</p>
                        <p class="footer-contact"><i data-lucide="phone" size="14" fill="currentColor" style="color:white; margin-right:4px;"></i> 0612-2237999</p>
                    </div>
                    <div class="scroll-to-top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" title="Back to top">
                        <i data-lucide="chevron-up" size="24" style="color: white;"></i>
                    </div>
                </div>
                <div class="copyright-bar">
                    Copyrights © 2026 All Rights Reserved by Bihar Public Service Commission
                </div>
            </footer>
        </main>
    </div>

    <script>
        lucide.createIcons();

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        function toggleDropdown(id) {
            const el = document.getElementById(id);
            el.classList.toggle('active-menu');
        }
    </script>
</body>
</html>
