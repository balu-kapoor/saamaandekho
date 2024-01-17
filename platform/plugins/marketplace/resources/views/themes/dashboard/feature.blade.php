@extends(MarketplaceHelper::viewPath('dashboard.layouts.master'))
@section('content')
    <div class="card">
        <div class="card-body p-lg-5">
            <!-- {!! Form::open(['route' => 'marketplace.vendor.kyc', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <button class="btn">Proceed to pay</button>
            {!! Form::close() !!} -->
            <a href="#" class="btn-primary">Proceed to pay</a>
        </div>
    </div>
@stop
