<div class="modal fade" id="modalProses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form id="form_proses">
                @csrf
                <div class="modal-body">
                    <label for="">Status Peminjaman</label>
                    <select name="status_peminjaman" id="status_peminjaman" class="form-control">
                        <option selected disabled> Pilih status</option>
                        <option value="Pengajuan">Pengajuan</option>
                        <option value="Tolak">Tolak</option>
                        <option value="Terima">Terima</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <input type="hidden" class="form-control" id="id" name="id">

                    <label class="mt-3">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" disabled placeholder="Masukan keterangan jika pengajuan ditolak">
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                    <button type="submit" class="btn btn-primary" id="tombol_proses">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>