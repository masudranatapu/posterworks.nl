@php
 $settings = DB::table('settings')->first();
@endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">{{ $settings->site_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link @yield('dashboard')"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
          <li class="nav-item"><a href="{{ route('admin.faq.index') }}" class="nav-link @yield('faq')"><i class="fa fa-pager"></i> {{ __('FAQ') }}</a></li>
          <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link @yield('settings')"><i class="fa fa-gear"></i> {{ __('Settings') }}</a></li>
          <li class="nav-item"><a href="{{ route('admin.cpage.index') }}" class="nav-link @yield('custom-page')"><i class=" fa fa-book"></i> {{ __('Custom page') }}</a></li>
          <li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link @yield('admin-user')"><i class=" fa fa-book"></i> {{ __('Admin User & Role') }}</a></li>

          {{-- <li class="nav-item"><a href="{{ route('admin.roles.index') }}" class="nav-link @yield('admin-roles')"><i class=" fa fa-book"></i> {{ __('Admin Roles') }}</a></li> --}}

          {{-- <li class="nav-item"><a href="{{ route('admin.permissions.index') }}" class="nav-link @yield('admin-permissions')"><i class=" fa fa-book"></i> {{ __('Admin permissions') }}</a></li> --}}

        </ul>
      </nav>

    </div>

  </aside>
