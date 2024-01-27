<div id="left-sidebar" class="sidebar ">
    <h5 class="brand-name">IASK <a href="javascript:void(0)" class="menu_option float-right"><i
                class="icon-grid font-16" data-toggle="tooltip" data-placement="left"
                title="Grid & List Toggle"></i></a></h5>
    <nav id="left-sidebar-nav" class="sidebar-nav">
        <ul class="metismenu">
            <li class="g_heading">{{ Auth::user()->name }}</li>
            <li class="active"><a href="{{ url('sys/dashboard') }}"><i
                        class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa-solid fa-magnifying-glass-chart"></i><span>Estatística</span></a>
                <ul>
                    <li><a href="{{ url('sys/estatisticas/enquetes/perguntas') }}">Pergunta</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="has-arrow arrow-c"><i
                        class="fa fas fa-solid fa-folder"></i><span>Relatório</span></a>
                <ul>
                    <li><a href="forgot-password.html">Forgot password</a></li>
                    <li><a href="404.html">404 error</a></li>
                    <li><a href="500.html">500 error</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
