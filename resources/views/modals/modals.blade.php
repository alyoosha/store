<!-- Модальное окно "Товар добавлен в корзину"-->
<div class="modal fade modal_to-cart" id="modal-to-cart" tabindex="-1" role="dialog" aria-labelledby="modal-to-cart-title" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-block modal-block_small">
                    <button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
                        <svg role="img" aria-hidden="true" width="28" height="28">
                            <use xlink:href="#svg-icon-close"></use>
                        </svg>
                    </button>
                    <div class="modal-title section__title section__title_style2 section__title_has-line" id="modal-to-cart-title">Товар добавлен в корзину</div>
                    <div class="modal-subtitle section__title section__title_style4">
                        <p>Для оформления заказа и перехода в корзину нажмите оформить заказ.</p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md">
                            <button class="btn btn_default btn_transparent" type="button" data-dismiss="modal">Продолжить покупки</button>
                        </div>
                        <div class="col-12 col-md">
                            <button class="btn btn_default btn_blue js-modal-cart" type="button">Оформить заказ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно увеличенного просмотра товара-->
<div class="modal fade modal_zoom" id="modal-zoom" tabindex="-1" role="dialog" aria-labelledby="modal-zoom-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-slider js-modal-slider">
                    <button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
                        <svg role="img" aria-hidden="true" width="28" height="28">
                            <use xlink:href="#svg-icon-close"></use>
                        </svg>
                    </button>
                    <div class="swiper-container">
                        <div class="modal-slider__title" id="modal-zoom-title"></div>
                        <div class="swiper-wrapper"></div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-nav">
                            <button class="swiper-button-prev svg-icon" type="button">
                                <svg role="img" aria-hidden="true" width="24" height="24">
                                    <use xlink:href="#svg-icon-arrow-back"></use>
                                </svg>
                            </button>
                            <button class="swiper-button-next svg-icon" type="button">
                                <svg role="img" aria-hidden="true" width="24" height="24">
                                    <use xlink:href="#svg-icon-arrow-forward"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-slider__descr">
                            <p>Теперь не нужно класть бумажку с номером телефона под лобовое стекло. 4DRIVER позволит Вам оставаться анонимным.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно бесплатной наклейки-->
<div class="modal fade modal_free-stickers" id="modal-free-stickers" tabindex="-1" role="dialog" aria-labelledby="modal-free-stickers-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-block modal-block_small">
                    <button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
                        <svg role="img" aria-hidden="true" width="28" height="28">
                            <use xlink:href="#svg-icon-close"></use>
                        </svg>
                    </button>
                    <div class="free-stickers">
                        <div class="free-stickers__title modal-title section__title section__title_style2 section__title_has-line" id="modal-free-stickers-title">Получи наклейку 4Driver бесплатно</div>
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="free-stickers__img"><img src="images/content/gifts/gift-stickers.png" alt="Набор наклеек на стекло, 2 шт"/></div>
                            </div>
                            <div class="col-12 col-md-7">
                                <form class="free-stickers__form" name="reg-form" method="post">
                                    <div class="modal-subtitle section__title section__title_style4">Наклейка “4Driver”</div>
                                    <div class="form-group">
                                        <label class="form-label" for="reg-form-addr">Выбери пункт самовывоза</label>
                                        <select class="form-control form-select select-2 js-select2" id="reg-form-addr" name="reg-form-addr">
                                            @foreach($dataMap as $item)
                                                <option value="{{$item->address}}">{{$item->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="free-stickers__subtitle">Чтобы получить наклейку, перейдите в мессенджер:</div>
                                    <div class="free-stickers__btn-group"><a class="btn btn_circle btn_blue svg-icon" href="javascript void(0);" target="_blank" aria-label="Telegram">
                                        <svg role="img" aria-hidden="true" width="30" height="30">
                                            <use xlink:href="#svg-icon-telegram"></use>
                                        </svg></a><a class="btn btn_circle btn_blue svg-icon" href="javascript void(0);" target="_blank" aria-label="Viber">
                                        <svg role="img" aria-hidden="true" width="30" height="30">
                                            <use xlink:href="#svg-icon-viber"></use>
                                        </svg></a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-map" id="map"></div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "Заказ принят"-->
<modal-order-success></modal-order-success>
<!-- Модальное окно оформления заказа-->
<modal-cart
    raw_addresses="{{$addresses}}"
></modal-cart>

<!-- Модальное окно "О 4Driver"-->
<div class="modal fade modal_about" id="modal-about" tabindex="-1" role="dialog" aria-labelledby="modal-about-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-block">
                    <button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
                        <svg role="img" aria-hidden="true" width="28" height="28">
                            <use xlink:href="#svg-icon-close"></use>
                        </svg>
                    </button>
                    <div class="scrollbar-outer">
                        <div class="nav nav-tabs modal-nav" role="tablist">
                            @foreach($modalSlider as $key => $slide)
                            <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="tab-{{$slide->id}}" data-toggle="tab" href="#panel-{{$slide->id}}" role="tab" aria-controls="{{$slide->tab_title}}" aria-selected="true">{{$slide->tab_title}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="about-block">
                        <div class="tab-content">
                            @foreach($modalSlider as $key => $slide)
                                <div class="tab-pane fade {{$key == 1 ? 'show active' : ''}}" id="panel-{{$slide->id}}" role="tabpanel" aria-labelledby="tab-{{$slide->id}}">
                                    <div class="scrollbar-outer">
                                        <div class="modal-title section__title section__title_style3" id="modal-order-success-title">{{$slide->title}}</div>
                                        <div class="modal-descr">
                                            <div>{!! $slide->description !!}</div>
                                            @if($slide->has_next_link && isset($modalSlider[$slide->id +1]))
                                                <button class="btn btn-link js-switch-tab" type="button" data-target="tab-{{$slide->id +1}}">{{$modalSlider[$slide->id +1]->tab_title}}</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-video">
                                        <div class="video-responsive">
                                            <iframe width="988" height="556" src="{{$slide->uri_video}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="modal-reg">
                                        @if($slide->uri_button)
                                            <a class="btn btn_default btn_blue btn_justify js-btn-reg" href="{{$slide->uri_button}}" target="_blank">
                                                <span class="btn__text">{{$slide->text_button}}</span>
                                                <span class="btn__icon svg-icon" aria-hidden="true">
                                                  <svg role="img" aria-hidden="true" width="24" height="24">
                                                    <use xlink:href="#svg-icon-arrow-forward"></use>
                                                  </svg>
                                                </span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
