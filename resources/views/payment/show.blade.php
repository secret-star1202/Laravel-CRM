@extends('layouts.main')

@section('title', $payment->name)

@section('content')
    <!--begin::Bread-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline mr-5">
                    <a class="text-dark" href="{{ route('payment.index') }}"><h5 class="text-dark font-weight-bold my-2 mr-5">Pagos</h5></a>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item active">
                            <a href="#" class="text-muted">@yield('title')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
               
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-custom mb-5 ">
                            
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                
                            
                                <div class="card-title">
                                    <h3 class="card-label">{{ $payment->name }}
                                        <span class="d-block text-muted pt-2 font-size-sm">Datos del Pago</span>
                                    </h3>
                                </div>
                                <!--start::Toolbar-->
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('payment.edit', $payment) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                            @livewire('payment.become-to-client', ['payment' => $payment], key($payment->id))
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-4">
                                <div class="text-center mb-10">
                                    <div class="symbol symbol-60 symbol-circle symbol-xl-90">
                                        <div class="symbol-label" 
                                            @if ($payment->image)
                                                style="background-image:url({{ Storage::url($payment->image->url) }}" 
                                            @else
                                                style="background-image:url({{ asset('assets/media/users/blank.png') }}" 
                                            @endif
                                            ></div>
                                    </div>
                                    <div class="text-muted mb-2">{{ $payment->company }}</div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Interes:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">
                                            {{ $payment->interest }}
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Status:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->status }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Correo:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder"><a href="mailto:{{ $payment->email }}">{{ $payment->email }}</a></span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Teléfono:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->phone }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Origen:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->origin }}</span>
                                    </div>
                                </div>
                                <div class="form-group row my-2">
                                    <label class="col-4 col-form-label">Empresa:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext font-weight-bolder">{{ $payment->company }}</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets') }}/media/svg/shapes/abstract-4.svg)">
                            <!--begin::Body-->
                            <div class="card-body">
                                @if ($payment->user)
                                    <a href="{{ route('user.show', $payment->user) }}" class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">Pertenece a</a>
                                    <div class="">
                                        <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                            @if ($payment->user)
                                                <span class="badge badge-info">{{ $payment->user->name }}</span>
                                            @else
                                                <span class="badge badge-secondary">Ninguno</span>
                                            @endif
                                        </p> 
                                        <br>
                                        <div class="font-weight-bold text-success mb-5">{{ $payment->created_at->diffforhumans() }}</div>
                                    </div>
                                @else
                                    <span class="badge badge-secondary">Este paymento no tiene asignado ningun usuario</span>
                                @endif
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto py-4">
                                <div class="card-title">
                                    <h3 class="card-label">Cotización</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($payment->quotation)
                                    <embed width="100%" height="600px" src="{{ Storage::url($payment->quotation) }}" type="">
                                @else
                                    <span class="d-block badge badge-secondary text-muted pt-2 font-size-sm">Ninguno</span>
                                @endif
                               
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection

@section('footer')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets') }}/plugins/custom/flot/flot.bundle.js"></script>
    <script src="{{ asset('assets') }}/js/pages/features/charts/flotcharts.js"></script>
@endsection