const vueSearch = {
    template: `
    <div class="search-wrap" v-bind:class="{ 'show': isShowed }" >
        <div id="search" class="fas fa-search" v-bind:class="{ 'show': isShowed }" @click="showToggle()"></div>
        <div v-bind:class="{ 'show': isShowed }">
            <slot name="body"></slot>
        </div>
        <a href="#" class="btn btn-filter" v-bind:class="{ 'show': isShowed }" @click="showToggle()">絞り込む</a>
    </div>
    `,
    data() {
        return {
            isShowed: false
        }
    },
    methods: {
        showToggle: function () {
            this.isShowed = !this.isShowed;
        }
    }
};

new Vue({
    el: '#search-area',
    components: {
        'vue-search': vueSearch
    }
});