<div class="modal fade" id="modalUploadSurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload ulang surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <form id="form_upload" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="idupload" name="idupload">

                    <label class="mt-3">Upload ulang surat</label>
                    <input type="file" name="surat_pinjam" id="surat_pinjam" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                    <button type="submit" class="btn btn-primary" id="tombol_upload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>