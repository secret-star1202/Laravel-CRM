<div class="row" x-data="app()">
    <div class="col-xl-4">
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <span class="svg-icon svg-icon-primary svg-icon-10x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                </div>
                <p class="text-center font-weight-normal font-size-lg pb-7">Transferir prospectos</p>
                <a href="#" x-on:click="prospect()" class="btn btn-success btn-shadow-hover font-weight-bolder w-100 py-3">Mostrar prospectos</a>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 14-->
    </div>
    <div class="col-xl-4">
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <span class="svg-icon svg-icon-primary svg-icon-10x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                </div>
                <p class="text-center font-weight-normal font-size-lg pb-7">Transferir clientes</p>
                <a href="#" x-on:click="client()" class="btn btn-success btn-shadow-hover font-weight-bolder w-100 py-3">Mostrar clientes</a>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 14-->
    </div>
    
    @include('user.partials._transfer-prospect-modal')
    
    @section('footer')
        <script>
            function app() {

                return {
                    prospect() { 
                        $('#transferProspectModal').modal('show');                 
                    },
                    toggleAllCheckboxes() {

                        KTApp.blockPage({
                            overlayColor: '#828383',
                            state: 'primary',
                            message: 'Seleccionando todos los prospectos'
                        });

                        this.selectall = !this.selectall

                        if(this.selectall){
                            @this.call('addAllProspect');
                        }else{
                            @this.call('removeAllProspect');
                        }

                        checkboxes = document.querySelectorAll('.checkbox');
                        [...checkboxes].map((el) => {
                            el.checked = this.selectall;
                        })
                    },
                    
                }
            }
        </script>
    @endsection
</div>

