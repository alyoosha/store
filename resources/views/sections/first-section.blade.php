<section class="section section_gift" id="section-gift">
    <div class="container">
        <div class="gift-block">
            <div class="gift-block__slider">
                <div class="swiper-container js-gift-slider">
                    <div class="swiper-wrapper">
                        @foreach($mainSlider as $slide)
                            <div class="swiper-slide">
                                <div class="g-slide">
                                    <div class="g-slide__content">
                                        <div class="g-slide__title section__title section__title_style2">
                                            <h2>
                                                <span class="line">{!! $slide->title !!}</span>
                                            </h2>
                                        </div>
                                        <div class="g-slide__subtitle section__title section__title_style4">{{$slide->subtitle}}</div>

                                        @if(!$slide->uri_button)
                                        <button class="btn btn_default btn_blue g-slide__btn g-slide__btn_big" type="button" data-toggle="modal" data-target="#modal-about">
                                            <span class="btn__text">Подробнее</span>
                                            <span class="btn__icon svg-icon" aria-hidden="true">
                                                <svg role="img" aria-hidden="true" width="24" height="24">
                                                  <use xlink:href="#svg-icon-arrow-forward"></use>
                                                </svg>
                                            </span>
                                        </button>
                                        @else
                                            <a class="btn btn_default btn_blue g-slide__btn js-scroll-link" href="{{$slide->uri_button}}">
                                            <span class="btn__icon svg-icon" aria-hidden="true">
                                                <svg role="img" aria-hidden="true" width="24" height="24">
                                                  <use xlink:href="#svg-icon-cart"></use>
                                                </svg>
                                            </span>
                                                <span class="btn__text">{{$slide->text_button}}</span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="g-slide__img g-slide__img_phone">
                                        <img class="js-slide-img" src="{{asset('storage/' . $slide->image)}}" alt="{{$slide->title}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            @if($freeStickers['count'] > 0)
                <div class="gift-block__stickers">
                    <div class="g-stickers">
                        <div class="g-stickers__img"><img src="images/content/gifts/gift-sticker.png" alt="Наклейка на стекло фиолетовая"></div>
                        <div class="g-stickers__title section__title section__title_style3">
                            <h1>Получи наклейку 4Driver <span class="color-blue-light text-up">бесплатно</span></h1>
                        </div>
                        <div class="g-stickers__subtitle section__title section__title_style4">Осталось бесплатных наклеек</div>
                        <div class="g-stickers__counter stickers-counter js-stickers-counter" data-count="{{$freeStickers['count']}}">
                            @foreach($freeStickers['numbers'] as $number)
                                <span class="stickers-counter__item">{{$number}}</span>
                            @endforeach
                        </div>
                        <div class="g-stickers__btn">
                            <button class="btn btn_blue btn_big js-free-stickers" type="button" data-toggle="modal" data-target="#modal-free-stickers"><span class="btn__text">Заказать бесплатную наклейку</span></button>
                        </div>
                    </div>
                </div>
            @else

            @endif
        </div>
    </div>
</section>