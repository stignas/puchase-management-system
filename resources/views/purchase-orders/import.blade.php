<form action="{{ route('po-import', $purchaseOrder) }}" method="POST"
      enctype="multipart/form-data">
    @csrf

    <div class="modal-content">
        <input class="form-control form-control-sm m-1" type="file" name="file">
        <div class="d-flex align-items-center">
            <button class="btn btn-secondary w-25 m-auto" type="submit">Upload</button>
            <div id="close" class="close">&times;</div>
        </div>
    </div>
</form>


