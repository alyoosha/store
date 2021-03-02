export default {
    methods: {
        replaceEnding(str, end, ending) {
            if (!str) return str;
            return str.slice(0, end) + ending;
        }
    }
}