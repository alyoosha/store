<template>
	<div class="modal fade modal_to-cart modal_order-success" id="modal-order-success" tabindex="-1" role="dialog" aria-labelledby="modal-order-success-title" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-block modal-block_small">
						<button class="btn svg-icon modal-close" type="button" data-dismiss="modal" aria-label="Закрыть">
							<svg role="img" aria-hidden="true" width="28" height="28">
								<use xlink:href="#svg-icon-close"></use>
							</svg>
						</button>
						<div class="modal-title section__title section__title_style2 section__title_has-line" id="modal-order-success-title">Ваш заказ принят</div>
						<div class="modal-subtitle section__title section__title_style4">
							<p>Спасибо за Ваш заказ</p>
							<p>Наш менеджер свяжется с Вами в ближайшее время.</p>
						</div>
						<table class="modal-order-info modal-subtitle section__title section__title_style4">
							<tbody>
							<tr class="tr">
								<th class="th">Код заказа:</th>
								<td class="td">{{order.number_order}}</td>
							</tr>
							<tr class="tr"
								v-if="!order.is_mail"
							>
								<th class="th">Адрес <span class="delivery-type">самовывоза</span>:
								               <!-- или Адрес доставки-->
								</th>
								<td class="td">{{order.address_delivery}}</td>
							</tr>
							<tr class="tr"
								v-else
							>
								<th class="th">Адрес <span class="delivery-type">почты</span>:
								               <!-- или Адрес доставки-->
								</th>
								<td class="td">{{order.address}}, {{order.postcode}}</td>
							</tr>
							<tr class="tr">
								<th class="th">Товары:</th>
								<td class="td">
									<span v-for="(item, key) in products">{{key > 0 ? ', ' : ''}}
										{{item.product.type_name}} {{replaceEnding(item.product.color_name, -2, 'ая')}},
										{{item.product.name}} ({{item.count}} шт)
									</span>
								</td>
							</tr>
							</tbody>
						</table>
						<div class="row">
							<div class="col-12 col-sm-6">
								<button class="btn btn_default btn_blue btn_justify" type="button" data-dismiss="modal"><span class="btn__text">Ок</span><span class="btn__icon svg-icon" aria-hidden="true">
                      <svg role="img" aria-hidden="true" width="24" height="24">
                        <use xlink:href="#svg-icon-arrow-forward"></use>
                      </svg></span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import {eventBus} from '../app.js'
    import replaceEnding from "../mixins/replaceEnding";

    export default {
        name: "ModalOrderSuccess",
	    mixins: [replaceEnding],
	    data() {
            return {
				order: [],
	            products: []
            }
	    },
	    created() {
            eventBus.$on('order', (data) => {
                this.order = data.data;
                this.products = JSON.parse(this.order.products);

                console.log(this.order);

                $("#modal-cart").modal("hide");
                setTimeout(function(){$("#modal-order-success").modal("show");}, 400);
            });
	    },
	    beforeMount() {

	    },
	    methods: {

	    },
    }
</script>

<style scoped>

</style>