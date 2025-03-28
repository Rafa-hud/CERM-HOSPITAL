<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administrador')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #3498db;
            --sidebar-bg: #2c3e50;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            padding-top: 0;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            padding: 1rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar .logo {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            padding: 0.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-color);
            color: #fff;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1rem;
            transition: all 0.3s ease;
        }

        /* Navbar */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: var(--primary-color);
            color: #fff;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            background: #f8f9fa;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Additional styles for Brazos Robóticos */
        .action-buttons .btn {
            padding: 0.375rem 0.75rem;
            margin: 0 2px;
        }

        .search-box {
            max-width: 300px;
        }

        /* Nuevos estilos para la vista de brazos robóticos */
        .brazos-container {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .brazos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .brazos-title {
            margin: 0;
            color: var(--primary-color);
        }

        .table-actions {
            white-space: nowrap;
        }

        .no-brazos {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Barra lateral -->
    <div class="sidebar">
        <div class="logo">Hospital</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar-check"></i> Citas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.brazos-roboticos.index') }}">
                    <i class="bi bi-robot"></i> Brazos Robóticos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i> Reportes
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Barra de navegación superior -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler d-lg-none" type="button" id="sidebarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Panel de Administrador</a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Área de contenido -->
        <div class="container-fluid mt-4">
            <!-- Mensajes flash -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Scripts personalizados -->
    <script>
        // Toggle sidebar en móviles
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Inicializar DataTable para brazos robóticos
        $(document).ready(function() {
            $('#brazosTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: -1 } // Deshabilitar ordenación en columna de acciones
                ]
            });

            // Manejar búsqueda en tiempo real
            $('#searchBrazo').on('keyup', function() {
                $('#brazosTable').DataTable().search($(this).val()).draw();
            });
        });

        // Confirmación antes de eliminar
        function confirmDelete(event) {
            if (!confirm('¿Estás seguro de eliminar este brazo robótico?')) {
                event.preventDefault();
            }
        }
    </script>

    @yield('scripts')
</body>
</html>
