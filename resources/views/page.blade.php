<!DOCTYPE html>
<html lang="ru">
<head>
    <title>4Driver Store</title>
    <meta charset="utf-8"/>
    <meta content="4Driver Store" name="description"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!-- Стили прелоадера--><style></style>
    <!-- Фавиконка	-->
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png"/>
    <link rel="shortcut icon" href="favicons/favicon.ico"/>
    <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png"/>
    <link rel="manifest" href="favicons/site.webmanifest"/>
    <link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="7334AE"/>
    <meta name="msapplication-TileColor" content="#7334AE"/>
    <meta name="msapplication-TileImage" content="favicons/mstile-150x150.png"/>
    <meta name="msapplication-config" content="favicons/browserconfig.xml"/>
    <meta name="theme-color" content="#7334AE"/>
    <!-- Шрифт-->
    <link rel="preload" href="fonts/Gilroy-Regular.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
    <link rel="preload" href="fonts/Gilroy-SemiBold.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
    <link rel="preload" href="fonts/Gilroy-Medium.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
    <link rel="preload" href="fonts/Gilroy-UltraLight.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
    <link rel="preload" href="fonts/Gilroy-Black.woff2" as="font" type="font/woff2" crossorigin="crossorigin"/>
    <!-- CSS-->
    <link rel="stylesheet" href="/public/css/main.css"/>
</head>
<body>
    <div id="app">
        <div class="preloader d-none" aria-label="Загрузка..."></div>
        <header class="header">
            <div class="header__desktop d-none d-lg-block">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto"><a class="header__logo svg-icon js-scroll-link" href="#section-gift" aria-label="4Driver Store">
                                <svg role="img" aria-hidden="true" width="80" height="80">
                                    <use xlink:href="#svg-icon-4drv"></use>
                                </svg></a></div>
                        <div class="col-auto">
                            <ul class="list list_unstyled header__nav">
                                <li class="list-item"><a class="nav-link js-scroll-link" href="#section-buy-frame">Купить рамку</a></li>
                                <li class="list-item"><a class="nav-link js-scroll-link" href="#section-buy-sticker">Купить наклейку</a></li>
                                <li class="list-item"><a class="nav-link" href="#modal-about" data-toggle="modal">О проекте 4Driver</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn_transparent btn_default header__cart js-header-cart" type="button" aria-label="Корзина" data-toggle="modal" data-target="#modal-cart" @if(isset($cookie['count']) && $cookie['count'] == 0) disabled="disabled" @endif>
                                <span class="btn__icon svg-icon" aria-hidden="true">
                                    <svg role="img" aria-hidden="true" width="26" height="26">
                                      <use xlink:href="#svg-icon-cart"></use>
                                    </svg>
                                    <span class="btn__marker"></span>
                                </span>
                                <span class="btn__text">Корзина</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__mobile">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <button class="btn btn_icon header__menu js-menu-toggler" type="button" aria-label="Показать/скрыть меню"><span class="btn__icon btn__icon_bar svg-icon" aria-hidden="true">
                          <svg role="img" aria-hidden="true" width="32" height="32">
                            <use xlink:href="#svg-icon-menu"></use>
                          </svg></span><span class="btn__icon btn__icon_close svg-icon" aria-hidden="true">
                          <svg role="img" aria-hidden="true" width="32" height="32">
                            <use xlink:href="#svg-icon-close"></use>
                          </svg></span></button>
                        </div>
                        <div class="col-auto"><a class="header__logo-mobile svg-icon js-scroll-link" href="#section-gift" aria-label="4Driver Store">
                                <svg role="img" aria-hidden="true" width="52" height="52">
                                    <use xlink:href="#svg-icon-4drv"></use>
                                </svg></a></div>
                        <div class="col-auto">
                            <button class="btn btn_icon header__cart-mobile js-header-cart" type="button" aria-label="Корзина" data-toggle="modal" data-target="#modal-cart" disabled="disabled"><span class="btn__icon svg-icon" aria-hidden="true">
                          <svg role="img" aria-hidden="true" width="28" height="28">
                            <use xlink:href="#svg-icon-cart"></use>
                          </svg><span class="btn__marker"></span></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-overlay js-menu-closer"></div>
            <div class="header__panel panel panel-menu">
                <div class="panel__content">
                    <ul class="list list_unstyled panel__nav">
                        <li class="list-item"><a class="nav-link js-scroll-link" href="#section-buy-frame">Купить рамку</a></li>
                        <li class="list-item"><a class="nav-link js-scroll-link" href="#section-buy-sticker">Купить наклейку</a></li>
                        <li class="list-item"><a class="nav-link" href="#modal-about" data-toggle="modal">О проекте 4Driver</a></li>
                    </ul>
                    <ul class="list list_unstyled panel__socials">
                        <li class="list-item"><a class="social-link svg-icon" href="javascript: void(0);" target="_blank" aria-label="Twitter">
                            <svg role="img" aria-hidden="true" width="30" height="30">
                                <use xlink:href="#svg-icon-twitter"></use>
                            </svg></a></li>
                        <li class="list-item"><a class="social-link svg-icon" href="javascript: void(0);" target="_blank" aria-label="Instagram">
                            <svg role="img" aria-hidden="true" width="30" height="30">
                                <use xlink:href="#svg-icon-instagram"></use>
                            </svg></a></li>
                        <li class="list-item"><a class="social-link svg-icon" href="javascript: void(0);" target="_blank" aria-label="Telegram">
                            <svg role="img" aria-hidden="true" width="30" height="30">
                                <use xlink:href="#svg-icon-telegram"></use>
                            </svg></a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main class="main-content" id="main-content">
            @include('sections.first-section')

            <second-section
                raw_types="{{$types}}"
                raw_products="{{$products}}"
                raw_colors="{{$colors}}"
            ></second-section>

            <third-section
                raw_types="{{$types}}"
                raw_products="{{$products}}"
            ></third-section>
        </main>

        @include('parts.footer')

        @include('modals.modals')

        @include('parts.svg')
    </div>

    @push('scripts')
        <script type="application/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="application/javascript" src="js/core-dist.js"></script>
        <script type="application/javascript" defer src="https://api-maps.yandex.ru/2.1/?apikey=38e866db-42c5-4d36-82ca-1494fe5696ff&amp;lang=ru_RU" type="text/javascript"></script>
        <script type="application/javascript" async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script type="application/javascript" src="js/main.js"></script>
        <script type="application/javascript" src="js/app.js"></script>

        <script type="application/javascript">
            $(document).ready(function(){
                var dataMap = '{{ $dataMap->toJson() }}';

                var data = JSON.parse(dataMap.replace(/&quot;/g, '"')),
                    pointers = [];

                data.forEach((e) => {
                    let p = [];

                    p.push(e.longitude);
                    p.push(e.latitude);

                    pointers.push(p);
                });


                ymaps.ready(function () {
                    var myMap = new ymaps.Map('map', {
                        center: [53.934462, 27.655383],
                        zoom: 17,
                        controls: ['zoomControl',  'fullscreenControl']
                    });

                    for(i = 0; i < pointers.length; ++i) {
                        var place = new ymaps.Placemark(pointers[i],
                            {
                                hintContent: 'Egorov Agency',
                                balloonContent: ''
                            }, {
                                iconLayout: 'default#image',
                                iconImageHref: 'images/content/map-pin.png',
                                iconImageSize: [56, 56],
                                iconImageOffset: [-28, -28]
                            }
                        );

                        myMap.geoObjects.add(place);
                    }

                    myMap.behaviors.disable('scrollZoom');
                });
            });
        </script>
    @endpush

    @stack('scripts')
</body>
</html>