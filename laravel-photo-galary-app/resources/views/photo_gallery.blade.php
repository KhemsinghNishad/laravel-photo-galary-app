<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }
        .photo img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .photo p {
            text-align: center;
            margin-top: 6px;
            color: #555;
        }
        .row-separator { margin-bottom: 1.2rem; }
    </style>
</head>

<body class="p-4">

<div class="container">

    <h2 class="text-center mb-4">Photo Gallery</h2>

    <div class="text-center mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
            Add Photo
        </button>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>

    <!-- =================== GALLERY =================== -->
    <div class="gallery">

        @foreach($rows as $row)

            @if($row['type'] === 'vertical')
                <div class="row row-separator">
                    @foreach($row['items'] as $img)
                        <div class="col-md-6 col-sm-12 photo">
                            <img src="{{ asset($img->image_path) }}" alt="">
                            <p>{{ $img->name }} (Vertical)</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($row['type'] === 'vertical-single')
                <div class="row row-separator">
                    <div class="col-md-6 col-sm-12 photo">
                        <img src="{{ asset($row['items'][0]->image_path) }}" alt="">
                        <p>{{ $row['items'][0]->name }} (Vertical)</p>
                    </div>
                </div>
            @endif

            @if($row['type'] === 'horizontal')
                <div class="row row-separator">
                    <div class="col-12 photo">
                        <img src="{{ asset($row['items'][0]->image_path) }}" alt="">
                        <p>{{ $row['items'][0]->name }} (Horizontal)</p>
                    </div>
                </div>
            @endif

        @endforeach

    </div>
    <!-- ================= END GALLERY ================= -->

</div>


<!-- =================== ADD PHOTO MODAL =================== -->
<div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="addPhotoLabel">Add New Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Image Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>View Type</label>
                    <select name="view_type" class="form-select" required>
                        <option value="">Select</option>
                        <option value="vertical">Vertical</option>
                        <option value="horizontal">Horizontal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Upload Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
