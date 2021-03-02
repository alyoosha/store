<template>
	<section class="section section_buy-frame" id="section-buy-frame"
	    v-if="products.length > 0"
	>
		<div class="container">
			<div class="section__title section__title_style1 section__title_has-line">
				<h2>Выбери рамку для номера</h2>
			</div>
			<div class="frame-block">
				<div class="frame-block__form">
					<div class="section__title section__title_style2">Рамки</div>
					<div class="form-group">
						<label class="form-label" for="frames-equipment">Тип рамки</label>
						<select2 class="form-control form-select select-2 js-select2" :data_form="nameSelectEquipment"
						         v-model="selectedEquipmentId">
							<option
								v-for="frame in frames"
								:value="frame.name_id"
							>
							{{frame.package_name}} {{lcFirst(frame.name)}}
							</option>
						</select2>
					</div>
					<div class="form-group">
						<label class="form-label" for="frames-color">Цвет надписи</label>
						<select2 class="form-control form-select select-2 js-select2" :data_form="nameSelectColor"
						         v-model="selectedColorId">
							<option
								v-for="(color, key) in selectedColors"
								:value="color.color_id"
							>
								{{color.color_name}}
							</option>
						</select2>
					</div>
				</div>
				<div class="frame-block__slider">
					<div class="product-block">
						<button class="product-block__zoom btn btn_icon svg-icon js-btn-zoom" type="button" aria-label="Подробнее">
							<svg role="img" aria-hidden="true" width="24" height="24">
								<use xlink:href="#svg-icon-zoom"></use>
							</svg>
						</button>
						<div class="product-block__title">
							<h3>{{name}}</h3>

						</div>
						<div class="product-block__img js-frame-slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div
										class="swiper-slide"
										v-for="image in images"
										:data-name="image.name_id"
										:data-color="image.color_id"
									>
										<img :src="image.image" alt="Рамка для номера">
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
						<div class="product-block__counter counter-block js-counter">
							<div class="counter-block__count">
								<span class="js-count">
									{{count}}
								</span> шт.
							</div>
							<div class="counter-block__price">
								<span class="num js-counter-price" data-price="8" data-sum="8" data-count="2">
									{{sum}}
								</span>
								<span class="currency">&nbsp;BYN</span>
							</div>
							<button class="counter-block__btn counter-block__btn_plus svg-icon js-counter-plus"
							        type="button"
							        aria-label="Прибавить"
							        @click="addProduct(), changeSum()"
							>
								<svg role="img" aria-hidden="true" width="18" height="18">
									<use xlink:href="#svg-icon-plus"></use>
								</svg>
							</button>
							<button class="counter-block__btn counter-block__btn_minus svg-icon js-counter-minus"
							        type="button"
							        aria-label="Отнять"
							        @click="removeProduct(), changeSum()"
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
						<div class="product-block__descr">
							<p>{{descr}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
    import {eventBus} from '../app.js'
    // import {Cookies} from '../app.js'
    import getCookie from "../mixins/getCookie";
    import updateCookie from "../mixins/updateCookie";

    export default {
        name: "SecondSection",
        mixins: [getCookie, updateCookie],
        props: {
            raw_products : {
                type : [String],
                default: ''
            },
            raw_types : {
                type : [String],
                default: ''
            },
            raw_colors : {
                type : [String],
                default: ''
            },
	    },
	    data() {
            return {
                frames : [],
                colors : [],
                selectedColors : [],
                products : [],
                currentProduct: [],
                images : [],
	            swiper: {},
                count : 1,
	            sum: 0,
	            name: '',
	            descr: '',
	            price: 0,
	            selectedEquipmentId: 1,
	            selectedColorId: 1,
	            nameSelectEquipment: 'frames-equipment',
	            nameSelectColor: 'frames-color',
            }
	    },
	    beforeMount() {
            this.frames = JSON.parse(this.raw_types)['Рамка'] ?? '';
			this.products = JSON.parse(this.raw_products);
			this.colors = JSON.parse(this.raw_colors);

			if(this.frames[0]) {
                this.selectedEquipmentId = this.frames[0].name_id
            }

			if(this.colors[this.selectedEquipmentId]) {
                this.selectedColorId = this.colors[this.selectedEquipmentId][0].color_id;
                this.selectedColors = this.colors[this.selectedEquipmentId];
            }

			this.products.forEach(e => {
			    if(e.images) {
			        this.images = this.images.concat(e.images);
                }
			});

			if(this.products[0]) {
			    this.currentProduct = this.products[0];
                this.name = this.products[0].type_name + ' ' + this.lcFirst(this.products[0].name);
                this.descr = this.products[0].description;
                this.price = this.products[0].basic_price;
                this.sum = this.products[0].basic_price * this.count;
            }
        },
	    mounted() {
            if($(".js-frame-slider").length ) {
                this.swiper = new Swiper(".js-frame-slider .swiper-container", {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 0,
                    speed: 600,
                    watchOverflow: true,
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true,
                    },
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                        el: ".js-frame-slider .swiper-pagination",
                        type: "bullets",
                        clickable: true,
                        bulletElement: "button",
                    },
                    navigation: {
                        nextEl: ".js-frame-slider .swiper-button-next",
                        prevEl: ".js-frame-slider .swiper-button-prev",
                    }
                });

                let equipment_id = this.getValueSelectEquipment();
                let color_id = this.getValueSelectColor();

                this.displaySlides(equipment_id, color_id);
            }
	    },
        created: function() {
            eventBus.$on('input', (value, name)=> {
                let equipmentId,
                    colorId;

                if(this.nameSelectEquipment == name) {
                    colorId = this.getValueSelectColor();
                    this.displaySlides(value, colorId);
                }

                if(this.nameSelectColor == name) {
                    equipmentId = this.getValueSelectEquipment();
                    this.displaySlides(equipmentId, value);
                }

                equipmentId = equipmentId ?? value;
                colorId = colorId ?? value;

                this.changeData(equipmentId, colorId);
            });
        },
	    methods : {
            lcFirst(str) {
		        if (!str) return str;
		        return str[0].toLowerCase() + str.slice(1);
		    },
		    getValueSelectEquipment() {
				return $('select[name="' + this.nameSelectEquipment + '"]').val();
		    },
		    getValueSelectColor() {
                return $('select[name="' + this.nameSelectColor + '"]').val();
		    },
		    displaySlides(equipment, color) {
                $('.js-frame-slider .swiper-slide:not([data-name="' + equipment + '"][data-color="' + color + '"])').css('display','none');
                $('.js-frame-slider .swiper-slide:not([data-name="' + equipment + '"][data-color="' + color + '"])').addClass('hide');

                $('.js-frame-slider .swiper-slide[data-name="' + equipment + '"][data-color="' + color + '"]').css('display','block');
                $('.js-frame-slider .swiper-slide[data-name="' + equipment + '"][data-color="' + color + '"]').removeClass('hide');
                this.swiper.update();
		    },
		    changeData(equipmentId, colorId) {
				this.products.forEach(e => {
                    if(e.name_id == equipmentId && e.color_id == colorId) {
                        this.currentProduct = e;
                        this.name = e.type_name + ' ' + this.lcFirst(e.name);
                        this.descr = e.description;
                        this.price = e.basic_price;
                        this.sum = e.basic_price * this.count;
				   }
				});
		    },
		    addProduct() {
                ++this.count;
		    },
		    removeProduct() {
                if(this.count > 1) {
                    --this.count;
                }
		    },
            changeSum() {
				this.sum = this.price * this.count;
            },
		    addToCard() {
                let product = {},
	                cart = {};

                product.sum = this.sum;
                product.count = this.count;
                product.product = this.currentProduct;

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
                $(".js-header-cart").removeAttr("disabled");
                $("#modal-to-cart").modal("show");
		    }
	    }
    }
</script>

<style scoped>

</style>