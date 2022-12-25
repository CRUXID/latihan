@extends('layouts.app')

@section('title', 'Master Produk')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="row">
          <div class="col m-3 mb-0">
            <a onclick="addForm()" class="btn btn-primary text-white">Tambah</a>
            <a onclick="deleteAll()" class="btn btn-danger text-white">Hapus</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card-body table-responsive text-nowrap m-3" style="height: 400px;">
            <form method="POST" id="form-produk">
            {{ csrf_field() }}
              <table class="table">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="select-all" value="1"></th>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0"></tbody>
              </table>
            </form>
            </div>
          </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    @include('produk.form')
@endsection

@section('script')
    <script type="text/javascript">
        var table, save_method;
        $(function() {
            table = $('.table').DataTable({
                "processing": true,
                "serverside": true,
                "ajax": {
                    "url": "{{ route('produk.data') }}",
                    "type": "GET"
                },
                'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                }],
                'order': [1, 'asc']
            });

            $('#select-all').click(function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });
        
            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('produk.store') }}";
                    else url = "produk/" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        dataType: "JSON",
                        success: function(data) {
                            if(data.msg=="error"){
                                alert('Kode Produk sudah ada!');
                                $('#kode').focus().select();
                                return false;
                            } else {
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                            }
                        },
                        error: function() {
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Produk');
            $('#kode').attr('readonly', false);
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "produk/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Produk');
        
                    $('#id').val(data.id_produk);
                    $('#kode').val(data.kode_produk).attr('readonly', true);
                    $('#nama').val(data.nama_produk);
                    $('#kategori').val(data.id_kategori);
                    $('#harga').val(data.harga);
                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "produk/" + id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }
        
        function deleteAll() {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dihapus!');
            } else if (confirm('Apakah yakin data akan dihapus?')) {
                $.ajax({
                    url: "produk/hapus",
                    type: "POST",
                    data: $('#form-produk').serialize(),
                    success: function(data) {
                        table.ajax.reload();
                        $('input:checked').prop('checked', false);
                    },
                    error: function() {
                        alert("Tidak dapat menghapus data!");
                    }
                });
            }
        }
    </script>
@endsection