@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('registerx')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input class="form-control" type="text" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Identitas</label>
                            <input class="form-control" onkeypress="return hanyaAngka(event)" type="text" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pekerjaan</label>
                            <input class="form-control" type="text" name="pekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Instansi</label>
                            <input class="form-control" type="text" name="instansi" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto KTP/KTM/Identitas Lain</label>
                            <input type="file" required name="filex" accept=".pdf,.img,.png,.jpg,.jpeg" />
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))return false;
            return true;
        }
    </script>
@endsection