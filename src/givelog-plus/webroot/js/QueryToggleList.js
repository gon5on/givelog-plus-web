//Todo 直近だけ初回から開いていたい

const vueAccordion = {
    template: `
    <dl v-cloak>
        <dt v-bind:class="{ 'show': isShowed }" @click="accordionToggle">
            {{this.date}}
        </dt>
        <transition name="js-accordion" @before-enter="beforeEnter" @enter="enter" @before-leave="beforeLeave" @leave="leave">
            <dd class="vue-accordion-target" :class="{ 'show': isShowed }" v-show="isShowed">
                <slot name="body"></slot>
            </dd>
        </transition>
    </dl>
    `,
    data() {
        return {
            isShowed: true
        }
    },
    props: {
        date: {
            required: true
        }
    },
    methods: {
        accordionToggle: function () {
            this.isShowed = !this.isShowed;
        },
        beforeEnter: function(el) {
        el.style.height = '0';
        },
        enter: function(el) {
        el.style.height = (el.scrollHeight+30) + 'px';
        },
        beforeLeave: function(el) {
        el.style.height = (el.scrollHeight+30) + 'px';
        },
        leave: function(el) {
        el.style.height = '0';
        }
    },
    mounted: function () {
    }
};

new Vue({
    el: '#toggleList',
    components: {
        'vue-accordion': vueAccordion
    }
});