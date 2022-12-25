@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="row">
          <div class="col m-3 mb-0">
            <a onclick="addForm()" class="btn btn-primary text-white">Tambah</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card-body table-responsive text-nowrap m-3" style="height: 400px;">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0"></tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    @include('kategori.form')
@endsection

@section('script')
    <script type="text/javascript">
        var table, save_method;
        $(function() {
            table = $('.table').DataTable({
                "processing": true,
                "ajax": {
                    "url": "{{ route('kategori.data') }}",
                    "type": "GET"
                }
            });
        
            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('kategori.store') }}";
                    else url = "kategori/" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
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
            $('.modal-title').text('Tambah Kategori');
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "kategori/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Kategori');
        
                    $('#id').val(data.id_kategori);
                    $('#nama').val(data.nama_kategori);
                },
                error: function() {
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    url: "kategori/" + id,
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
    </script>
@endsection