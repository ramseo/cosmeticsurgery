@extends('backend.layouts.app')

@section('title') {{$user->name}}'s Profile @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon=''></x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection


@section('content')

<div class="header-space"></div>
<div class="cit">
    <div class="container">
        <h2>
            <?= "Dr." . " " . $user->first_name . " " . $user->last_name . " " . "Profile" ?>
        </h2>
    </div>
</div>

<section class="profile-form-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h4 class="card-title mb-0">
                    <i class="c-icon cil-people"></i>
                    <span class="text-capitalize"><?= $album->name ?></span>
                    <small class="text-muted">Category Images</small>
                </h4>
                <div class="small text-muted">
                    Category {{ Str::title('Images') }} Management Dashboard
                </div>

                <div class="dropzone-div">
                    <div class="dropzone" id="file-dropzone"></div>
                </div>
                <small>
                    Server max upload size is : <?= ini_get("upload_max_filesize") ?>
                </small>
                <div class="container">
                    <div class="row">
                        <div class="gallery1 row">
                            @foreach ($images as $image)
                            <div class="col-3 gallery-col">
                                <div class="gallery-img-col">
                                    <img class="img-fluid" src="<?= asset('storage/album') . '/' . $image->album_id . '/' . $image->name ?>" alt="img" />
                                </div>
                                <div class="gallery-action-col text-center">
                                    <a onclick="return confirm('Are you sure?')" href="<?= url("admin/customer/results/image/delete/$image->id") ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="btn-toolbar float-right vendor-img-bk-btn" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="<?= url("admin/users/profile/$user->id/edit") ?>" class="btn btn-warning" data-toggle="tooltip" title="{{__('labels.backend.cancel')}}">
                        <i class="fa fa-reply"></i>
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

@push ('after-scripts')
<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileDropzone = {
        url: '<?= url("profile/results/image/store/$album->id") ?>',
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        maxFilesize: 1000,
        headers: {
            'X-CSRF-TOKEN': "<?= csrf_token() ?>"
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'POST',
                url: '<?= url('admin/customer/results/image/remove') ?>',
                data: {
                    "_token": "<?= csrf_token() ?>",
                    name: name
                },
                success: function(data) {
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(file);
        },
    }
</script>
@endpush