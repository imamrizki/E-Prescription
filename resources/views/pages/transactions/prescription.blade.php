@extends('layouts.master')
@section('title', 'Prescriptions')
@section('prescription_active', 'active')

@section('content')
    <div id="dropdownObatAlkes" class="d-none">
        <option value="" selected disabled>Pilih Obat</option>
        {!! \App\Models\ObatAlkes::dropdownObatAlkes() !!}
    </div>

    <div id="dropdownSignaPolicy" class="d-none">
        <option value="" selected disabled>Pilih Signa</option>
        {!! \App\Models\SignaPolicy::dropdownSignaPolicy() !!}
    </div>

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="text-white font-weight-600">Prescriptions</h1>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt--7 mb-5">
        <div class="row mb-4">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <form data-action="{{ route('submit_resep') }}" method="POST" id="submitResep">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Buat Resep</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <h6 class="heading-small text-muted">Non Racikan</h6>
                                        </div>
                                        <div class="col-2 text-right">
                                            <a href="javascript:;" class="btn btn-primary add_non_racikan">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div id="component-non-racikan">
                                        <p class="text-muted initial-message-non-racik">* Tekan tombol tambah (+) untuk menambahkan !</p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <h6 class="heading-small text-muted">Racikan</h6>
                                        </div>
                                        <div class="col-2 text-right">
                                            <a href="javascript:;" class="btn btn-primary add_racikan">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div id="component-racikan">
                                        <p class="text-muted initial-message-racik">* Tekan tombol tambah (+) untuk menambahkan !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Draft Resep</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Kode Resep</th>
                                        <th scope="col">Created Date</th>
                                        <th scope="col">Modified Date</th>
                                        <th scope="col" class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($resep) > 0)
                                        @foreach ($resep as $item)
                                            <tr>
                                                <td><strong>{{ $item->resep_kode }}</strong></td>
                                                <td>{{ $item->created_date }}</td>
                                                <td>{{ $item->last_modified_date }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('pdf_resep', Crypt::encryptString($item->resep_id)) }}" target="_blank" class="btn btn-sm btn-success">
                                                        <i class="fa fa-print"></i> Cetak PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Data tidak tersedia !</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
    
                            <div class="card-footer py-4">
                                {!! $resep->links('vendor.pagination.bootstrap-4') !!}
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                $('.select-non-racik').selectpicker();
                var dropdownObatAlkes = $('#dropdownObatAlkes').html();
                var dropdownSignaPolicy = $('#dropdownSignaPolicy').html();

                var counter_nonracik = 0;
                $('.add_non_racikan').click(function() {
                    showLoading();

                    setTimeout(() => {
                        $('.initial-message-non-racik').addClass('d-none');
                        counter_nonracik+=1;
                        var html = '\
                            <div class="row-non-racik">\
                                <div class="row">\
                                    <div class="col-lg-10">\
                                        <div class="form-group">\
                                            <select class="form-control select-non-racik" name="nonracik_obatalkes_id[]" data-dropup-auto="false" data-live-search="true">\
                                                '+dropdownObatAlkes+'\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-2">\
                                        <div class="form-group text-right">\
                                            <a href="javascript:;" class="btn btn-danger remove_non_racikan">\
                                                <i class="fa fa-trash"></i>\
                                            </a>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="row">\
                                    <div class="col-lg-8">\
                                        <div class="form-group">\
                                            <select class="form-control select-non-racik" name="nonracik_signa_id[]" data-dropup-auto="false" data-live-search="true">\
                                                '+dropdownSignaPolicy+'\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-4">\
                                        <div class="form-group">\
                                            <input type="number" class="form-control form-control-alternative" name="nonracik_jumlah[]" placeholder="Jumlah">\
                                        </div>\
                                    </div>\
                                </div>\
                                <hr class="my-4">\
                            </div>\
                        ';
    
                        $('#component-non-racikan').append(html);
                        $('.select-non-racik').selectpicker();
                        $('.select-non-racik').selectpicker('refresh');
                    }, 400);
                    hideLoading();
                });

                $(document).on('click', '.remove_non_racikan', function () {
                    $(this).closest('.row-non-racik').remove();
                    if ($('#component-non-racikan .row-non-racik').length == 0) {
                        $('.initial-message-non-racik').removeClass('d-none');
                    }
                });

                // ================================================================ //

                var counter_racik = 0;
                $('.add_racikan').click(function() {
                    showLoading();

                    setTimeout(() => {
                        $('.initial-message-racik').addClass('d-none');
                        counter_racik+=1;
                        var html = '\
                            <div class="row-racik">\
                                <div class="row">\
                                    <div class="col-lg-10">\
                                        <div class="form-group">\
                                            <div class="form-group">\
                                                <input type="text" class="form-control form-control-alternative" name="racik_resep_racikan_nama[]" placeholder="Input Nama Racikan">\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-2">\
                                        <div class="form-group text-right">\
                                            <a href="javascript:;" class="btn btn-danger remove_racikan">\
                                                <i class="fa fa-trash"></i>\
                                            </a>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="row">\
                                    <div class="col-lg-12">\
                                        <div class="form-group">\
                                            <select class="form-control select-racik" name="racik_signa_id[]" data-dropup-auto="false" data-live-search="true">\
                                                '+dropdownSignaPolicy+'\
                                            </select>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="row">\
                                    <div class="col-lg-6">\
                                        <div class="form-group">\
                                            <select class="form-control select-racik" name="racik_obatalkes_id[]" data-dropup-auto="false" data-live-search="true">\
                                                '+dropdownObatAlkes+'\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-4">\
                                        <div class="form-group">\
                                            <input type="number" class="form-control form-control-alternative" name="racik_jumlah[]" placeholder="Jumlah">\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-2">\
                                        <div class="form-group text-right">\
                                            <a href="javascript:;" class="btn btn-info add_sub_racikan">\
                                                <i class="fa fa-plus"></i>\
                                            </a>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div id="component-sub-racikan-'+counter_racik+'">\
                                    \
                                </div>\
                                <hr class="my-4">\
                            </div>\
                        ';
    
                        $('#component-racikan').append(html);
                        $('.select-racik').selectpicker();
                        $('.select-racik').selectpicker('refresh');
                    }, 400);
                    hideLoading();

                    // sub racikan
                    var counter_sub_racik = 0;
                    $(document).on('click', '.add_sub_racikan', function () {
                        counter_sub_racik+=1;
                        var html = '\
                            <div class="row-sub-racik">\
                                <div class="row">\
                                    <div class="col-lg-6">\
                                        <div class="form-group">\
                                            <select class="form-control select-racik" name="racik_obatalkes_id[]" data-dropup-auto="false" data-live-search="true">\
                                                '+dropdownObatAlkes+'\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-4">\
                                        <div class="form-group">\
                                            <input type="number" class="form-control form-control-alternative" name="racik_jumlah[]" placeholder="Jumlah">\
                                        </div>\
                                    </div>\
                                    <div class="col-lg-2">\
                                        <div class="form-group text-right">\
                                            <a href="javascript:;" class="btn btn-warning remove_sub_racikan">\
                                                <i class="fa fa-minus"></i>\
                                            </a>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        ';

                        $('#component-sub-racikan-'+counter_racik).append(html);
                        $('.select-racik').selectpicker();
                        $('.select-racik').selectpicker('refresh');
                    });

                    $(document).on('click', '.remove_sub_racikan', function () {
                        $(this).closest('.row-sub-racik').remove();
                    });

                });

                $(document).on('click', '.remove_racikan', function () {
                    $(this).closest('.row-racik').remove();
                    if ($('#component-racikan .row-racik').length == 0) {
                        $('.initial-message-racik').removeClass('d-none');
                    }
                });

                // $(document).on('click', '.add_obatalkes', function () {
                //     showLoading();

                //     var url = $(this).data('url');
                //     $.ajax({
                //         type    : "GET",
                //         url     : url,
                //         success: function(response) {
                //             removeSizeModal();
                //             $('#modal-size').addClass(response.size);
                //             $('#modal-title').html(response.title);
                //             $('#modal-content').html(response.content);
                //             $('#myModal').modal('show');
                //             hideLoading();

                //             submitFormModal();
                //         },
                //         error: function(response) {
                //             console.log('error modal');
                //         }
                //     }); 
                // });

                submitResep();

                function submitResep() {
                    $("#submitResep").submit(function(e) {
                        e.preventDefault();
                        showLoading();

                        let method = $(this).attr('method');
                        let url = $(this).data('action');
                        let data = $(this).serialize();

                        setTimeout(function(){
                            $.ajaxSetup({
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                }
                            });
                            $.ajax({
                                type: method,
                                url: url,
                                data: data,
                            })
                            .done(function(response) {
                                hideLoading();
                                alertSuccess(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 1600);
                            })
                            .fail(function(response) {
                                hideLoading();
                                $('input,textarea,select').on('keydown keypress keyup click change',function(){
                                    $(this).removeClass('is-invalid'); 
                                    $(this).closest( "div.form-group" ).removeClass('is-invalid');
                                    $(this).closest( "div" ).removeClass('kt-option');                                                                                                            
                                    $(this).nextAll('.text-danger').hide();
                                });

                                validateInputErrors(data.responseJSON.errors);
                            });
                        }, 200);
                    });
                }

            });
        </script>
    @endpush
@endsection