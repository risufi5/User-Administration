<!-- Modal -->
<div class="modal fade" id="changeProfilePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changeProfilePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfilePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-change-password-form></x-change-password-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="changeProfilePasswordBtn">Change Password</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="changeProfilePasswordCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
