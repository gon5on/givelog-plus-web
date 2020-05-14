const vueSearch = {
    template: `
    <div class="search-wrap" v-bind:class="{ 'show': isShow }" >
    <a id="search" class="fas fa-search" v-bind:class="{ 'show': isShow }" @click="showToggle()"></a>
        <div v-bind:class="{ 'show': isShow }">
            <slot name="body"></slot>
        </div>

    </div>
    `,
    data() {
        return {
            isShow: false
        }
    },
    methods: {
        showToggle: function () {
            this.isShow = !this.isShow;
        }
    }
};