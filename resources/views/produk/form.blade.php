<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" class="form-horizontal" data-toggle="validator">
            {{ csrf_field() }} {{ method_field('POST') }}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
            <div class="row">
                <div class="col mb-3">
                    <label for="kode" class="form-label">Kode Produk</label>
                    <input type="number" id="kode" name="kode" class="form-control" autofocus required />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" id="nama" name="nama" class="form-control" required />
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="control-label">Kategori</label>
                <div class="col mb-3">
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $data)
                            <option value="{{ $data->id_kategori }}">{{ $data->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" id="harga" name="harga" class="form-control" autofocus required />
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>