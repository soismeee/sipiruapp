@extends('layout.main')
@push('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="/properti/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="/properti/plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->
    <link href="/properti/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="/properti/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
@endpush
@section('container')
    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-spacing">
            <div class="d-flex justify-content-end mb-3">
                <div>
                    <label for="tanggal">Cari tanggal peminjaman</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal">
                </div>
            </div>
            <div class="widget-content widget-content-area br-6">
                <table id="data-riwayat" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Invoice</th>
                            <th>Klien</th>
                            <th>Sesi</th>
                            <th>Informasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="/properti/plugins/table/datatable/datatables.js"></script>
    <script>

        const table = $('#data-riwayat').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, 'All']
            ],
            "pageLength": 10,
            processing: true,
            serverSide: true,
            responseive: true,
            ajax: {
                url: "{{ url('json_rp') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                    d.tanggal = $("#tanggal").val()
                }
            },
            columns: [{
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "render": function(data, type, row, meta) {
                        return row.id
                    }
                },
                {
                    "render": function(data, type, row, meta) {
                        return row.nama_peminjam + "<br /> CP : " + row.klien.no_telepon
                    }
                },
                {
                    "render": function(data, type, row, meta) {
                        return row.jadwal_aula.nama_sesi
                    }
                },
                {
                    "render": function(data, type, row, meta) {
                        return "Hal : " + row.keperluan + "<br /> Tgl : " + row.tanggal
                    }
                },
                {
                    "render": function(data, type, row, meta) {
                        if (row.keperluan !== "Selesai") {
                            return "Berlangsung";
                        } else {
                            return "Selesai";
                        }
                    }
                },
            ]
        });

        $(document).on('change', '#tanggal', function(e){
            e.preventDefault();
            table.ajax.reload();
        });
    </script>
@endpush
