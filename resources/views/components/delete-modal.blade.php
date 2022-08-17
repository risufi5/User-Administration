<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <x-delete-form></x-delete-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleteUserBtn">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="deleteUserCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
