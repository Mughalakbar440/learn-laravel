<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>11 CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-light text-center">Simple Laravel 11 CRUD</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10 col-md-12 d-flex justify-content-end">
                <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 mt-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-light">
                        <h3>Edit Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label h5" for="Name">Name</label>
                                <input type="text" class=" @error('name') is-invalid @enderror form-control" id="Name" value="{{ old('name')}}" name="name" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label h5" for="Sku">Sku</label>
                                <input type="text" class="@error('sku') is-invalid @enderror form-control" id="Sku" value="{{ old('sku')}}" name="sku" placeholder="Sku">
                                @error('sku')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label h5" for="Price">Price</label>
                                <input type="number" class="@error('price') is-invalid @enderror form-control" id="Price" value="{{ old('price')}}" name="price" placeholder="Price">
                                @error('price')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label h5" for="Description">Description</label>
                                <textarea class="form-control" id="Description" name="description" placeholder="Description">{{ old('description')}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label h5" for="Image">Image</label>
                                <input type="file" class="form-control" id="Image" value="{{ old('image')}}" name="image">
                            </div>

                            <button type="submit" class="btn btn-dark">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
