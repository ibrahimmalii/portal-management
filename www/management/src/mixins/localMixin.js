export default {
    computed: {
        isRTL() {
            return document.documentElement.lang === 'ar'
        },
        locale() {
            console.log('done');
            return document.documentElement.lang
        },
    },
}
