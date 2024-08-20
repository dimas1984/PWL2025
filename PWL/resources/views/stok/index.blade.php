@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pengguna</h3>
            <div class="card-tools">
                <a href="{{ url('/stok/create') }}" class="btn btn-primary">Tambah Data</a>
                <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <!-- untuk Filter data -->
            <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                            <div class="col-md-3">
                                <select name="filter_user" class="form-control form-control-sm filter_user">
                                    <option value="">- Semua -</option>
                                    @foreach($kasir as $l)
                                        <option value="{{ $l->user_id }}">{{ $l->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Kasir</small>
                            </div>
                            <div class="col-md-3">
                                <select name="filter_barang" class="form-control form-control-sm filter_barang">
                                    <option value="">- Semua -</option>
                                    @foreach($barang as $l)
                                        <option value="{{ $l->barang_id }}">{{ $l->barang_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Barang</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-sm table-hover table-striped" id="data-stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Petugas</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = ''){
        $('#myModal').load(url,function(){
            $('#myModal').modal('show');
        });
    }

    var dataUser;
    $(document).ready(function() {
        dataUser = $('#data-stok').DataTable({
            // serverSide: true, jika ingin menggunakan server side processing
            serverSide: true,
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d){
                    d.filter_user = $('.filter_user').val();
                    d.filter_barang = $('.filter_barang').val();
                }
            },
            columns: [
                {
                    data: "No_Urut", // nomor urut dari laravel datatable addIndexColumn()
                    className: "text-center",
                    width: "5%",
                    orderable: false,
                    searchable: false
                },{
                    data: "username",
                    className: "",
                    width: "10%",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                },{
                    data: "barang_nama",
                    className: "",
                    width: "35%",
                    orderable: true,
                    searchable: true
                },{
                    data: "stock_tanggal",
                    className: "",
                    width: "15%",
                    orderable: true,
                    searchable: true
                },{
                    data: "stock_jumlah",
                    className: "",
                    width: "10%",
                    orderable: true,
                    searchable: true
                },{
                    data: "aksi",
                    width: "15%",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // searching by enter key
        $('.dataTables_filter input').unbind().bind('keyup', function(e){
            if(e.keyCode == 13){
                dataUser.search(this.value).draw();
            }
        });

        // listener dropdown filter
        $('.filter_user, .filter_barang').on('change', function(){
            dataUser.draw();
        });


    });
</script>
@endpush

