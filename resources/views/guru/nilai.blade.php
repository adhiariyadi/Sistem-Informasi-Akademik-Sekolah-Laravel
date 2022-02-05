@extends('template_backend.home')
@section('heading', 'Deskripsi Nilai')
@section('page')
  <li class="breadcrumb-item active">Deskripsi Nilai</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Deskripsi Nilai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('nilai.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id" value="{{ $nilai->id }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_gur">Nama Guru</label>
                            <input type="text" id="nama_gur" name="nama_gur" value="{{ $guru->nama_guru }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="guru_id">Kode Mapel</label>
                            <input type="text" id="guru_id" name="guru_id" value="{{ $guru->kode }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="predikat_a">Predikat A</label>
                            <textarea class="form-control" required name="predikat_a" id="predikat_a" rows="4">{{ $nilai->deskripsi_a }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="predikat_c">Predikat C</label>
                            <textarea class="form-control" required name="predikat_c" id="predikat_c" rows="4">{{ $nilai->deskripsi_c }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <input type="text" id="mapel" name="mapel" value="{{ $guru->mapel->nama_mapel }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="text" onkeypress="return inputAngka(event)" maxlength="2" value="{{ $nilai->kkm }}" id="kkm" name="kkm" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="predikat_b">Predikat B</label>
                            <textarea class="form-control" required name="predikat_b" id="predikat_b" rows="4">{{ $nilai->deskripsi_b }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="predikat_d">Predikat D</label>
                            <textarea class="form-control" required name="predikat_d" id="predikat_d" rows="4">{{ $nilai->deskripsi_d }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
        window.location="{{ url('/') }}";
        });
    });
    $("#NilaiGuru").addClass("active");
    $("#liNilaiGuru").addClass("menu-open");
    $("#DesGuru").addClass("active");
</script>
@endsection