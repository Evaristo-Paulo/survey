<div class="modal n-regular">
    <div class="modal-container">
        <!-- MAIN MENU -->
        <section class="modal-body" id="menu-mobile-modal">
            @auth()
            <article>
                <h2>Menu</h2>
                <ul>
                    <li><a style="display: flex; justify-content: flex-start; align-items: center;"
                            href=""><span class="iconify"
                                data-icon="ci:home-alt-check"></span>Home</a>
                    </li>
                    <li><a style="display: flex; justify-content: flex-start; align-items: center;"
                            href="{{ url('sys/dashboard') }}"><span class="iconify"
                                data-icon="icon-park-outline:doc-success"></span>Painel</a>
                    </li>
                    <li>
                        <form action="{{ url('sys/logout') }}" method="post">
                            @csrf
                            <button type="submit" style="display: flex; justify-content: flex-start; align-items: center; background-color: transparent; color: #A96262"
                            href=""><span class="iconify"
                                data-icon="ant-design:logout-outlined"></span>Sair</button>
                        </form>
                    </li>
                </ul>
            </article>
            @else
                <article>
                    <h2>Criar enquete</h2>
                    <ul>
                        <li><a href="{{ url('sys/login') }}"
                                style="display: flex; justify-content: flex-start; align-items: center;"><span
                                    class="iconify" data-icon="clarity:login-line"></span>Entrar</a>
                        </li>
                        <li><a href="{{ url('sys/register') }}"
                                style="display: flex; justify-content: flex-start; align-items: center;"><span
                                    class="iconify" data-icon="gridicons:create"></span>Criar conta</a>
                        </li>
                    </ul>
                </article>
            @endauth
        </section>

        <p class="modal-close"><span class="iconify" data-icon="ei:close"></span>
        </p>
    </div>
</div>
