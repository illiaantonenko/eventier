<template>
    <FullCalendar
        :config="this.config"
        :events="JSON.parse(this.events)"
        :header="header"
        :nav-links="true"
        :plugins="calendarPlugins"
        :locale="locale"
    ></FullCalendar>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import rrulePlugin from "@fullcalendar/rrule";
    import ukLocale from '@fullcalendar/core/locales/uk';
    import enLocale from '@fullcalendar/core/locales/en-gb';

    export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        props: ['events', 'lang'],
        data() {
            return {
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // language: '',
                locale: this.lang === 'en' ? enLocale : ukLocale,
                calendarPlugins: [dayGridPlugin, rrulePlugin, timeGridPlugin],
                config: {
                    defaultView: 'month',
                    firstDay: 1,
                    editable: true,
                    navLinks: true,
                }
            }
        },
    }
</script>

<style scoped>

</style>
