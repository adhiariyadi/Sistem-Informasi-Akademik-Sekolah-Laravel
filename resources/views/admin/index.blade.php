@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Admin</li>
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jadwal->count() }}</h3>
                <p>Jadwal</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt nav-icon"></i>
            </div>
            <a href="{{ route('jadwal.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner" style="color: #FFFFFF;">
                <h3>{{ $guru->count() }}</h3>
                <p>Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card nav-icon"></i>
            </div>
            <a href="{{ route('guru.index') }}" style="color: #FFFFFF !important;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $siswa->count() }}</h3>
                <p>Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-card nav-icon"></i>
            </div>
            <a href="{{ route('siswa.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $kelas->count() }}</h3>
                <p>Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-home nav-icon"></i>
            </div>
            <a href="{{ route('kelas.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $mapel->count() }}</h3>
                <p>Mapel</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
            <a href="{{ route('mapel.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $user->count() }}</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus nav-icon"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">DataGuru</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $guru->count() }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartGuru" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Data Siswa</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $siswa->count() }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartSiswa" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Kelas / Paket Keahlian </span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $kelas->count() }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChartPaket" height="150"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle" style="color: #d4c148"></i> Bisnis kontruksi dan Properti</li>
                                <li><i class="far fa-circle" style="color: #ba6906"></i> Desain Permodelan dan Informasi Bangunan</li>
                                <li><i class="far fa-circle" style="color: #ff990a"></i> Elektronika Industri</li>
                                <li><i class="far fa-circle" style="color: #00a352"></i> Otomasi Industri</li>
                                <li><i class="far fa-circle" style="color: #2cabe6"></i> Teknik dan Bisnis Sepeda Motor</li>
                                <li><i class="far fa-circle" style="color: #999999"></i> Rekayasa Perangkat Lunak</li>
                                <li><i class="far fa-circle" style="color: #0b2e75"></i> Teknik Pemesinan</li>
                                <li><i class="far fa-circle" style="color: #7980f7"></i> Teknik Pengelasan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Siswa / Kelas</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> {{ $siswa->count() }}
                        </span>
                    </p>
                </div>
                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="300"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-4">
                        <i class="fas fa-square text-primary"></i> Kelas X
                    </span>
                    <span class="mr-4">
                        <i class="fas fa-square text-success"></i> Kelas XI
                    </span>
                    <span class="mr-4">
                        <i class="fas fa-square text-danger"></i> Kelas XII
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode      = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            var salesChart  = new Chart($salesChart, {
                type   : 'bar',
                data   : {
                labels  : [
                    'BKP A',
                    'BKP B',
                    'DPIB A',
                    'DPIB B',
                    'DPIB C',
                    'EI A',
                    'EI B',
                    'OI A',
                    'OI B',
                    'TPM A',
                    'TPM B',
                    'TPM C',
                    'TPM D',
                    'TBSM A',
                    'TBSM B',
                    'TPL A',
                    'TPL B',
                    'RPL A',
                    'RPL B',
                    'RPL C',
                ],
                datasets: [
                    {
                        backgroundColor: '#007BFF',
                        borderColor    : '#007BFF',
                        data           : [
                            {{ $bkpa1->count() }},
                            {{ $bkpb1->count() }},
                            {{ $dpiba1->count() }},
                            {{ $dpibb1->count() }},
                            {{ $dpibc1->count() }},
                            {{ $eia1->count() }},
                            {{ $eib1->count() }},
                            {{ $oia1->count() }},
                            {{ $oib1->count() }},
                            {{ $tpma1->count() }},
                            {{ $tpmb1->count() }},
                            {{ $tpmc1->count() }},
                            {{ $tpmd1->count() }},
                            {{ $tbsma1->count() }},
                            {{ $tbsmb1->count() }},
                            {{ $lasa1->count() }},
                            {{ $lasb1->count() }},
                            {{ $rpla1->count() }},
                            {{ $rplb1->count() }},
                            {{ $rplc1->count() }}
                        ]
                    },
                    {
                        backgroundColor: '#28A745',
                        borderColor    : '#28A745',
                        data           : [
                            {{ $bkpa2->count() }},
                            {{ $bkpb2->count() }},
                            {{ $dpiba2->count() }},
                            {{ $dpibb2->count() }},
                            {{ $dpibc2->count() }},
                            {{ $eia2->count() }},
                            {{ $eib2->count() }},
                            {{ $oia2->count() }},
                            {{ $oib2->count() }},
                            {{ $tpma2->count() }},
                            {{ $tpmb2->count() }},
                            {{ $tpmc2->count() }},
                            {{ $tpmd2->count() }},
                            {{ $tbsma2->count() }},
                            {{ $tbsmb2->count() }},
                            {{ $lasa2->count() }},
                            {{ $lasb2->count() }},
                            {{ $rpla2->count() }},
                            {{ $rplb2->count() }},
                            {{ $rplc2->count() }}
                        ]
                    },
                    {
                        backgroundColor: '#DC3545',
                        borderColor    : '#DC3545',
                        data           : [
                            {{ $bkpa3->count() }},
                            {{ $bkpb3->count() }},
                            {{ $dpiba3->count() }},
                            {{ $dpibb3->count() }},
                            {{ $dpibc3->count() }},
                            {{ $eia3->count() }},
                            {{ $eib3->count() }},
                            {{ $oia3->count() }},
                            {{ $oib3->count() }},
                            {{ $tpma3->count() }},
                            {{ $tpmb3->count() }},
                            {{ $tpmc3->count() }},
                            {{ $tpmd3->count() }},
                            {{ $tbsma3->count() }},
                            {{ $tbsmb3->count() }},
                            {{ $lasa3->count() }},
                            {{ $lasb3->count() }},
                            {{ $rpla3->count() }},
                            {{ $rplb3->count() }},
                            {{ $rplc3->count() }}
                        ]
                    }
                ]
                },
                options: {
                maintainAspectRatio: false,
                tooltips           : {
                    mode     : mode,
                    intersect: intersect
                },
                hover              : {
                    mode     : mode,
                    intersect: intersect
                },
                legend             : {
                    display: false
                },
                scales             : {
                    yAxes: [{
                    gridLines: {
                        display      : true,
                        lineWidth    : '4px',
                        color        : 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks    : $.extend({
                        beginAtZero: true,

                        callback: function (value, index, values) {
                            return value
                        }
                    }, ticksStyle)
                    }],
                    xAxes: [{
                    display  : true,
                    gridLines: {
                        display: false
                    },
                    ticks    : ticksStyle
                    }]
                }
                }
            })

            var pieChartCanvasGuru = $('#pieChartGuru').get(0).getContext('2d')
            var pieDataGuru        = {
            labels: [
                'Laki-laki', 
                'Perempuan',
            ],
            datasets: [
                {
                data: [{{ $gurulk->count() }}, {{ $gurupr->count() }}],
                backgroundColor : ['#007BFF', '#DC3545'],
                }
            ]
            }
            var pieOptions     = {
            legend: {
                display: false
            }
            }

            var pieChart = new Chart(pieChartCanvasGuru, {
            type: 'doughnut',
            data: pieDataGuru,
            options: pieOptions      
            })

            var pieChartCanvasSiswa = $('#pieChartSiswa').get(0).getContext('2d')
            var pieDataSiswa        = {
            labels: [
                'Laki-laki', 
                'Perempuan',
            ],
            datasets: [
                {
                data: [{{ $siswalk->count() }}, {{ $siswapr->count() }}],
                backgroundColor : ['#007BFF', '#DC3545'],
                }
            ]
            }
            var pieOptions     = {
            legend: {
                display: false
            }
            }

            var pieChart = new Chart(pieChartCanvasSiswa, {
            type: 'doughnut',
            data: pieDataSiswa,
            options: pieOptions      
            })

            
            var pieChartCanvasPaket = $('#pieChartPaket').get(0).getContext('2d')
            var pieDataPaket        = {
            labels: [
                'Bisnis kontruksi dan Properti',
                'Desain Permodelan dan Informasi Bangunan',
                'Elektronika Industri',
                'Otomasi Industri',
                'Teknik dan Bisnis Sepeda Motor',
                'Rekayasa Perangkat Lunak',
                'Teknik Pemesinan',
                'Teknik Pengelasan',
            ],
            datasets: [
                {
                data: [{{ $bkp->count() }}, {{ $dpib->count() }}, {{ $ei->count() }}, {{ $oi->count() }}, {{ $tbsm->count() }}, {{ $rpl->count() }}, {{ $tpm->count() }}, {{ $las->count() }}],
                backgroundColor : ['#d4c148', '#ba6906', '#ff990a', '#00a352', '#2cabe6', '#999999', '#0b2e75', '#7980f7'],
                }
            ]
            }
            var pieOptions     = {
            legend: {
                display: false
            }
            }
            
            var pieChart = new Chart(pieChartCanvasPaket, {
            type: 'doughnut',
            data: pieDataPaket,
            options: pieOptions      
            })
        })
        
        $("#Dashboard").addClass("active");
        $("#liDashboard").addClass("menu-open");
        $("#AdminHome").addClass("active");
    </script>
@endsection