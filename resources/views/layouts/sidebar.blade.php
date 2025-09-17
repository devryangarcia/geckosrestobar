<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('home') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('assets/img/geckos_logo2.png') }}" alt="Gecko's Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Gecko's RestoBar</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bartenders.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Bartender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('waitress.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>Waitress</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('outgoingproducts.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-box-open"></i>
                        <p>Outgoing Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('incomingproducts.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-cart-plus"></i>
                        <p>Purchase Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ladiesdrinks.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-martini-glass-citrus"></i>
                        <p>Ladies Drinks</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-secret"></i>
                        <p>System Users</p>
                    </a>
                </li>
                @endif
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
