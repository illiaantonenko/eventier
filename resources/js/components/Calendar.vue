<template>
    <full-calendar :config="this.config" :events="JSON.parse(this.events)"></full-calendar>
</template>

<script>
    export default {
        props: ['events', 'lang'],
        data() {
            return {
                // language: '',
                config: {
                    defaultView: 'month',
                    firstDay: 1,
                    editable: false,
                    locale: this.lang === 'en' ? 'en' : 'uk'
                }
            }
        },
        // mounted() {
        //     if (this.lang === 'en'){
        //         this.language = 'en'
        //     }else{
        //         this.language = 'uk'
        //     }
        //     this.config.locale = this.language;
        // }
    }
</script>

<style scoped>

</style>
