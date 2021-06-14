<div class="container">

    @if ($count)
            
        <!--Filters-->
        <div class="card mb-7">
            <div class="card-body">
                <div class="mb-5 ">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input 
                                            wire:model="search"
                                            type="search" 
                                            class="form-control"
                                            placeholder="Buscar servicio, cliente, categoría...">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Mostrar:</label>
                                        <select class="form-control" wire:model="perPage">
                                            <option value="10">10 Entradas</option>
                                            <option value="20">20 Entradas</option>
                                            <option value="50">50 Entradas</option>
                                            <option value="100">100 Entradas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--begin::Row-->
        <div class="row">
            @forelse ($services as $service)

            <div class="col-xl-4">
                <!--begin::Card-->
                <div class="card gutter-b card-stretch">
                    <div class="card-body ribbon ribbon-top">
                        @if ($service->finished)
                            <div class="ribbon-target bg-danger" style="top: -2px; right: 20px;">Finalizado</div>
                        @endif
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 symbol symbol-60 symbol-circle">
                                <img 
                                    @if ($service->client->image)
                                        src="{{ Storage::url($service->client->image->url) }}" 
                                    @else
                                        src="{{ asset('assets/media/users/blank.png') }}" 
                                    @endif
                                alt="image" />
                            </div>
                            <!--end::Pic-->
                            <div class="d-flex flex-column mr-auto">
                                <!--begin: Title-->
                                <a href="#" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{ $service->client->name }}</a>
                                @if ($service->categoryService)
                                    <span class="text-primary font-weight-bold">{{ $service->categoryService->name }}</span>
                                @else
                                    <span class="text-secondary font-weight-bold">Ninguno</span>
                                @endif
                            </div>
                            <!--start::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline" data-toggle="tooltip"  data-placement="left">
                                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('service.show', $service) }}"><i class="fa fa-eye mr-2"></i> Ver</a>
                                        <a class="dropdown-item" href="{{ route('service.edit', $service) }}"><i class="fa fa-pen mr-2"></i> Editar</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroy({{ $service->id }})"><i class="fa fa-trash mr-2"></i> Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Description-->
                        <div class="mb-10 mt-5 ">{{ $service->note }}</div>
                        <!--end::Description-->
                        <!--begin::Data-->
                        <div class="d-flex mb-5">
                            <div class="d-flex align-items-center mr-7">
                                <span class="font-weight-bold mr-4">Inicio</span>
                                <span class="btn btn-light-success btn-sm font-weight-bold btn-upper btn-text">{{ $service->start() }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bold mr-4">Vencimiento</span>
                                <span class="btn btn-light-danger btn-sm font-weight-bold btn-upper btn-text">{{ $service->due() }}</span>
                            </div>
                        </div>
                        <!--end::Data-->
                        <!--begin::Progress-->
                        @if ($service->type == 'Proyecto')
                            <div class="d-flex mb-5 align-items-center">
                                <span class="d-block font-weight-bold mr-5">Progreso</span>
                                <div class="d-flex flex-row-fluid align-items-center">
                                    <div class="progress progress-xs mt-2 mb-2 w-100">
                                        @if ($service->progressByProject() >= 60)
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif($service->progressByProject() >= 30)
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        @else
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $service->progressByProject() }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    </div>
                                    <span class="ml-3 font-weight-bolder">{{ $service->progressByProject() }}%</span>
                                </div>
                            </div>
                        @else
                            <div class="mb-2">
                                <span class="font-weight-bold">Días restantes</span> <span class="label label-xl label-danger mr-2"> {{ $service->progressByMohts() }}</span>
                                
                            </div>
                        @endif
                        <!--ebd::Progress-->
                        @if ($service->users->count())
                            <div class="d-flex flex-column flex-lg-fill float-left mb-7">
                                <div class="symbol-group symbol-hover">
                                    @foreach ($service->users as $user)
                                        <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="{{ $user->name }}">
                                            <img 
                                                alt="{{ $user->name }}" 
                                                @if ($user->image)
                                                    src="{{ Storage::url($user->image->url) }}" 
                                                @else
                                                    src="{{ asset('assets/media/users/blank.png') }}" 
                                                @endif
                                                >
                                        </div>
                                        @if ($loop->index == (8))
                                            <div class="symbol symbol-30 symbol-circle symbol-light">
                                                <span class="symbol-label font-weight-bold">{{ $role->users->count() - ($loop->index + 1) }}+</span>
                                            </div>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex align-items-center">
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-7">
                                <span class="font-weight-bolder text-success ml-2">{{ $service->priceToString() }}</span>
                            </div>
                            @if ($service->has_invoice)
                            <div class="d-flex align-items-center mr-7">
                                <a href="#" class="font-weight-bolder text-info ml-2">Se require factura</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:: Card-->
            </div>
            @empty 
             <!--begin::Col-->
             <div class="col-12">
                <div class="alert alert-custom alert-notice alert-light-dark fade show mb-5" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-questions-circular-button"></i>
                    </div>
                    <div class="alert-text">Sin resultados "{{ $search }}"</div>
                </div>
             </div>
            @endforelse
        </div>
        <!--end::Row-->

        {{ $services->links() }}

    @else

        <div class="card">
            <div class="card-body">
                <div class="card-px text-center py-20 my-10">
                    <h2 class="fs-2x fw-bolder mb-10">Hola!</h2>
                    <p class="text-gray-400 fs-4 fw-bold mb-10">Al parecer no tienes ningun servicio.
                    <br> Ponga en marcha su CRM añadiendo su primer servicio</p>
                    <a href="{{ route('service.create') }}" class="btn btn-primary">Agregar servicio</a>
                </div>
                <div class="text-center px-4 ">
                    <img class="img-fluid col-6" alt="" src="{{ asset('assets/media/ilustrations/work.png') }}">
                </div>
            </div>
        </div>
        
    @endif

    @section('footer')
        <script>
            function confirmDestroy(id){
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "No podrá recuperar este servicio y todas las facturas relacionadas, pagos y gastos.",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> <span class='font-weight-bold'>Si, eliminar</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i>  <span class='text-dark font-weight-bold'>No, cancelar",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
        </Script>
    @endsection
</div>
