export let getters = {
    get_user: state => {
        return state.user;
    },
    get_count: state => {
        return state.user.count;
    },
    get_products: state => {
        return state.user.products;
    }
};
