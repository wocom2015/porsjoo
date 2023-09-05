<template>
    <div>
        <div class="text-white" style="float: right" @click="showSubb"
             title="برای مشاهده پروفایل خود کلیک کنید">
            {{this.fullname}}
            <img :src="this.img" class="user-icon"/>
        </div>
        <ul v-if="this.showSub" class="sub-dropdown-menu">
            <li>
                <a href="/profile"
                   title="برای مشاهده پروفایل خود کلیک کنید">مشاهده پروفایل</a>
            </li>
            <li class="d-xs-none">
                <a href="/profile/edit" target="_blank">
                    ویرایش پروفایل</a>
            </li>
            <li class="d-xs-none">
                <a href="/user/logout">خروج از سامانه</a>
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
