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
          <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link @yield('settings')"><i class="fa fa-gear"></i> {{ __('Settings') }}</a></li>
          <li class="nav-item"><a href="{{ route('admin.custom-page.list') }}" class="nav-link @yield('custom-page')"><i class=" fa fa-book"></i> {{ __('Custom page') }}</a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
