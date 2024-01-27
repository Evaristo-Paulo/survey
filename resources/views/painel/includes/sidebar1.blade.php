<div id="header_top" class="header_top" >
    <div class="container">
        <div class="hleft" >
            <a class="header-brand" href="{{ url('sys/dashboard') }}"><i class="fa fa-soccer-ball-o brand-logo"></i></a>
            <div class="dropdown" style="margin-top: 18px">
                <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar"
                        src="{{ asset('admin/assets/images/user.png') }} " alt="" data-toggle="tooltip"
                        data-placement="right" title="User Menu" /></a>
                <a href="{{ url('sys/estatisticas/enquetes/perguntas') }}" class="nav-link icon app_inbox xs-hide" style="font-size: 1rem"><i style="font-size: 1rem" class="fa-solid fa-magnifying-glass-chart"></i></a>
                <a href="app-contact.html" class="nav-link icon xs-hide"><i
                    class="fa fas fa-solid fa-folder" style="font-size: 1.05rem"></i></a>
            </div>
        </div>
        <div class="hright">
            <div class="dropdown">
                <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin"
                        data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i
                        class="fa  fa-align-left"></i></a>
            </div>
        </div>
    </div>
</div>
