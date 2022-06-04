<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Lummeshop</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <x-sidebar.menu-label title="Menu"/>
        <x-sidebar.single icon="bx bx-home-circle" link="{{url('/')}}" name="Dashboard" />
        <x-sidebar.menu-label title="Statistic"/>

        <x-sidebar.menu-label title="Users"/>
        <x-sidebar.single icon="bx bx-game" link="{{route('admin.index')}}" name="Admin" />
        <x-sidebar.single icon="bx bx-user-voice" link="{{route('roles.index')}}" name="User Role" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('user.index')}}" name="User" />
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
