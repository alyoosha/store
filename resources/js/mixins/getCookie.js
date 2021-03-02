export default {
    methods: {
        getCookie() {
            let user;
            let arr = document.cookie.split(';').forEach(e => {
                if(e.includes('4drv-store-user')) {
                    user = JSON.parse(decodeURIComponent(e.split('=')[1]));
                }
            });
            if(user) return user;

            this.user;
        }
    }
}