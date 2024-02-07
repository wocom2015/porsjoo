<template>
    <div style="z-index: 999">
        <div class="text-white" style="float: right" @click="showSubb"
             title="برای مشاهده پروفایل خود کلیک کنید">
            <img src="/site/images/bottom_arrow.png" class="user-icon" style="border: none"/>
            {{this.fullname}}
            <img :src="this.img" class="user-icon"/>


        </div>
        <ul v-if="this.showSub" class="sub-dropdown-menu">
            <li>
                <a href="/profile"
                   title="برای مشاهده پروفایل خود کلیک کنید">
                    <img src="/site/images/user-avatar.png">
                    مشاهده پروفایل
                </a>
            </li>
            <li class="d-xs-none">
                <a href="/profile/edit">
                    <img src="/site/images/user-edit.png">
                    ویرایش پروفایل
                </a>
            </li>
            <li class="d-xs-none">
                <a href="/inquiry/report">
                    <img src="/site/images/report-icon.png">
                    گزارش
                </a>
            </li>
            <li class="d-xs-none">
                <a href="/inquiry/archive">
                    <img src="/site/images/archive.png">
                    آرشیو استعلام ها</a>
            </li>
            <li class="d-xs-none">
                <a href="/user/logout">
                    <img src="/site/images/logout.png">
                    خروج از سامانه</a>
            </li>
        </ul>
    </div>

</template>

<script>
export default {
    name: "subMenuComponent",
    props:['fullname' , 'img'],
    data() {
        return {
            showSub: false,
        }
    },
    methods:{
        showSubb(){

            this.showSub = !this.showSub;
        }
    }
}
</script>

<style scoped>

</style>
