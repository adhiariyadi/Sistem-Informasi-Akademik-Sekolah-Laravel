@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-12" id="load_content">
      <div class="card card-primary">
        <div class="card-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Jam Pelajaran</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Ruang Kelas</th>
                    <th>Ket.</th>
                  </tr>
                </thead>
                <tbody id="data-jadwal">
                    @php
                      $hari = date('w');
                      $jam = date('H:i');
                    @endphp
                    @if ( $jadwal->count() > 0 )
                      @if (
                        $hari == '1' && $jam >= '09:45' && $jam <= '10:15' ||
                        $hari == '1' && $jam >= '12:30' && $jam <= '13:15' ||
                        $hari == '2' && $jam >= '09:15' && $jam <= '09:45' ||
                        $hari == '2' && $jam >= '12:00' && $jam <= '13:00' ||
                        $hari == '3' && $jam >= '09:15' && $jam <= '09:45' ||
                        $hari == '3' && $jam >= '12:00' && $jam <= '13:00' ||
                        $hari == '4' && $jam >= '09:15' && $jam <= '09:45' ||
                        $hari == '4' && $jam >= '12:00' && $jam <= '13:00' ||
                        $hari == '5' && $jam >= '09:00' && $jam <= '09:15' ||
                        $hari == '5' && $jam >= '11:15' && $jam <= '13:00'
                      )
                      <tr>
                        <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Waktunya Istirahat!</td>
                      </tr>
                      @else
                      @foreach ($jadwal as $data)
                        <tr>
                          <td>{{ $data->jam_mulai.' - '.$data->jam_selesai }}</td>
                          <td>
                              <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                              <p class="card-text"><small class="text-muted">{{ $data->guru->nama_guru }}</small></p>
                          </td>
                          <td>{{ $data->kelas->nama_kelas }}</td>
                          <td>{{ $data->ruang->nama_ruang }}</td>
                          <td>
                            @if ($data->absen($data->guru_id))
                              <div style="margin-left:20px;width:30px;height:30px;background:#{{ $data->absen($data->guru_id) }}"></div>
                            @elseif (date('H:i:s') >= '09:00:00')
                              <div style="margin-left:20px;width:30px;height:30px;background:#F00"></div>
                            @else
                            @endif
                          </td>
                        </tr>
                      @endforeach
                  @endif
                  @elseif ($jam <= '07:00')
                    <tr>
                      <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jam Pelajaran Hari ini Akan Segera Dimulai!</td>
                    </tr>
                @elseif (
                  $hari == '1' && $jam >= '16:15' ||
                  $hari == '2' && $jam >= '16:00' ||
                  $hari == '3' && $jam >= '16:00' ||
                  $hari == '4' && $jam >= '16:00' ||
                  $hari == '5' && $jam >= '15:40'
                )
                  <tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jam Pelajaran Hari ini Sudah Selesai!</td>
                  </tr>
                @elseif ($hari == '0' || $hari == '6')
                  <tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Sekalah Libur!</td>
                  </tr>
                @elseif($hari == '1' && $jam >= '07:00' && $jam <= '07:30')
                  <tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Waktunya Upacara Bendera!</td>
                  </tr>
                @else
                  <tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Tidak Ada Data Jadwal!</td>
                  </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-warning" style="min-height: 385px;">
        <div class="card-header">
          <h3 class="card-title" style="color: white;">
            Pengumuman
          </h3>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            {!! $pengumuman->isi !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            Keterangan :
          </h3>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            <table class="table" style="margin-top: -21px; margin-bottom: -10px;">
              @foreach ($kehadiran as $data)
                <tr>
                  <td>
                    <div style="width:30px;height:30px;background:#{{ $data->color }}"></div>
                  </td>
                  <td>:</td>
                  <td>{{ $data->ket }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
    <script>
      $(document).ready(function () {
        setInterval(function() {
          var date = new Date();
          var hari = date.getDay();
          var h = date.getHours();
          var m = date.getMinutes();
          h = (h < 10) ? "0" + h : h;
          m = (m < 10) ? "0" + m : m;
          var jam = h + ":" + m;
          
          if (hari == '0' || hari == '6') {
            $("#data-jadwal").html(
              `<tr>
                <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Sekalah Libur!</td>
              </tr>`
            );
          } else {
            if (jam <= '07:00') {
              $("#data-jadwal").html(
                `<tr>
                  <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jam Pelajaran Hari ini Akan Segera Dimulai!</td>
                </tr>`
              );
            } else if (
              hari == '1' && jam >= '16:15' ||
              hari == '2' && jam >= '16:00' ||
              hari == '3' && jam >= '16:00' ||
              hari == '4' && jam >= '16:00' ||
              hari == '5' && jam >= '15:40'
            ) {
              $("#data-jadwal").html(
                `<tr>
                  <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jam Pelajaran Hari ini Sudah Selesai!</td>
                </tr>`
              );
            } else {
              if (
                hari == '1' && jam >= '09:45' && jam <= '10:15' ||
                hari == '1' && jam >= '12:30' && jam <= '13:15' ||
                hari == '2' && jam >= '09:15' && jam <= '09:45' ||
                hari == '2' && jam >= '12:00' && jam <= '13:00' ||
                hari == '3' && jam >= '09:15' && jam <= '09:45' ||
                hari == '3' && jam >= '12:00' && jam <= '13:00' ||
                hari == '4' && jam >= '09:15' && jam <= '09:45' ||
                hari == '4' && jam >= '12:00' && jam <= '13:00' ||
                hari == '5' && jam >= '09:00' && jam <= '09:15' ||
                hari == '5' && jam >= '11:15' && jam <= '13:00'
              ) {
                $("#data-jadwal").html(
                  `<tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Waktunya Istirahat!</td>
                  </tr>`
                );
              } else if (hari == '1' && jam >= '07:00' && jam <= '07:30') {
                $("#data-jadwal").html(
                  `<tr>
                    <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Waktunya Upacara Bendera!</td>
                  </tr>`
                );
              } else {
                $.ajax({
                  type:"GET",
                  data: {
                    hari : hari,
                    jam : jam
                  },
                  dataType:"JSON",
                  url:"{{ url('/jadwal/sekarang') }}",
                  success:function(data){
                    var html = "";
                    $.each(data, function (index, val) {
                        html += "<tr>";
                          html += "<td>" + val.jam_mulai + ' - ' + val.jam_selesai + "</td>";
                          html += "<td><h5 class='card-title'>" + val.mapel + "</h5><p class='card-text'><small class='text-muted'>" + val.guru + "</small></p></td>";
                          html += "<td>" + val.kelas + "</td>";
                          html += "<td>" + val.ruang + "</td>";
                          if (val.ket != null) {
                            html += "<td><div style='margin-left:20px;width:30px;height:30px;background:#"+val.ket+"'></div></td>";
                          } else {
                            html += "<td></td>";
                          }
                        html += "</tr>";
                    });
                    $("#data-jadwal").html(html);
                  },
                  error:function(){
                  }
                });
              }
            }
          }
        }, 60 * 1000);
      });
      
      $("#Dashboard").addClass("active");
      $("#liDashboard").addClass("menu-open");
      $("#Home").addClass("active");
    </script>
@endsection
