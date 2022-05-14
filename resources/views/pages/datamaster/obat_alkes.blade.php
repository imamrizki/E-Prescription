@extends('layouts.master')
@section('title', 'Obat & Alkes')
@section('obat_alkes_active', 'active')

@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="text-white font-weight-600">Obat & Alkes</h1>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt--7 mb-5">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Data List</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Obat & Alkes
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Created Date</th>
                                        <th scope="col">Modified Date</th>
                                        <th scope="col" class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($obatalkes) > 0)
                                        @foreach ($obatalkes as $item)
                                            <tr>
                                                <td>{{ $item->obatalkes_kode }}</td>
                                                <td>{{ $item->obatalkes_nama }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->created_date }}</td>
                                                <td>{{ $item->modified_date }}</td>
                                                <td class="text-right">
                                                    <a href="#" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
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
                                {!! $obatalkes->links('vendor.pagination.bootstrap-4') !!}
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection