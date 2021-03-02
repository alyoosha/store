<template>
	<select :name="data_form" :id="data_form">
		<slot></slot>
	</select>
</template>

<script>
    import {eventBus} from '../app.js'

    export default {
        name: "Select2",
        props: [
            "data_form",
	        "value"
        ],
        mounted: function() {
            var vm = this;

            $(this.$el)
            // init select2
                .select2({minimumResultsForSearch: Infinity,})
                .val(this.value)
                .trigger("change")
                // emit event on change.
                .on("change", function(e) {
                    eventBus.$emit("input", this.value, this.name, this);
                });
        },
        destroyed: function() {
            $(this.$el)
                .off()
                .select2("destroy");
        }
    }

</script>

<style scoped>

</style>