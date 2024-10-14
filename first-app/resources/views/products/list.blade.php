<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>11 curd opreation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-light text-center">Simple Laravel 11 CRUD</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('products.create')}}" class="btn btn-dark ">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4 data">
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="col-md-6   mt-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-light">
                        <h3>product </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productsData as $key=>$product )
                                <tr class="{{$key %2 == 0 ?'table-danger':'table-info'}}">
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>@if ($product->image != "")
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" height="40" width="40" alt="">
                                        @else
                                        <img src="https://st4.depositphotos.com/14953852/24787/v/450/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg" height="40" width="40" alt="">
                                        @endif
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                                    <td class="">
                                        <form id="delete-form-{{$product->id}}" action="{{route('products.destroy', $product->id)}}" method="post" style="display:inline;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-light btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        let getdiv = document.querySelector('.data');
        setTimeout(() => {
            getdiv.classList.add('d-none');
        }, 3000);
    </script>
</body>

</html>