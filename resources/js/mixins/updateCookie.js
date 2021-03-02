import {Cookies} from '../app.js'

export default {
    methods: {
        updateCookie(data) {
            Cookies.remove(this.$root.nameCookie, {path: "/"});

            if(data) {
                Cookies.set(this.$root.nameCookie, JSON.stringify(data), {path: "/"});
            }
        }
    }
}