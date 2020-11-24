<ul class="nav" id="side-menu">
    <li>
        <a href="{{route('home')}}"><i class="fa fa-home fa-fw"></i> Inicio</a>
    </li>
    @permission('see-events')
        <li>
            <a href="{{route('event.index')}}"><i class="fa fa-indent"></i> Eventos</a>
        </li>
    @endpermission
    @permission('see-college')
        <li>
            <a href="{{route('college.index')}}"><i class="fa fa-university"></i> Instituciones</a>
        </li>
    @endpermission
    @permission('see-groups')
        <li>
            <a href="{{route('group.index')}}"><i class="fa fa-group"></i> Grupos</a>
        </li>
    @endpermission
    @permission('see-seedbeds')
        <li>
            <a href="{{route('seedbed.index')}}"><i class="fa fa-group"></i> Semilleros</a>
        </li>
    @endpermission
    @permission('see-projects')
        <li class="nav-item">
            <a href="{{route('project.index')}}"><i class="fa fa-folder-open "></i>Proyectos</a>
        </li>
    @endpermission
    @permission('see-assigments')
        <li>
            <a href="{{route('assignment.index')}}"><i class="fa fa-calendar"></i> Asignación</a>
        </li>
    @endpermission
    @permission(['see-evaluations', 'see-all-evaluations'])
        <li>
            <a href="{{route('evaluation.index')}}"><i class="fa fa-check-square-o"></i> Proyectos Asignados</a>
        </li>
    @endpermission
    @permission('see-settings')
        <li class="nav-item">
            <a href="javascript:;">
                <i class="fa fa-gears"></i>
                Configuraciones
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
                <li>
                    <a  href="{{route('user.index')}}"><i class="fa fa-users"></i> Usuarios</a>
                </li>
                <li>
                    <a href="{{route('profile.index')}}"><i class="fa fa-lock"></i> Roles y Permisos</a>
                </li>
            </ul>
        </li>
    @endpermission
</ul>