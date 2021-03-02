<template>
	<section class="section section_buy-sticker" id="section-buy-sticker"
	    v-if="stickers.length > 0"
	>
		<div class="container">
			<div class="section__title section__title_style1 section__title_right section__title_has-line">
				<h2>Наклейки на стекло</h2>
			</div>
			<div class="sticker-slider js-sticker-slider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide"
							v-for="(sticker, key) in stickers"
						    :data-num="key"
						    :data-name="sticker.name_id"
						    :data-color="sticker.color_id"
						>
							<div class="product-block" tabindex="0">
								<button class="product-block__zoom btn btn_icon svg-icon js-btn-zoom" type="button" aria-label="Подробнее">
									<svg role="img" aria-hidden="true" width="24" height="24">
										<use xlink:href="#svg-icon-zoom"></use>
									</svg>
								</button>
								<div class="product-block__title sr-only">
									<h3>{{sticker.type_name}} {{replaceEnding(lcFirst(sticker.color_name), -2, 'ая')}}</h3>
								</div>
								<div class="product-block__descr sr-only">
									<p>{{sticker.description}}</p>
								</div>
								<div class="product-block__img">
									<img :src="sticker.images[0] ? sticker.images[0].image : ''"
									     :alt="sticker.description">
								</div>
								<div class="product-block__counter counter-block js-counter">
									<div class="counter-block__count">
										<span class="js-count">
											{{count[key] ? count[key] : ''}}
										</span> шт.
									</div>
									<div class="counter-block__price">
										<span class="num js-counter-price" data-price="8" data-sum="8" data-count="2">
											{{sum[key] ? sum[key] : ''}}
										</span>
										<span class="currency">&nbsp;BYN</span>
									</div>
									<button class="counter-block__btn counter-block__btn_plus svg-icon js-counter-plus"
									    type="button"
									    aria-label="Прибавить"
									    @click="addProduct($event), changeSum($event)"
									>
										<svg role="img" aria-hidden="true" width="18" height="18">
											<use xlink:href="#svg-icon-plus"></use>
										</svg>
									</button>
									<button class="counter-block__btn counter-block__btn_minus svg-icon js-counter-minus"
									    type="button"
									    aria-label="Отнять"
									    @click="removeProduct($event), changeSum($event)"
									>
										<svg role="img" aria-hidden="true" width="18" height="18">
											<use xlink:href="#svg-icon-minus"></use>
										</svg>
									</button>
								</div>
								<button class="btn btn_default btn_blue product-block__buy js-add-to-cart"
								    type="button"
								    @click="addToCard($event)"
								>
									<span class="btn__icon svg-icon" aria-hidden="true">
					                    <svg role="img" aria-hidden="true" width="24" height="24">
					                      <use xlink:href="#svg-icon-cart"></use>
					                    </svg>
									</span>
									<span class="btn__text">В корзину</span>
								</button>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
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
				</div>
			</div>
		</div>
	</section>
</template>

<script>
    import updateCookie from "../mixins/updateCookie";
    // import {Cookies} from '../app.js'

    export default {
        name: "ThirdSection",
        mixins: [updateCookie],
        props: {
            raw_products : {
                type : [String],
                default: ''
            },
            raw_types : {
                type : [String],
                default: ''
            },
        },
        data() {
            return {
                stickers : [],
                products : [],
	            currentProduct: [],
                images : [],
                swiper: {},
                count : [],
                sum: [],
                price: [],
            }
        },
        beforeMount() {
            this.stickers = JSON.parse(this.raw_types)['Наклейка'] ?? '';
            this.products = JSON.parse(this.raw_products);

            if(this.stickers.length > 0) {
                this.stickers.forEach((e) => {
                    this.sum.push(e.basic_price);
                    this.count.push(2);
                });
            }
        },
        mounted() {
            if($(".js-sticker-slider").length ) {
                this.swiper = new Swiper(".js-sticker-slider .swiper-container", {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 10,
                    speed: 600,
                    centerInsufficientSlides: true,
                    watchOverflow: true,
                    pagination: {
                        el: ".js-sticker-slider .swiper-pagination",
                        type: "bullets",
                        clickable: true,
                        bulletElement: "button",
                    },
                    navigation: {
                        nextEl: ".js-sticker-slider .swiper-button-next",
                        prevEl: ".js-sticker-slider .swiper-button-prev",
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        1200: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        1560: {
                            slidesPerView: 3,
                            spaceBetween: 50,
                        }
                    }
                });
            }
        },
        methods : {
            lcFirst(str) {
                if (!str) return str;
                return str[0].toLowerCase() + str.slice(1);
            },
	        replaceEnding(str, end, ending) {
                if (!str) return str;
                return str.slice(0, end) + ending;
	        },
            addProduct(event) {
                let num = $(event.target).closest('.swiper-slide').attr('data-num');
                this.count.splice(num, 1, this.count[num] + 2);
            },
            removeProduct(event) {
                let num = $(event.target).closest('.swiper-slide').attr('data-num');

                if(this.count[num] > 2) {
                    this.count.splice(num, 1, this.count[num] - 2);
                }
            },
            changeSum(event) {
                let num = $(event.target).closest('.swiper-slide').attr('data-num');

                this.sum.splice(num, 1, this.stickers[num].basic_price * this.count[num] / 2);
            },
            addToCard(event) {
                let num = $(event.target).closest('.swiper-slide').attr('data-num');
                let nameId = $(event.target).closest('.swiper-slide').attr('data-name');
                let colorId = $(event.target).closest('.swiper-slide').attr('data-color');

                let product = {},
                    cart = {};

                product.sum = this.sum[num];
                product.count = this.count[num];

                this.products.forEach(e => {
                    if(e.name_id == nameId && e.color_id == colorId) {
                        product.product = e;
                    }
                });

                this.$store.commit('add_to_cart', product);
                this.$store.commit('enlarge_count', this.$store.getters.get_count + 1);

                cart.products = [];

                cart.count = this.$store.getters.get_count;
                let products = this.$store.getters.get_products;

                if(products.length > 0) {
                    products.forEach(e => {
                        cart.products.push(e);
                    });
                }

                this.updateCookie(cart);

                this.sum.splice(num, 1, this.stickers[num].basic_price);
                this.count.splice(num, 1, 2);

                $(".js-header-cart").removeAttr("disabled");
                $("#modal-to-cart").modal("show");
            },
        }
    }
</script>

<style scoped>

</style>