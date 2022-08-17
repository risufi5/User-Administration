<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-register-form></x-register-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="addUserBtn">Register</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="addUserCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
