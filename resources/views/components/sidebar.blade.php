<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SmartParking</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <x-sidebar.menu-label title="Menu"/>
        <x-sidebar.single icon="bx bx-home-circle" link="{{url('/')}}" name="Dashboard" />
        <x-sidebar.menu-label title="Parking"/>
        <x-sidebar.single icon="bx bx-current-location" link="{{route('location.index')}}" name="Location" />
        <x-sidebar.single icon="bx bx-history" link="{{route('histories.index')}}" name="History" />
        <x-sidebar.menu-label title="User"/>
        <x-sidebar.single icon="bx bx-game" link="{{route('admin.index')}}" name="Admin" />
        <x-sidebar.single icon="bx bx-user-voice" link="{{route('roles.index')}}" name="User Role" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('user.index')}}" name="User" />
        <x-sidebar.menu-label title="Landing Page"/>
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('feature.index')}}" name="Feature" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('faq.index')}}" name="Faq" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('about.index')}}" name="About" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('feedback.index')}}" name="Feedback" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('activity.index')}}" name="Activity" />
        <x-sidebar.single icon="bx bx-user-circle" link="{{route('optional.content.index')}}" name="Optional Menu" />
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
