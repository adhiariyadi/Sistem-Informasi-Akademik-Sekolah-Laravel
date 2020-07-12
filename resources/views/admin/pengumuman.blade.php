@extends('template_backend.home')
@section('heading', 'Pengumuman')
@section('page')
  <li class="breadcrumb-item active">Pengumuman</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <form class="form-group" action="{{ route('admin.pengumuman.simpan') }}" method="post">
                @csrf
                <div class="card-header">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        Simpan &nbsp; <i class="nav-icon fas fa-save"></i>
                    </button>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body pad">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{ $pengumuman->id }}">
                        <textarea class="textarea @error('isi') is-invalid @enderror" name="isi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $pengumuman->isi }}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#Pengumuman").addClass("active");
    </script>
@endsection