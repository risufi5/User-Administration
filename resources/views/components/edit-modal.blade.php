<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-edit-form></x-edit-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editUserBtn">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="editUserCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
