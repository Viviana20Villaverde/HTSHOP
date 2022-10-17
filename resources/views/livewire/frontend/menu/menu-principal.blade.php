<header class="contenedor_navbar" x-data="sidebar" x-on:click.away="cerrarSidebar()">
    @php
        $json_menu = file_get_contents('menuFrontend.json');
        $menuPrincipal = collect(json_decode($json_menu, true));
    @endphp
    <nav class="navbar">
        <!-- HAMBURGUESA -->
        <div x-on:click="abrirSidebar" class="contenedor_hamburguesa">
            <i class="fa-solid fa-bars" style="color: #666666;"></i>
        </div>
        <!-- LOGO -->
        <div class="contenedor_logo">
            <a href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
            </a>
        </div>
        <!-- MENU -->
        <div :class="{ 'block': abiertoSidebar, 'block': !abiertoSidebar }" class="contenedor_menu_link">
            <div class="sidebar_logo">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                <i x-on:click="cerrarSidebar" style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
            </div>
            <hr>
            <!-- MENU-PRINCIPAL -->
            <div class="menu_principal" x-on:click.away="seleccionado = null">
                @foreach ($menuPrincipal as $key => $menu)
                    <div x-data="subMenu1" class="elementos_menu_principal">

                        <!--Menu Nombres-->
                        <div x-on:click="seleccionar({{ $key }})" class="menu_icono">
                            @if (count($menu['subMenu1']))
                                <a class="menu_nombre">{{ $menu['nombrePrincipal'] }}</a>
                                <i class="fa-solid fa-sort-down"></i>
                            @else
                                <a class="menu_nombre"
                                    href={{ $menu['nombrePrincipalUrl'] }}>{{ $menu['nombrePrincipal'] }}</a>
                            @endif
                        </div>
                        <!--SubMenu1-->
                        {{-- <div x-show="seleccionado == {{ $key }}" x-transition class="submenu_1" --}}
                        <div :style="seleccionado == {{ $key }} && { display: 'block' }" x-transition
                            class="submenu_1" x-on:click.away="seleccionadoSubMenu1 = null">
                            @if (count($menu['subMenu1']))
                                @foreach ($menu['subMenu1'] as $keySub1 => $subMenu1)
                                    <div x-data="subMenu2" class="elementos_submenu_1">

                                        <!--SubMenu1 Nombres-->
                                        <div x-on:click="seleccionarSubMenu1({{ $keySub1 }})"
                                            class="menu_icono menu_icono_submenu"
                                            :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { background: '#f3f4f6' }">
                                            @if (count($subMenu1['subMenu2']))
                                                <a class="submenu_nombre">{{ $subMenu1['nombreSubMenu1'] }}</a>
                                                <i class="fa-solid fa-sort-down"></i>
                                            @else
                                                <a class="submenu_nombre"
                                                    href={{ $subMenu1['nombreSubMenu1Url'] }}>{{ $subMenu1['nombreSubMenu1'] }}</a>
                                            @endif
                                        </div>

                                        <!--SubMenu2-->
                                        {{-- <div x-show="seleccionadoSubMenu1 == {{ $keySub1 }}" x-transition --}}
                                        <div :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { display: 'block' }"
                                            x-transition x-on:click.away="seleccionadoSubMenu2 = null"
                                            class="submenu_2">
                                            @if (count($subMenu1['subMenu2']))
                                                @foreach ($subMenu1['subMenu2'] as $keySub2 => $subMenu2)
                                                    <div x-data="subMenu3" class="elementos_submenu_2">

                                                        <!--SubMenu2 Nombres-->
                                                        <div x-on:click="seleccionarSubMenu2({{ $keySub2 }})"
                                                            class="menu_icono menu_icono_submenu"
                                                            :style="seleccionadoSubMenu2 == {{ $keySub2 }} &&
                                                            { background: '#f3f4f6' }">

                                                            @if (count($subMenu2['subMenu3']))
                                                                <a
                                                                    class="submenu_nombre">{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                                <i class="fa-solid fa-sort-down"></i>
                                                            @else
                                                                <a class="submenu_nombre"
                                                                    href={{ $subMenu2['nombreSubMenu2Url'] }}>{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                            @endif
                                                        </div>

                                                        <!--SubMenu3-->
                                                        {{-- <div x-show="seleccionadoSubMenu2 == {{ $keySub2 }}" --}}
                                                        <div :style="seleccionadoSubMenu2 == {{ $keySub2 }} &&
                                                        { display: 'block' }"
                                                            x-on:click.away="seleccionadoSubMenu3 = null" x-transition
                                                            class="submenu_3">
                                                            @if (count($subMenu2['subMenu3']))
                                                                @foreach ($subMenu2['subMenu3'] as $keySub3 => $subMenu3)
                                                                    <div x-data="subMenu4"
                                                                        class="elementos_submenu_3">

                                                                        <!--SubMenu3 Nombres-->
                                                                        <div x-on:click="seleccionarSubMenu3({{ $keySub3 }})"
                                                                            class="menu_icono menu_icono_submenu"
                                                                            :style="seleccionadoSubMenu3 ==
                                                                                {{ $keySub3 }} &&
                                                                                { background: '#f3f4f6' }">

                                                                            @if (count($subMenu3['subMenu4']))
                                                                                <a
                                                                                    class="submenu_nombre">{{ $subMenu3['nombreSubMenu3'] }}</a>
                                                                                <i class="fa-solid fa-sort-down"></i>
                                                                            @else
                                                                                <a class="submenu_nombre"
                                                                                    href={{ $subMenu3['nombreSubMenu3Url'] }}>{{ $subMenu3['nombreSubMenu3'] }}</a>
                                                                            @endif

                                                                        </div>

                                                                        <!--SubMenu4-->
                                                                        {{-- <div x-show="seleccionadoSubMenu3 == {{ $keySub3 }}" --}}
                                                                        <div :style="seleccionadoSubMenu3 == {{ $keySub3 }} &&
                                                                        { display: 'block' }"
                                                                            x-on:click.away="seleccionadoSubMenu4 = null"
                                                                            x-transition class="submenu_4">
                                                                            @if (count($subMenu3['subMenu4']))
                                                                                @foreach ($subMenu3['subMenu4'] as $keySub4 => $subMenu4)
                                                                                    <!--SubMenu4 Nombres-->
                                                                                    <div
                                                                                        class="menu_icono menu_icono_submenu">
                                                                                        <a class="submenu_nombre"
                                                                                            href={{ $subMenu4['nombreSubMenu4Url'] }}>{{ $subMenu4['nombreSubMenu4'] }}</a>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
            <hr>
            <!-- FIN MENU-PRINCIPAL -->
        </div>
        <div class="contenedor_iconos">
            @auth
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">



                                @if (Auth::user()->rol == 'administrador')
                                    @if (Auth::user()->administrador->imagen_ruta)
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Storage::url(Auth::user()->administrador->imagen_ruta) }}"
                                            alt="{{ Auth::user()->administrador->nombre }}" />
                                    @else
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}" />
                                    @endif
                                @else
                                    @if (Auth::user()->cliente->imagen_ruta)
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Storage::url(Auth::user()->cliente->imagen_ruta) }}"
                                            alt="{{ Auth::user()->cliente->nombre }}" />
                                    @else
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}" />
                                    @endif
                                @endif


                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Menu Cliente -->
                            @if (Auth::user()->rol == 'administrador')
                                <x-jet-dropdown-link href="{{ route('administrador.perfil') }}">
                                    {{ __('Perfil') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="#">
                                    {{ __('Ordenes') }}
                                </x-jet-dropdown-link>
                            @else
                                <x-jet-dropdown-link href="{{ route('cliente.perfil') }}">
                                    {{ __('Perfil') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="#">
                                    {{ __('Ventas') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Cerrar Sesión -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Cerrar') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @else
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fa-solid fa-user" style="color: #666666;"></i>
                    </x-slot>
                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Entrar') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Registrar') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @endauth
            <i class="fa-solid fa-heart" style="color: #ffa03d;"></i>
            @livewire('frontend.menu.menu-carrito')
        </div>
    </nav>
</header>

@push('script')
    <script>
        function sidebar() {
            return {
                seleccionado: null,
                seleccionar(id) {
                    if (this.seleccionado == id) {
                        this.seleccionado = null;
                    } else {
                        this.seleccionado = id;
                    }
                },

                abiertoSidebar: false,
                toggleSidebar() {
                    this.abiertoSidebar = !this.abiertoSidebar
                },
                abrirSidebar() {
                    if (this.abiertoSidebar) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    } else {
                        this.abiertoSidebar = true;
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    }
                },
                cerrarSidebar() {
                    this.abiertoSidebar = false;
                    document.querySelector(".contenedor_menu_link").style.left = "-100%";
                }
            }
        }

        function subMenu1() {
            return {
                seleccionadoSubMenu1: null,
                seleccionarSubMenu1(id) {
                    if (this.seleccionadoSubMenu1 == id) {
                        this.seleccionadoSubMenu1 = null;
                    } else {
                        this.seleccionadoSubMenu1 = id;
                    }
                },
            }
        }

        function subMenu2() {
            return {
                seleccionadoSubMenu2: null,
                seleccionarSubMenu2(id) {
                    if (this.seleccionadoSubMenu2 == id) {
                        this.seleccionadoSubMenu2 = null;
                    } else {
                        this.seleccionadoSubMenu2 = id;
                    }
                },
            }
        }

        function subMenu3() {
            return {
                seleccionadoSubMenu3: null,
                seleccionarSubMenu3(id) {
                    if (this.seleccionadoSubMenu3 == id) {
                        this.seleccionadoSubMenu3 = null;
                    } else {
                        this.seleccionadoSubMenu3 = id;
                    }
                },
            }
        }

        function subMenu4() {
            return {
                seleccionadoSubMenu4: null,
                seleccionarSubMenu4(id) {
                    if (this.seleccionadoSubMenu4 == id) {
                        this.seleccionadoSubMenu4 = null;
                    } else {
                        this.seleccionadoSubMenu4 = id;
                    }
                },
            }
        }
    </script>
@endpush
