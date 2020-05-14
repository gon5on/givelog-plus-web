const vueAccordion = {
    template: `
    <dl v-cloak>
        <dt v-bind:class="{ 'open': isOpened }" @click="accordionToggle()">
            {{this.date}}
        </dt>
        <dd class="vue-accordion-target" v-bind:class="{ 'open': isOpened }">
            <slot name="body"></slot>
        </dd>
    </dl>
    `,
    data() {
        return {
            isOpened: false
        }
    },
    props: {
        date: {
            required: true
        }
    },
    methods: {
        accordionToggle: function () {
            this.isOpened = !this.isOpened;
        }
    }
};