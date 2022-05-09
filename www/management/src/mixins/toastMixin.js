export default {
    data() {
        return {
            toastAnimation: {
                show: {effect: "FadeZoomIn"},
                hide: {effect: "FadeZoomOut"}
            }
        }
    },
    computed: {
        toastPosition() {
            return {X: this.isRTL ? 'Left' : 'Right', Y: 'Bottom'}
        }
    },
    methods: {
        beforeSuccessToastOpen: function (event) {
            const progress = event.element.querySelector('.e-toast-progress')
            progress.style.backgroundColor = "#4D841D"
        },
        beforeErrorToastOpen: function (event) {
            const progress = event.element.querySelector('.e-toast-progress')
            progress.style.backgroundColor = "#9F0E0E"
        }
    }
}
