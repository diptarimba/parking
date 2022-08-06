<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h5 class="logo-text" style="color: white">Smart Parking</h5>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @php
            if (Auth::guard('web')->check()) {
                $permissionAvailable = Auth::guard('web')
                    ->user()
                    ->user_role->route_limiter_sidebar->pluck('route');
                $isUser = true;
            } else {
                $isUser = false;
            }
            $isAdmin = Auth::guard('admin')->check();
        @endphp

        <x-sidebar.menu-label title="Profile" />
        <x-sidebar.single icon="bx bx-id-card" route="bypass"
            link="{{ $isUser ? route('user.profile.edit') : route('admin.profile.edit') }}" name="Update Data" />
        <x-sidebar.single icon="bx bx-lock" route="bypass"
            link="{{ $isUser ? route('user.password.edit') : route('admin.password.edit') }}" name="Update Password" />
        <x-sidebar.single icon="bx bx-log-out" route="bypass" link="{{ route('admin.logout') }}" name="Logout" />

        @if ($isAdmin || $permissionAvailable->contains('home.index'))
            <x-sidebar.menu-label title="Home" />
            <x-sidebar.single icon="bx bx-home-circle" route="home.index" link="{{ route('home.index') }}"
                name="Dashboard" />
        @endif


        @if ($isAdmin ||
            $permissionAvailable->contains('histories.index') ||
            $permissionAvailable->contains('location.index'))
            <x-sidebar.menu-label title="Parking" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('location.index'))
            <x-sidebar.single icon="bx bx-current-location" route="location.index" link="{{ route('location.index') }}"
                name="Location" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('histories.index'))
            <x-sidebar.single icon="bx bx-history" route="histories.index" link="{{ route('histories.index') }}"
                name="History" />
        @endif


        @if ($isAdmin ||
            $permissionAvailable->contains('user.index') ||
            $permissionAvailable->contains('admin.index') ||
            $permissionAvailable->contains('roles.index'))
            <x-sidebar.menu-label title="User" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('admin.index'))
            <x-sidebar.single icon="bx bx-street-view" route="admin.index" link="{{ route('admin.index') }}"
                name="Admin" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('roles.index'))
            <x-sidebar.single icon="bx bx-user-voice" route="roles.index" link="{{ route('roles.index') }}"
                name="User Role" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('user.index'))
            <x-sidebar.single icon="bx bx-user-circle" route="user.index" link="{{ route('user.index') }}"
                name="User" />
        @endif

        @if ($isAdmin ||
            $permissionAvailable->contains('feature.index') ||
            $permissionAvailable->contains('faq.index') ||
            $permissionAvailable->contains('about.index') ||
            $permissionAvailable->contains('feedback.index') ||
            $permissionAvailable->contains('activity.index') ||
            $permissionAvailable->contains('optional.content.index'))
            <x-sidebar.menu-label title="Landing Page" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('feature.index'))
            <x-sidebar.single icon="bx bx-package" route="feature.index" link="{{ route('feature.index') }}"
                name="Home" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('faq.index'))
            <x-sidebar.single icon="bx bx-question-mark" route="faq.index" link="{{ route('faq.index') }}"
                name="Faq" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('about.index'))
            <x-sidebar.single icon="bx bx-message-square-check" route="about.index" link="{{ route('about.index') }}"
                name="About" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('feedback.index'))
            <x-sidebar.single icon="bx bx-sync" route="feedback.index" link="{{ route('feedback.index') }}"
                name="Feedback" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('activity.index'))
            <x-sidebar.single icon="bx bx-repeat" route="activity.index" link="{{ route('activity.index') }}"
                name="Activity" />
        @endif
        @if ($isAdmin || $permissionAvailable->contains('optional.content.index'))
            <x-sidebar.single icon="bx bx-menu" route="optional.content.index"
                link="{{ route('optional.content.index') }}" name="Optional Menu" />
        @endif







    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
