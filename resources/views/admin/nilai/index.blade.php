@extends('template_backend.home')
@section('heading', 'Data Nilai')
@section('page')
  <li class="breadcrumb-item active">Data Nilai</li>
@endsection
@section('content')
@php
    $no = 1;
@endphp
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Kode Mapel</th>
                <th rowspan="2">Guru Mata Pelajaran</th>
                <th rowspan="2">KKM</th>
                <th colspan="4" class="text-center">Predikat</th>
              </tr>
              <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($guru as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->kode }}</td>
                  <td>
                      <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                      <p class="card-text"><small class="text-muted">{{ $data->nama_guru }}</small></p>
                  </td>
                  @if ($data->dsk($data->id))
                    <td>{{ $data->dsk($data->id)->kkm }}</td>
                    <td>{{ $data->dsk($data->id)->deskripsi_a }}</td>
                    <td>{{ $data->dsk($data->id)->deskripsi_b }}</td>
                    <td>{{ $data->dsk($data->id)->deskripsi_c }}</td>
                    <td>{{ $data->dsk($data->id)->deskripsi_d }}</td>
                  @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Deskripsi").addClass("active");
    </script>
@endsection