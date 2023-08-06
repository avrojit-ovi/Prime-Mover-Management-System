<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo"></span>
            <span class="display-3 demo menu-text fw-bolder ms-2">P.M.M.S</span>
        </a>

        <a
            href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) === 'dashboard.php') ? 'active' : ''; ?>">
            <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) === 'vehicles.php') ? 'active' : ''; ?>">
            <a href="vehicles.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Vehicles</div>
            </a>
        </li>
        <!-- User -->
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) === 'employee.php') ? 'active' : ''; ?>">
            <a href="employee.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Employee</div>
            </a>
        </li>
        <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) === 'user.php') ? 'active' : ''; ?>">
            <a href="user.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
    </ul>
</aside>

<!-- / Menu -->