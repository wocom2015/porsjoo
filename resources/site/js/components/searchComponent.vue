<template>
    <div class="row align-content-center">
        <div class="search-box col-lg-12 mt-10">
            <form class="search-form">
                <input class="search-input" ref="search" @click="showSearch()" @keyup="showResult()" placeholder="دسته بندی مورد نظر خود را جستجو کنید." name="search" type="text" id="search">

                <div class="search-result" v-show="this.result && phrase.length >=3">
                    <div class="d-flex bd-highlight" v-show="searchResult.length>0" v-for="item in searchResult">
                        <div class="p-1 flex-fill bd-highlight mt-2 s-t"><a :href="item.url" >{{item.name}}</a></div>
                    </div>
                    <div class="text-center" v-show="this.showMore" @click="showMoreResult()">
                        مشاهده بیشتر...
                    </div>
                </div>

                <div class="search-result" v-show="this.result  && phrase.length >=3 && searchResult.length===0">
                    هیچ نتیجه ای برای جستجوی شما یافت نشد
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "searchComponent.vue",
    data() {
        return {
            result : false,
            phrase : '',
            searchResult: [],
            searchLimit: 5,
            offset: 0,
            showMore : false
        }
    },
    methods:{
        showSearch(){
            this.result = true;
        },
        showResult(){
            if(this.$refs.search.value.length>2){
                this.phrase = this.$refs.search.value;
                var self = this;
                axios(
                    {
                        method: "post",
                        url: "/search",
                        data: {p:self.phrase , l:self.searchLimit , o:self.offset}
                    }
                )
                    .then(function(response){
                        self.result = true;
                        console.log(response.data);
                        if(response.data.categories.length>0 && self.$refs.search.value.length>2){
                            console.log("salam");
                            self.searchResult = response.data.categories;

                            self.showMore = response.data.hasMore;
                        }
                        else{
                            self.searchResult = [];
                        }
                    });
            }else{
                this.searchResult = [];
                this.result = false;
                this.offset = 0;
                this.searchLimit = 5;
                this.phrase = '';
            }

        },
        showMoreResult(){
            this.searchLimit += this.searchLimit;
            this.showResult();
        }
    },

}
</script>

