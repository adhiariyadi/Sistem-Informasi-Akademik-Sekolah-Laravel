@extends('template_backend.home')
@section('heading', 'Ubah Foto')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">Ubah Foto</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h3 class="card-title">Form ubah foto</h3>
            </div>
              <div class="col-md-6">
                <h3 class="card-title">Foto Saat ini</h3>
              </div>
          </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('pengaturan.ubah-foto') }}"  enctype="multipart/form-data" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama Guru</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="foto">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
                                <label class="custom-file-label" for="foto">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if (Auth::user()->role == 'Guru')
                        <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                        <img src="{{ asset(Auth::user()->guru(Auth::user()->id_card)->foto) }}" class="img img-responsive" alt="" width="30%" />
                    @else
                        <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                        <img src="{{ asset(Auth::user()->siswa(Auth::user()->no_induk)->foto) }}" class="img img-responsive" alt="" width="30%" />
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <a href="{{ route("profile") }}" class="btn btn-default"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-upload"></i> &nbsp; Upload</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection