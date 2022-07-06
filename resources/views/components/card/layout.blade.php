<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{$mainTitle ?? 'Kosong'}}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$subTitle ?? 'Kosong'}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        @include('components.flash')
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                {{$header}}
                <hr/>
                {{$body}}
            </div>
        </div>
    </div>
</div>
