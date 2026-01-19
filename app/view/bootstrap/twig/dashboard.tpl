<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - ConfortClasses</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../lib/jscss/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php?a=home">ConfortClasses</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="index.php?a=logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link active" href="index.php?a=dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Gestão</div>
                    <a class="nav-link" href="index.php?a=empresas">Empresas</a>
                    <a class="nav-link" href="index.php?a=dispositivos">Dispositivos</a>
                    <a class="nav-link" href="index.php?a=sensores">Sensores</a>
                    <a class="nav-link" href="index.php?a=leituras_dispositivo">Leituras</a>
                </div>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Visão geral do sistema</li>
                </ol>

                <!-- CARD ÚNICO -->
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                <div class="fw-bold">ConfortClasses</div>
                                <div class="small">Atalhos rápidos</div>
                            </div>
                            <div class="card-footer d-flex flex-wrap gap-3">
                                <a class="text-white small" href="index.php?a=empresas">Empresas</a>
                                <a class="text-white small" href="index.php?a=dispositivos">Dispositivos</a>
                                <a class="text-white small" href="index.php?a=sensores">Sensores</a>
                                <a class="text-white small" href="index.php?a=leituras_dispositivo">Leituras</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRÁFICO DE BARRAS -->
                <div class="card mb-4 shadow">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Temperatura média por dispositivo
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" height="100"></canvas>
                    </div>
                </div>

                <!-- TABELA -->
                <div class="card mb-4 shadow">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Últimas leituras
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Dispositivo</th>
                                    <th>Sensor</th>
                                    <th>Valor</th>
                                    <th>Unidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2026-01-19 09:12</td>
                                    <td>XIAO-01</td>
                                    <td>Temperatura</td>
                                    <td>23.4</td>
                                    <td>°C</td>
                                </tr>
                                <tr>
                                    <td>2026-01-19 09:13</td>
                                    <td>XIAO-01</td>
                                    <td>Humidade</td>
                                    <td>55</td>
                                    <td>%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/jscss/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['XIAO-01', 'XIAO-02', 'ESP32-01'],
        datasets: [{
            label: 'Temperatura média (°C)',
            data: [23.4, 22.1, 24.0],
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

</body>
</html>
