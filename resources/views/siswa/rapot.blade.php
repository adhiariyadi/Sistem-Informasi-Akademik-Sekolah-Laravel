@extends('template_backend.home')
@section('heading', 'Nilai Rapot')
@section('page')
  <li class="breadcrumb-item active">Nilai Rapot</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Nilai Rapot Siswa</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>No Induk Siswa</td>
                        <td>:</td>
                        <td>{{ Auth::user()->no_induk }}</td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td class="text-capitalize">{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>:</td>
                        <td>{{ $kelas->guru->nama_guru }}</td>
                    </tr>
                    @php
                        $bulan = date('m');
                        $tahun = date('Y');
                    @endphp
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                            @if ($bulan > 6)
                                {{ 'Semester Ganjil' }}
                            @else
                                {{ 'Semester Genap' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td>
                            @if ($bulan > 6)
                                {{ $tahun }}/{{ $tahun+1 }}
                            @else
                                {{ $tahun-1 }}/{{ $tahun }}
                            @endif
                        </td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h4 class="mb-3">A. Sikap</h4>
                        @if ($Spai && $Sppkn)
                            @php
                                $sikap = ((($Spai->sikap_1 + $Spai->sikap_2 + $Spai->sikap_3) / 3) + (($Sppkn->sikap_1 + $Sppkn->sikap_2 + $Sppkn->sikap_3) / 3)) / 2;
                                $sikap = (int) $sikap;
                            @endphp
                            @if ($sikap == 4)
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Sangat Baik!</h5>
                                    Students show very good attitude.
                                </div>
                            @elseif ($sikap == 3)
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Baik!</h5>
                                    Students show good manners.
                                </div>
                            @elseif ($sikap == 2)
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Cukup!</h5>
                                    Students show sufficient attitude.
                                </div>
                            @else
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Kurang!</h5>
                                    Students show lack of attitude.
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning alert-dismissible">
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                Warning. Your Attitude Value does not exist yet
                            </div>
                        @endif
                    </div>
                    <div class="col-12 mb-3">
                        <h4 class="mb-3">B. Pengetahuan dan Keterampilan</h4>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Mata Pelajaran</th>
                                    <th rowspan="2">KKM</th>
                                    <th class="ctr" colspan="3">Pengetahuan</th>
                                    <th class="ctr" colspan="3">Keterampilan</th>
                                </tr>
                                <tr>
                                    <th class="ctr">Nilai</th>
                                    <th class="ctr">Predikat</th>
                                    <th class="ctr">Deskripsi</th>
                                    <th class="ctr">Nilai</th>
                                    <th class="ctr">Predikat</th>
                                    <th class="ctr">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $val => $data)
                                    <tr>
                                        <?php $data = $data[0]; ?>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->mapel->nama_mapel }}</td>
                                        {{-- <td class="ctr">{{ $data->kkm($data->nilai($val)['guru_id']) }}</td> --}}
                                        <td class="ctr">{{ $data->kkm($data->guru_id) }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['p_nilai'] }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['p_predikat'] }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['p_deskripsi'] }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['k_nilai'] }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['k_predikat'] }}</td>
                                        <td class="ctr">{{ $data->nilai($val)['k_deskripsi'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
    <script>
        $("#RapotSiswa").addClass("active");
    </script>
@endsection