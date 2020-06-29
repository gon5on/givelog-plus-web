//Todo 直近だけ初回から開いていたい

const vueMenu = {
    template: `
    <nav class="side-menu" :class="{ 'menu_show': isShowed }" v-cloak>
        <div class="hamburger" :class="{ 'menu_show': isShowed }" @click="menuToggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <ul class="menu-list" :class="{ 'menu_show': isShowed }">
            <li><a href="/design/"><span class="fas fa-gift"></span></a></li>
            <li><a href="kojin.html"><span class="fas fa-address-card"></span></a></li>
            <li><a href="#"><span class="fas fa-address-book"></span></a></li>
            <li><a href="#"><span class="fas fa-calendar-check"></span></a></li>
            <li><a href="#"><span class="fas fa-cog"></span></a></li>
            <li><a href="before_login.html"><span class="fas fa-sign-out-alt"></span></a></li>
        </ul>
    </nav>
    `,
    data() {
        return {
            isShowed: false
        }
    },
    methods: {
        menuToggle: function () {
            this.isShowed = !this.isShowed;
            document.body.classList.toggle("menu_show");
        }
    },
    mounted: function () {
    }
};

new Vue({
    el: '#menuList',
    components: {
        'vue-menu': vueMenu
    }
});