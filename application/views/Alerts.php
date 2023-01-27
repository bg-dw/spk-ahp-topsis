<!-- small Modal -->
<?php if ($this->session->flashdata('alert')) : ?>
    <div id="alert" class="modal fade">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Pemberitahuan!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $this->session->flashdata('alert'); ?></p>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
<?php endif; ?>