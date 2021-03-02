<template>
	<div class="modal fade modal_cart" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="modal-cart-title" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-block">
						<button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
							<svg role="img" aria-hidden="true" width="28" height="28">
								<use xlink:href="#svg-icon-close"></use>
							</svg>
						</button>
						<form name="order-form"
						      id="order-form"
						      method="post"
						>
							<div class="cart">
								<div class="cart__form">
									<div class="modal-title section__title section__title_style2 section__title_has-line" id="modal-cart-title">Оформление заказа</div>
									<div class="form-group">
										<label class="form-label" for="order-form-addr">Тип доставки</label>
										<select2 class="form-control form-select select-2 js-select2" :data_form="nameSelect"
										         v-model="selectedDelivery">
											<option
												v-for="address in addresses"
												:value="address.address"
												:data-mail="address.is_mail ? 1 : 0"
											>
												{{!address.is_mail ? 'Самовызов' : ''}} {{address.address}}
											</option>
										</select2>
									</div>
									<div class="order-wrapper">
										<div class="scrollbar-outer">
											<template
												v-for="(item,key) in products"
											>
												<div class="order-block"
												     v-if="item"
												     :data-number="key"
												     :data-type="item.product.type_name"
												>
													<div class="order-block__img">
														<img :src="item.product.images[0] ? item.product.images[0].image : ''"
														     :alt="item.product.type_name + ' ' + item.product.name + ' ' + item.product.color_name"/>
													</div>
													<div class="order-block__info">
														<div class="order-block__type">{{item.product.type_name}}</div>
														<div class="order-block__params">{{item.product.name}}, {{item.product.color_name}}</div>
													</div>
													<div class="order-block__counter">
														<div class="counter-block js-counter">
															<div class="counter-block__count">
																<span class="js-count">{{item.count}}</span> шт.
															</div>
															<div class="counter-block__price">
															<span class="num js-counter-price" data-price="8"
															      data-sum="8" data-count="2">{{item.sum}}</span>
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
													</div>
													<div class="order-block__remove">
														<button class="btn svg-icon btn_remove js-order-remove"
														        type="button"
														        aria-label="Удалить"
														        :data-num="key"
														        @click="removeFromCart($event)"
														>
															<svg role="img" aria-hidden="true" width="20" height="20">
																<use xlink:href="#svg-icon-close"></use>
															</svg>
														</button>
													</div>
												</div>
											</template>
										</div>
									</div>
								</div>
								<div class="cart__sum">
									<!-- Если доставка до почты, то добавляется форма-->
									<div class="cart__fieldset js-hide-block">
										<div class="form-group">
											<label class="form-label form-label_hidden" for="user-name">ФИО</label>
											<input class="form-control"
											       type="text"
											       id="user-name"
											       name="user-name"
											       placeholder="ФИО"
											       autocomplete="off"
											       v-model.lazy="$v.name.$model"
											       @blur="$v.name.$touch(), clearBackError($event), updateStatus()"
											/>
											<div class="form-error" v-if="!$v.name.required && $v.name.$error">Поле обязательно для заполнения</div>
											<div class="form-error" v-if="!$v.name.minLength && $v.name.$error">Длина имени не менее {{$v.name.$params.minLength.min}} букв</div>
											<div class="form-error" v-if="backError['user-name']">{{backError['user-name']}}</div>
										</div>
										<div class="form-group">
											<label class="form-label form-label_hidden" for="user-address">Адрес (город, улица, кв.)</label>
											<input class="form-control" type="text" id="user-address"
											       name="user-address" placeholder="Адрес (город, улица, кв.)"
											       autocomplete="off"
											       @blur="$v.address.$touch(),clearBackError($event), updateStatus()"
											       v-model.lazy="$v.address.$model"/>
											<div class="form-error" v-if="!$v.address.required && $v.address.$error">Поле обязательно для заполнения</div>
											<div class="form-error" v-if="backError['user-address']">{{backError['user-address']}}</div>
										</div>
										<div class="row">
											<div class="col-12 col-xl-6">
												<div class="form-group">
													<label class="form-label form-label_hidden" for="user-post-code">Почтовый индекс</label>
													<input class="form-control" type="text" id="user-post-code"
													       name="user-post-code" placeholder="Индекс"
													       autocomplete="off" @blur="$v.postcode.$touch(),
													       clearBackError($event), updateStatus()"
													       v-model.lazy="$v.postcode.$model"/>
													<div class="form-error" v-if="!$v.postcode.required && $v.postcode.$error">Поле обязательно для заполнения</div>
													<div class="form-error" v-if="!$v.postcode.minLength && $v.postcode.$error">Длина почтового индекса не менее {{$v.name.$params.minLength.min}} цифр</div>
													<div class="form-error" v-if="!$v.postcode.integer && $v.postcode.$error">Почтовый индекс должен содержать только цифры</div>
													<div class="form-error" v-if="backError['user-post-code']">{{backError['user-post-code']}}</div>

												</div>
											</div>
											<div class="col-12 col-xl-6">
												<div class="form-group">
													<label class="form-label form-label_hidden" for="user-phone-number">Телефон</label>
													<input class="form-control" type="tel" id="user-phone-number"
													       name="user-phone-number" placeholder="Телефон"
													       autocomplete="off" @blur="$v.phone.$touch(),
													       clearBackError($event), updateStatus()"
													       v-model.lazy="$v.phone.$model"/>
													<div class="form-error" v-if="!$v.phone.required && $v.phone.$error">Поле обязательно для заполнения</div>
													<div class="form-error"
													     v-if="!$v.phone.integer && $v.phone.$error">Номер телефона может содержать только цифры</div>
													<div class="form-error"
													     v-if="!$v.phone.minLength && $v.phone.$error">Длина телефона не менее {{$v.phone.$params.minLength.min}} цифр</div>
													<div class="form-error" v-if="backError['user-phone-number']">{{backError['user-phone-number']}}</div>
												</div>
											</div>
										</div>
										<div class="cart__delivery">Доставка: <span class="num">5</span>&nbsp;BYN</div>
									</div>
									<!-- Если выбран самовывоз, то отображается только этот блок-->
									<div class="cart__total">
										<div class="cart__sum-title">Итого: <span class="num">{{total}}</span>&nbsp;BYN</div>
										<button class="btn btn_default btn_blue btn_justify js-btn-order"
										        type="submit"
										        @click="makeOrder($event)"
										        :disabled="!submitStatus || backError.has_error"
										>
											<span class="btn__text">Оплатить</span>
											<span class="btn__icon svg-icon" aria-hidden="true">
						                        <svg role="img" aria-hidden="true" width="24" height="24">
						                          <use xlink:href="#svg-icon-arrow-forward"></use>
						                        </svg>
											</span>
										</button>
									</div>
								</div>
							</div>
							<input type="hidden" name="is-mail" :value="isMail">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {eventBus} from '../app.js'
    import updateCookie from "../mixins/updateCookie";
    import { required, minLength, numeric, integer } from 'vuelidate/lib/validators';

    export default {
        name: "ModalCart",
        mixins: [updateCookie],
        props: {
            raw_addresses: {
                type: [String],
                default: ''
            }
        },
	    data() {
            return {
                nameSelect: 'order-form-addr',
	            addresses: [],
	            products: [],
                count : [],
                sum: [],
                price: [],
                total: 0,
	            selectedDelivery: 1,
	            name: '',
	            address: '',
	            phone: '',
	            postcode: '',
	            isMail: '',
                submitStatus: false,
	            backError: {
                    'has_error': false,
                    'user-name': false,
                    'user-phone-number': false,
                    'user-address': false,
                    'user-post-code': false
	            }
            }
	    },
        validations: {
            name: {
                required,
                minLength: minLength(3),
            },
            address: {
                minLength: minLength(3),
                required,
            },
            postcode: {
                required,
                minLength: minLength(6),
                integer
            },
            phone: {
                required,
                integer,
                minLength: minLength(11),
            }
        },
	    beforeMount() {
            this.addresses = JSON.parse(this.raw_addresses);

            if(this.addresses[0]) {
                this.selectedDelivery = this.addresses[0].address;
            }

            this.products = this.$store.getters.get_products;

            this.recalculateTotal();
        },
	    mounted() {
            let vue = this;

            if(this.addresses[0]) {
                this.hideBlock(this.addresses[0].is_mail);
	            this.isMail = this.addresses[0].is_mail;
            }

            if(!this.isMail) {
                this.submitStatus = true;
            }

            $('#modal-cart').on('show.bs.modal', function (e) {
                vue.products = vue.$store.getters.get_products;

                vue.recalculateTotal();
            })
	    },
        created: function() {
            eventBus.$on('input', (value, name, obj)=> {
               let isMail = Number.parseInt(obj.options[obj.selectedIndex].dataset.mail);
               this.isMail = isMail;

                if(!this.isMail) {
                    this.submitStatus = true;
                }
                else {
                    this.submitStatus = false;
                }

               this.hideBlock(isMail);
            });
        },
	    methods: {
            hideBlock(isMail) {
                if(isMail) {
                    $('.js-hide-block').removeClass('hidden')
                }
                else {
                    $('.js-hide-block').addClass('hidden')
                }
            },
		    removeFromCart(event) {
                let num = event.target.dataset.num;
                this.$store.commit('remove_from_cart', num);
                this.$store.commit('reduce_count');
                this.products = this.$store.getters.get_products;
                let user = this.$store.getters.get_user;
				this.updateCookie(user);

                if(this.products.length == 0) {
                    $('#modal-cart').modal('hide');
                    $('.js-header-cart').attr('disabled', 'disabled');
                }

                this.recalculateTotal();
            },
            changeSum(event) {
                let num = $(event.target).closest('.order-block').attr('data-number');
                let type = $(event.target).closest('.order-block').attr('data-type');

                if(type == 'Наклейка') {
                    // this.sum.splice(num, 1, this.products[num].product.basic_price * this.count[num] / 2);
                    this.products[num].sum = this.products[num].product.basic_price * this.products[num].count / 2;
                }
                else {
                    // this.sum.splice(num, 1, this.products[num].product.basic_price * this.count[num]);
                    this.products[num].sum = this.products[num].product.basic_price * this.products[num].count;
                }

                this.$store.commit('update_product', {num, product: this.products[num]});

                let user = this.$store.getters.get_user;

                this.updateCookie(user);
                this.recalculateTotal();
            },
            addProduct(event) {
                let num = $(event.target).closest('.order-block').attr('data-number');
                let type = $(event.target).closest('.order-block').attr('data-type');

                if(type == 'Наклейка') {
                    // this.products[num].splice(num, 1, this.count[num] + 2);
                    this.products[num].count = this.products[num].count + 2;
                }
                else {
                    // this.count.splice(num, 1, this.count[num] + 1);
                    this.products[num].count = this.products[num].count + 1;
                }
            },
            removeProduct(event) {
                let num = $(event.target).closest('.order-block').attr('data-number');
                let type = $(event.target).closest('.order-block').attr('data-type');

                if(type == 'Наклейка') {
                    if(this.products[num].count > 2) {
                        // this.count.splice(num, 1, this.count[num] - 2);
                        this.products[num].count = this.products[num].count - 2;
                    }
                }
                else {
                    if(this.products[num].count > 1) {
                        // this.count.splice(num, 1, this.count[num] - 1);
                        this.products[num].count = this.products[num].count - 1;
                    }
                }
            },
		    makeOrder(event) {
                event.preventDefault();
                $(event.target).attr('disabled','disabled');

                let form = document.forms['order-form'];
                let products = JSON.stringify(this.$store.getters.get_products);
                form = new FormData(form);
                form.set('products', products);

                axios
	                .post('/api/make-order', form)
	                .then(response => {
                        $(event.target).removeAttr('disabled');
                        let data = response.data;

                        if(data.error) {
                            if(data.input == 'user-name') {
								this.backError.has_error = true;
								this.backError['user-name'] = data.message;
                            }
                            if(data.input == 'user-address') {
								this.backError.has_error = true;
                                this.backError['user-address'] = data.message;
                            }
                            if(data.input == 'user-post-code') {
								this.backError.has_error = true;
                                this.backError['user-post-code'] = data.message;
                            }
                            if(data.input == 'user-phone-number') {
								this.backError.has_error = true;
                                this.backError['user-phone-number'] = data.message;
                            }

                            return;
                        }


                        this.$store.commit('add_user', this.$root.user);
                        this.updateCookie(this.$root.user);
                        $('.js-header-cart').attr('disabled', 'disabled');
                        eventBus.$emit('order', response.data);
	                })
	                .catch(error => {
						console.log(error);
	                });
		    },
		    clearBackError(event) {
				let name = event.target.name;
				this.backError[name] = false;
				this.backError.has_error = false;
		    },
            recalculateTotal() {
                let total = 0;

                if(this.products.length > 0) {
                    this.products.forEach((e, k) => {
                        if(e) {
                            total +=  e.sum;
                        }
                    });

                    this.total = total;
                }
            },
		    updateStatus() {
                this.$v.$touch();

                if(this.$v.$error) {
                    this.submitStatus = false
                } else {
                    this.submitStatus = true
                }
		    }
	    }
    }
</script>

<style scoped>
	.form-error {
		font-size: 12px;
		padding: 5px;
	}
	.btn.btn_default.btn_blue[disabled] {
		box-shadow: none;
	}
</style>