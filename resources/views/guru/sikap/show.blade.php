@extends('template_backend.home')
@section('heading', 'Entry Nilai Sikap')
@section('page')
  <li class="breadcrumb-item active">Entry Nilai Sikap</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Entry Nilai Sikap</h3>
      </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
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
                    <tr>
                        <td>Jumlah Siswa</td>
                        <td>:</td>
                        <td>{{ $siswa->count() }}</td>
                    </tr>
                    <tr>
                        <td>Mata Pelajaran</td>
                        <td>:</td>
                        <td>{{ $guru->mapel->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <td>Guru Mata Pelajaran</td>
                        <td>:</td>
                        <td>{{ $guru->nama_guru }}</td>
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
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="ctr">No.</th>
                            <th rowspan="2">Nama Siswa</th>
                            <th colspan="3" class="ctr">Nilai Sikap</th>
                            <th rowspan="2" class="ctr">Aksi</th>
                        </tr>
                        <tr>
                            <th class="ctr">Teman</th>
                            <th class="ctr">Sendiri</th>
                            <th class="ctr">Guru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="guru_id" value="{{$guru->id}}">
                            <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                            @foreach ($siswa as $data)
                                <input type="hidden" name="siswa_id" value="{{$data->id}}">
                                <tr>
                                    <td class="ctr">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $data->nama_siswa }}
                                        @if ($data->sikap($data->id) && $data->sikap($data->id)['id'])
                                            <input type="hidden" name="sikap_id" class="sikap_id_{{$data->id}}" value="{{ $data->sikap($data->id)['id'] }}">
                                        @else
                                            <input type="hidden" name="sikap_id" class="sikap_id_{{$data->id}}" value="">
                                        @endif
                                    </td>
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_1'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_1'] }}</div>
                                            <input type="hidden" name="sikap_1" class="sikap_1_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_1'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_1" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_1_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_2'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_2'] }}</div>
                                            <input type="hidden" name="sikap_2" class="sikap_2_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_2'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_2" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_2_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_3'])
                                        <td class="ctr">
                                            <div class="text-center">{{ $data->sikap($data->id)['sikap_3'] }}</div>
                                            <input type="hidden" name="sikap_3" class="sikap_3_{{$data->id}}" value="{{ $data->sikap($data->id)['sikap_3'] }}">
                                        </td>
                                    @else
                                        <td class="ctr"><input type="text" name="sikap_3" maxlength="1" onkeypress="return sikap(event)" style="margin: auto;" class="form-control text-center sikap_3_{{$data->id}}" autocomplete="off" autofocus></td>
                                    @endif
                                    @if ($data->sikap($data->id) && $data->sikap($data->id)['sikap_1'] && $data->sikap($data->id)['sikap_2'] && $data->sikap($data->id)['sikap_3'])
                                        <td class="ctr"><i class="fas fa-check" style="font-weight:bold;"></i></td>
                                    @else
                                        <td class="ctr sub_{{$data->id}}"><button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_click" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button></td>
                                    @endif
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
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
        $(".btn_click").click(function(){
            var id = $(this).attr('data-id');
            var sikap_1 = $(".sikap_1_"+id).val();
            var sikap_2 = $(".sikap_2_"+id).val();
            var sikap_3 = $(".sikap_3_"+id).val();
            var sikap_id = $(".sikap_id_"+id).val();
            var guru_id = $("input[name=guru_id]").val();
            var kelas_id = $("input[name=kelas_id]").val();
            
            $.ajax({
                url: "{{ route('sikap.store') }}",
                type: "POST",
                dataType: 'json',
                data 	: {
                    _token: '{{ csrf_token() }}',
                    id : sikap_id,
                    siswa_id : id,
                    kelas_id : kelas_id,
                    guru_id : guru_id,
                    sikap_1 : sikap_1,
                    sikap_2 : sikap_2,
                    sikap_3 : sikap_3
                },
                success: function(data){
                    toastr.success("Nilai sikap siswa berhasil ditambahkan!");
                    location.reload();
                },
                error: function (data) {
                    toastr.warning("Errors 404!");
                }
            });
        });
        
        $("#NilaiGuru").addClass("active");
        $("#liNilaiGuru").addClass("menu-open");
        $("#SikapGuru").addClass("active");
    </script>
@endsection