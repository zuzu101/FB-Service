@inject('humanizer', 'Coduo\PHPHumanizer\NumberHumanizer')

@extends('layouts.admin.app')

@section('content')
  <div id="root">
    <div id="containerCOunting" class="row row row-cols-1 row row-cols-md-3">
      <div class="col mb-3">
        <div class="card-counting">
          <h1>{{ $employeeTotal }}</h1>
          <p>Total Karyawan</p>
          <a class="btn btn-primary mt-2" href="{{ route('admin.hrm.employee.index') }}">Kunjungi Halaman</a>
        </div>
      </div>
      <div class="col mb-3">
        <div class="card-counting">
          <h1>{{ $branchTotal }}</h1>
          <p>Total Cabang</p>
          <a class="btn btn-primary mt-2" href="{{ route('admin.master_data.branch.index') }}">Kunjungi Halaman</a>
        </div>
      </div>
      <div class="col">
        <div class="card-counting">
          <div class="d-flex justify-content-start">
            <h1>Rp. {{ $humanizer::metricSuffix($payableTotal, 'id') }}</h1>
            <span class="ms-3" data-toggle="tooltip" data-placement="top"
              title="Rp. {{ number_format($payableTotal) }},-">
              <i class="fas fa-info-circle"></i>
            </span>
          </div>
          <p>Total Gaji Dibayarkan</p>
        </div>
      </div>
    </div>

    <br>

    
    
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">
              Total karyawan di seluruh cabang
            </h1>
  
            <br>
  
            <div>
              <canvas id="chartBranches"></canvas>
            </div>
          </div>
        </div>
      </div>

      
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">
              Total karyawan di setiap divisi cabang <span id="nameBranchSelected"></span>
            </h1>
  
            <br>
  
            <div>
              <select class="form-control w-25 my-3" id="branchSelected">
                <option value="" disabled>Pilih Cabang</option>
                @foreach ($branches as $key => $branch)
                  <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
              </select>
  
              <canvas id="chartDepartment"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex w-100 justify-content-between align-items-center mb-4">
              <span>
                Tren Kehadiran Karyawan (Mingguan)
              </span>

              <a class="btn btn-primary" href="{{ route('admin.hrm.presence.index') }}">Kunjungi Halaman</a>
            </div>
    
            <canvas id="weeklyPresenceChart"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex w-100 justify-content-between align-items-center mb-4">
              <span>
                Progres Cuti Karyawan
              </span>

              <a class="btn btn-primary" href="{{ route('admin.hrm.employee_leave_request.index') }}">Kunjungi Halaman</a>
            </div>
    
            <canvas id="leavesLeftChart"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex w-100 justify-content-between align-items-center mb-4">
              <span>
                  Distribusi Status Karyawan
              </span>

              <a class="btn btn-primary" href="{{ route('admin.hrm.employee.index') }}">Kunjungi Halaman</a>
            </div>
            
            <canvas id="employeeStatusChart"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex w-100 justify-content-between align-items-center mb-4">
              <span>
                  Distribusi Task Harian Karyawan
              </span>

              <a class="btn btn-primary" href="{{ route('admin.hrm.task-progress.index') }}">Kunjungi Halaman</a>
            </div>
    
            <canvas id="employeesTaskChart"></canvas>
          </div>
        </div>
      </div>
    </div>


  </div>
@endsection

@push('css')
  <style>
    .card-counting {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      border: 1px solid lightgray;
    }

    .card-counting h1,
    .card-counting p {
      margin: 0;
    }

    .card-counting h1 {
      font-weight: bold;
      font-size: 2.5em;
    }

    .card-counting p {
      font-size: 1.2em;
    }

    canvas {
      max-height: 50vh;
    }
  </style>
@endpush

@push('js')
  <script>
    // Tooltip
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

  {{-- Branch Chart --}}
  <script>
    const chartBranches = document.getElementById('chartBranches');
    const dataBranch = {
      labels: {!! json_encode($chartBranches['labels']) !!},
      datasets: [{
        label: 'Total Karyawan',
        data: {!! json_encode($chartBranches['datasets']) !!},
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 2,
        borderRadius: 100,
        borderSkipped: false
      }]
    }

    const configBranch = {
      type: 'bar',
      data: dataBranch,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Bar Chart'
          }
        },
        scales: {
          yAxes: [{
            display: true,
            stacked: true,
            ticks: {
              min: 0,
            }
          }]
        }
      },
    };

    new Chart(chartBranches, configBranch);
  </script>

  {{-- Department Chart --}}
  <script>
    const nameBranchSelected = document.getElementById('nameBranchSelected');
    const branchSelected = document.getElementById('branchSelected');
    const chartDepartmentEl = document.getElementById('chartDepartment');
    const dataDepartment = {!! json_encode($chartDepartment) !!}.map(data => {
      return {
        branch: data.branch,
        labels: data.labels,
        datasets: [{
          label: `Total Karyawan ${data.branch.name}`,
          data: data.datasets,
          borderColor: 'rgba(41, 41, 194, 0.8)',
          backgroundColor: 'rgba(36, 36, 205, 0.45)',
          borderWidth: 2,
          borderRadius: 100,
          borderSkipped: false
        }]
      }
    })

    const configDepartment = {
      type: 'bar',
      data: dataDepartment[0],
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Chart.js Bar Chart'
          }
        },
        scales: {
          yAxes: [{
            display: true,
            stacked: true,
            ticks: {
              min: 0,
            }
          }]
        },
      },
    };

    const chartDepartment = new Chart(chartDepartmentEl, configDepartment);

    branchSelected.addEventListener('change', (e) => {
      const branchId = e.target.value;
      const data = dataDepartment.find(data => data.branch.id == branchId);

      chartDepartment.data = data;
      chartDepartment.update();
    });
  </script>

  {{-- Tren kehadiran mingguan chart --}}
  <script>
    const weeklyPresence = document.getElementById('weeklyPresenceChart');
    const DATA_COUNT = 7;
    const datapoints = {!! json_encode($weeklyPresenceChart['count']) !!};
    const dates = {!! json_encode($weeklyPresenceChart['dates']) !!}
    

    const data = {
      labels: dates,
      datasets: [
        {
          label: 'Absensi Hadir',
          data: datapoints,
          borderColor: 'rgba(41, 41, 194, 0.8)',
          fill: false,
          cubicInterpolationMode: 'monotone',
          tension: 0.4
        },
      ]
    };

    const configWeeklyPresence = {
      type: 'line',
      data: data,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Chart.js Line Chart - Cubic interpolation mode'
          },
        },
        interaction: {
          intersect: false,
        },
        scales: {
          x: {
            display: true,
            title: {
              display: true
            }
          },
          y: {
            display: true,
            title: {
              display: true,
              text: 'Value'
            },
            suggestedMin: -10,
            suggestedMax: 200
          }
        }
      },
    };

    new Chart(weeklyPresence, configWeeklyPresence);
  </script>

  {{-- Leave Chart --}}
  <script>
    var leavesChartContext = document.getElementById("leavesLeftChart").getContext('2d');
    
    const employeesName = {!! json_encode($leavesCount['employees']) !!}
    const usedLeave = {!! json_encode($leavesCount['used']) !!}
    const unusedLeave = {!! json_encode($leavesCount['unused']) !!}

    new Chart(leavesChartContext, {
        type: 'bar',
        data: {
            labels: employeesName,
            datasets: [{
                label: 'Cuti Sudah Dipakai',
                backgroundColor: "red",
                data: usedLeave,
            }, {
                label: 'Belum Dipakai',
                backgroundColor: "yellow",
                data: unusedLeave,
            }],
        },
        options: {
            indexAxis: 'y',
            plugins: {
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });

  </script>

  {{-- Employee status --}}
  <script>
    const employeeStatusChart = document.getElementById("employeeStatusChart").getContext('2d');
    const employeeStatusActive = "{{ $employeeStatusCount['active'] }}"
    const employeeStatusNotActive = "{{ $employeeStatusCount['notActive'] }}"

    const dataEmployeeStatus = {
      labels: [
        'Aktif',
        'Resign',
      ],
      datasets: [{
        data: [employeeStatusActive, employeeStatusNotActive],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
        ],
        hoverOffset: 4
      }]
    };

    const configEmployeeStatus = {
      type: 'pie',
      data: dataEmployeeStatus,
    };

    new Chart(employeeStatusChart, configEmployeeStatus);
  </script>

    {{-- Leave Chart --}}
    <script>
      var employeeTaskChart = document.getElementById("employeesTaskChart").getContext('2d');
      
      const employeesNameTask = {!! json_encode($employeeTaskCount['employees']) !!}
      const doneTasks = {!! json_encode($employeeTaskCount['done']) !!}
      const totalTasks = {!! json_encode($employeeTaskCount['total']) !!}
  
      new Chart(employeeTaskChart, {
          type: 'bar',
          data: {
              labels: employeesNameTask,
              datasets: [{
                  label: 'Task Selesai',
                  backgroundColor: "red",
                  data: doneTasks,
              }, {
                  label: 'Total Task Tersisa',
                  backgroundColor: "yellow",
                  data: totalTasks,
              }],
          },
          options: {
              indexAxis: 'y',
              plugins: {
              },
              scales: {
                  x: {
                      stacked: true,
                  },
                  y: {
                      stacked: true
                  }
              }
          }
      });
  
    </script>
@endpush
