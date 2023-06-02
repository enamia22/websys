<div class="modal fade" id="deleteWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Deleting record from database') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p aria-hidden="true">
                    {{ __('Are you sure you want to delete record with ID №') }}
                    <span id="ms_num">1</span>
                    {{ __('? This operation will be undone. Press Yes to proceed, or No to cancel.') }}
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <form id="ms_receive" method="post" action="">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Yes (delete)') }}</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('No (cancel)') }}</button>
            </div>
        </div>
    </div>
</div>
