@extends('layouts.layout-guest')

@section('section')

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<div class=" container mt-3">
    <div class="row">
        <div class="col-lg-12 margin-tb">
    <div class="card body shadow rounded" style="width: 150%; left: 29%;">
        <div class="card-body border border-secondary" style="background-color: #DCD6F7">
            <div class="card-header" style="background-color: #DCD6F7">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <h1>Account</h1>
                    </li>
                </ul>
            </div>
            <br>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('change-pass') }}">
                {{ csrf_field() }}

                <div class="form-group row{{ $errors->has('current_password') ? ' has-error' : '' }}">
                    <label for="current-password" class="col-sm-4 col-form-label">Current Password</label>

                    <div class="col-sm-8">
                        <input id="current-password" type="password" class="form-control" name="current_password"
                            required>

                        @if ($errors->has('current_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row{{ $errors->has('new_password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-sm-4 col-form-label">New Password</label>

                    <div class="col-sm-8">
                        <input id="new-password" type="password" class="form-control" name="new_password" required>

                        @if ($errors->has('new_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new-password-confirm" class="col-sm-4 col-form-label">Confirm New Password</label>

                    <div class="col-sm-8">
                        <input id="new-password-confirm" type="password" class="form-control" name="confirm_password"
                            required>
                    </div>
                </div>
                <br>
                <div class="form-group text-center">
                    <div class="col-md-14 col-md-offset-4">
                        <button type="submit" class="btn text-light" style="background-color: #000957">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>


@endsection
