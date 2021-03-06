<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/roles') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.role.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/bins') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.bin.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/bin-relationships') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.bin-relationship.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/bin-statuses') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.bin-status.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/client-complaints') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.client-complaint.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/complaint-statuses') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.complaint-status.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
