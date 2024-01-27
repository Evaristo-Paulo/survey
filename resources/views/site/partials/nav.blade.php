<button id="go-up"><span class="iconify" data-icon="bx:bx-chevron-up"></span></button>
<div class="detail">
    <div class="contact">
        <p>
            <span class="iconify" data-icon="carbon:phone" style="color: rgba(255, 255, 255, 0.856);"></span>
            <span class="info">(+244) 940-570-866</span>
        </p>
        <p>
            <span class="iconify" data-icon="carbon:email" style="color: rgba(255, 255, 255, 0.856);"></span>
            <span class="info">suporte@iask.com</span>
        </p>
    </div>
    <div class="user">
        <p>
            @auth()
                <a href="javascript::void" style="color: rgba(255, 255, 255, 0.856);"><span
                        class="info">{{ Auth::user()->name }}</span></a>
            @endauth
        </p>
    </div>
</div>
<header class="m-pages">
    <nav id="nav">
        <div class="up">
            <a class="logo" href="javascript::void(0)">
                iAsk
            </a>
            <div class="inner-nav">
                @auth()
                    <ul class="nav-item-main">
                        <li id="section-home"><a href="javascript::void(0)">Home</a></li>
                        <li><a href="{{ url('sys/dashboard') }}">Painel</a></li>
                    </ul>
                @endauth
                <ul id="create-anoucement">
                    @auth()
                        <li>
                            <form action="{{ url('sys/logout') }}" method="POST">
                                @csrf
                                <button class="highlight" type="submit"
                                    style="display: flex;pointer-events: all; color: #fff; justify-content: space-between; align-items: center;">Sair
                                    <span class="iconify" data-icon="ant-design:arrow-right-outlined"
                                        style="color: white; margin-left: 5px"></span></button>
                            </form>
                        </li>
                    @endauth
                </ul>
                <div class="close highlight" id="menu-mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="11">
                        <g fill="#fff" fill-rule="evenodd">
                            <path d="M0 0h24v1H0zM0 5h24v1H0zM0 10h24v1H0z" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="middle">
            <article id="banner-carrossel">
                <ul class="banner-carrossel-body" style="position: relative">
                    <h2 class="banner-title-carrossel">{{ $enquete['nome'] }}</h2>
                    <h2 class="banner-title-carrossel banner-subtitle">{{ $enquete['descricao'] }}</h2>
                    <li class="active-carrossel"><img src='{{ url('site/survey/banner1.jpg') }}' /></li>
                    <li><img src='{{ url('site/survey/banner2.jpg') }}' /></li>
                    <li><img src='{{ url('site/survey/banner3.jpg') }}' /></li>
                </ul>
            </article>
        </div>
        <div class="down">
            @yield('breadcrumb')
            <article class="social-media">
                <h2 class="title-social-media">Redes sociais: </h2>
                <ul>
                    <li><a href="https://www.facebook.com/evaristodomingospaulo.evaristo" target="_blank"><span
                                class="iconify" data-icon="brandico:facebook"></span></a>
                    </li>
                    <li><a href="https://www.instagram.com/evaristo_tgm/" target="_blank"><span class="iconify"
                                data-icon="akar-icons:instagram-fill"></span></a></li>
                </ul>
            </article>
        </div>
    </nav>
</header>
