import numeral from 'numeral'

Vue.component('subscribe-button', {

    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        },
        initialSubscriptions: {
           type: Array,
           required: true,
           default: () => []
       }
    },

    data: function () {
        return {
            subscriptions: this.initialSubscriptions

        }
    },

    computed:{
        subscribed() {

            if(!__auth() || this.channel.user_id === __auth().id) return false
            return !!this.subscription
        },

        owner() {
            if (__auth() && this.channel.user_id === __auth().id) return true
            return false
        },

        subscription(){
            if (!__auth()) return null
            return this.subscriptions.find(subscription => subscription.user_id === __auth().id)

        },

        count(){
            return numeral(this.subscriptions.length).format('0a')
        }
    },
    methods: {

        toggleSubscription() {
            if (! __auth()) {
                return alert('Por favor faça o login para se inscrever.')
            }
            if (this.owner){
                return alert('Você não pode se inscrever no seu Canal.')
            }
            if (this.subscribed){
                axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                    .then(() => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })
            } else {
                axios.post(`/channels/${this.channel.id}/subscriptions`)
                    .then(response => {
                        this.subscriptions = [
                            ...this.subscriptions,
                            response.data
                        ]
                    })

            }
        }

    }

});
