<div class="d-flex justify-content-center align-items-center">
    <a class="btn btn-sm btn-icon btn-info w-30px h-30px mx-1" donwload
        href="{{ route('upload.download', $query->id) }}">
        <span class="fa fa-file"></span>
    </a>
    <button class="btn btn-sm btn-icon btn-danger w-30px h-30px mx-1 btn-delete-upload" data-id="{{ $query->id }}">
        <span class="fa fa-times"></span>
    </button>
</div>
