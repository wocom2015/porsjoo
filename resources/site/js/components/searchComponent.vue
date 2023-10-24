<template>
    <div>

        <div class="row align-content-center">
            <div class="search-box col-lg-12 mt-10">
                <form class="search-form">
                    <input class="search-input" ref="search" @click="showSearch()" @keyup="showResult()" placeholder="دسته بندی مورد نظر خود را جستجو کنید." name="search" type="text" id="search">

                    <div class="search-result" v-show="this.result && phrase.length >=3">
                        <div class="d-flex bd-highlight" v-show="searchResult.length>0" v-for="item in searchResult">
                            <div class="p-1 flex-fill bd-highlight mt-2 s-t" @click="this.searchCat(item.id)">{{item.name}}</div>
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

        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>آخرین استعلام های ثبت شده</h1></div>
            </div>
            <div class="row p-2">
                <div class="col-lg-3 col-sm-6"><strong>استان</strong></div>
                <div class="col-lg-3 col-sm-6"><strong>نام محصول</strong></div>
                <div class="col-lg-2 col-sm-6"><strong>دسته</strong></div>
                <div class="col-lg-2 col-sm-6"><strong>زمان پایان استعلام</strong></div>
                <div class="col-lg-2 col-sm-6"><strong>تعداد افراد داخل استعلام</strong></div>
            </div>

            <a v-for="item in this.inquiries" :href="item.url">
                <div class="row mb-2 p-2">
                    <div class="col-lg-3 col-sm-6">{{item.provinceName}}</div>
                    <div class="col-lg-3 col-sm-6">{{item.name}}</div>
                    <div class="col-lg-2 col-sm-6">{{item.categoryName}}</div>
                    <div class="col-lg-2 col-sm-6">{{item.closeDate}}</div>
                    <div class="col-lg-2 col-sm-6">{{item.user_count}}</div>
                </div>
            </a>

            <div class="row">
                <div class="search-result" v-show=" inquiries.length===0">
                    هیچ نتیجه ای برای جستجوی شما یافت نشد
                </div>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "searchComponent.vue",
    props:['lastpj'],
    data() {
        return {
            inquiries : [],
            result : false,
            phrase : '',
            searchResult: [],
            searchLimit: 5,
            offset: 0,
            showMore : false,
            catId: 0,
        }
    },
    methods:{
        showSearch(){
            this.result = true;
        },
        searchCat(catId){
            var self = this;
            self.catId = catId;
            axios(
                {
                    method: "post",
                    url: "/search/inquiry",
                    data: {catId:self.catId , o:self.offset}
                }
            )
                .then(function(response){
                    self.inquiries = response.data.data;
                    self.result = false;
                });

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
                        if(response.data.categories.length>0 && self.$refs.search.value.length>2){

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
    mounted() {
        this.inquiries = this.lastpj;
    }

}
</script>

