<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <section class=" p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h4 class="text-center">Enter OTP here</h4>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('account.otpconfig')}}" method="post">
                                @csrf
                                <div class="row gy-3 overflow-hidden">
                                    @if (Session::has('success'))
                                    <div class="col-md-10 mt-4 data">
                                        <div class="alert alert-success" role="alert">
                                            {{Session::get('success')}}
                                        </div>
                                    </div>
                                    @endif
                                    @if (Session::has('error'))
                                    <div class="col-md-10 mt-4 data">
                                        <div class="alert alert-danger" role="alert">
                                            {{Session::get('error')}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="number"  value="{{old('otp')}}" class="@error('otp') is-invalid @enderror form-control" name="otp" id="otp" placeholder="name@example.com">
                                            <label for="otp" class="form-label">OTP</label>
                                            @error('otp')
                                            <p class="invalid-feedback">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary py-3" type="submit">submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
<script>
    let getdiv = document.querySelector('.data');
    setTimeout(() => {
        getdiv.classList.add('d-none');
    }, 3000);
    </script>
</html>