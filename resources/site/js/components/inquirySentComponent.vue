<template>
    <div>
        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-3"><h1>استعلام های ارسالی شما : {{ this.count }} مورد</h1></div>
                <div class="col-lg-3"><span>سه ماه گذشته : </span> <span>{{this.last_3}}</span></div>
                <div class="col-lg-3"><span>شش ماه گذشته : </span> <span>{{this.last_6}}</span></div>
                <div class="col-lg-3"><span>یک سال گذشته : </span> <span>{{this.last_12}}</span></div>
            </div>


            <div v-if="this.count>0" class="row mb-2 p-2" v-for="item in this.inquiries">
                <div class="col-lg-1">شناسه استعلام : {{ item.id }}</div>
                <div class="col-lg-3">
                    <img v-if="item.pictureSrc !=null" :src=item.pictureSrc class="thumb_img"/>
                    <strong>{{ item.name }}</strong><br>{{ item.description }}</div>
                <div class="col-lg-2">{{ item.created }}</div>
                <div class="col-lg-2">دسته بندی : {{ item.categoryName }}</div>
                <div class="col-lg-2">
                    <button class="btn btn-custom-outline mb-1" @click="view(item.id)">مشاهده مشخصات</button>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-custom-outline mb-1" @click="viewReplies(item.id)">پاسخ ها
                        ({{ item.repliesCount }})
                    </button>
                </div>
            </div>
            <div v-if="this.count===0" class="row mb-2 p-2">
                <p>شما تا کنون استعلامی ارسال ننموده اید</p>
            </div>

        </div>

        <div v-show="this.viewM" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ this.inquiryName }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-12 text-center" v-if="this.inquiry.picture !=''" style="overflow-y: scroll;max-height: 250px;padding: 20px">
                                <img :src=this.inquiry.pictureSrc style="width: 50%"/>
                            </div>


                            <div class="col-lg-6"><span>تعداد : </span><strong>{{ this.inquiry.count }}
                                {{ this.inquiry.unitName }}</strong></div>
                            <div class="col-lg-6">
                                <span>دسته بندی : </span><strong>{{ this.inquiry.categoryName }}</strong></div>
                            <div class="col-lg-6"><span>زمان خرید : </span><strong>{{ this.inquiry.buy_date }}</strong>
                            </div>
                            <div class="col-lg-6">
                                <span>زمان پرداخت : </span><strong>{{ this.inquiry.pay_date }}</strong></div>
                            <div class="col-lg-6"><span>استان : </span><strong>{{ this.inquiry.provinceName }}</strong>
                            </div>
                            <div class="col-lg-6"><span>شهر : </span><strong>{{ this.inquiry.cityName }}</strong></div>
                            <div class="col-lg-6">
                                <span>میزان قدرت خرید : </span><strong>{{ this.inquiry.price }}</strong></div>
                            <div class="col-lg-6">
                                <span>امکان خرید چکی : </span><strong>{{
                                    (this.inquiry.cheque_eneable) ? 'بله' : 'خیر'
                                }}</strong>
                            </div>
                            <div class="col-lg-6">
                                <span>درخواست ارسال نمونه : </span><strong>{{
                                    (this.inquiry.sample_enable) ? 'بله' : 'خیر'
                                }}</strong>
                            </div>
                            <div class="col-lg-6">
                                <span>نیاز به ضمانت دارد؟ : </span><strong>{{
                                    (this.inquiry.guarantee_enable) ? 'بله' : 'خیر'
                                }}</strong>
                            </div>
                            <div class="col-lg-12">
                                <span>توضیحات : </span><strong>{{ this.inquiry.description }}</strong></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideView()">متوجه شدم</button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="this.viewR" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">
                            پاسخ ها به استعلام
                            <small class="text-danger">{{ this.inquiryName }}</small>
                        </h6>
                    </div>
                    <div class="modal-body">
                        <div v-show='this.replies.length>0' class="alert alert-warning">
                            <strong>توجه:</strong>
                            <p class="text-danger">کاربر گرامی ، دقت داشته باشید که با هر انتخاب تامین کننده و مشاهده
                                مشخصات آن ، یکی از
                                فرصت های استعلام شما کم می شود</p>
                        </div>
                        <div v-show='this.replies.length==0' class="alert alert-info">
                            <p>کاربر گرامی ، در حال حاضر هیچ پاسخی برای این استعلام از طرف تامین کنندگان داده نشده
                                است.</p>
                        </div>

                        <div class="row" v-show="this.replies.length>0">
                            <div class="col-lg-6" v-for="item in this.replies">
                                <div class="inquiry-box">
                                    <strong>قیمت : {{ item.price }}</strong>
                                    <p><small>{{ item.description }}</small></p>
                                    <p><small class="ml-10">امکان پرداخت چکی : {{ item.cheque_enable }}</small> |
                                    <small class="ml-10"> امکان ارسال نمونه : {{ item.sample_enable }}</small> |
                                    <small class="ml-10"> دارای گارانتی : {{ item.guarantee_enable }}</small> |
                                    <small class="ml-10">امکان بازدید از محل محصول : {{ item.visit_place_enable }}</small></p>

                                    <button class="btn default-btn" @click="viewSupplier(item.user_id)" title="با کلیک بر روی این دکمه از تعداد استعلام های شما یکی کم می شود">
                                        مشاهده اطلاعات تامین کننده
                                        <i class="bi bi-file-lock2"></i>
                                    </button>

                                    <button v-if="item.hasSeen==1" class="btn default-btn" style="margin-right: 10px" @click="commentSupplier(item.user_id , item.inquiry_id)" title="با کلیک بر روی این دکمه می توانید به تامین کننده پاسخ دهید">
                                        پاسخ به تامین کننده
                                        <i class="bi bi-file-lock2"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideViewR()">متوجه شدم
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="this.viewS" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">
                            مشاهده اطلاعات تامین کننده
                            <small class="text-danger">{{ this.inquiryName }}</small>
                        </h6>
                    </div>
                    <div class="modal-body">
                        <div v-show="this.supplierState=='success'" class="row">
                            <div class="col-lg-6"><span>نام تامین کننده : </span><strong>{{ this.supplier.name }}</strong></div>
                            <div class="col-lg-6"><span>شماره تماس : </span><strong>{{ this.supplier.mobile }}</strong></div>
                            <div class="col-lg-6"><span>آدرس : </span><strong>{{ this.supplier.address }}</strong></div>
                            <div class="col-lg-6"><span>نام کسب و کار : </span><strong>{{this.supplier.job_name }}</strong></div>
                        </div>

                        <div v-show="this.supplierState=='error'" class="row">
                            <div class="alert alert-danger">
                                {{this.supplierMessage}}
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideViewS()">متوجه شدم
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="this.viewC" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">
                            پاسخ به تامین کننده
                            <small class="text-danger">{{ this.inquiryName }}</small>
                        </h6>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmComment">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>نظر شما:</label>
                                    <textarea name="comment" class="form-control bg-gray"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mt-2">
                                    <button type="button" class="btn btn-custom-outline" @click="this.saveC()">ذخیره</button>
                                </div>

                                <div class="col-lg-12 mt-2 text-info">{{this.message}}</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideViewC()">متوجه شدم</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "inquirySentComponent",
    props: ['inquiries', 'count','last_3' , 'last_6' , 'last_12'],
    data() {
        return {
            viewC: false,
            viewM: false,
            viewR: false,
            inquiryName: '',
            inquiry_id: 0,
            inquiry: [],
            replies: [],
            viewS: false,
            supplier: [],
            supplier_id: 0,
            supplierState : '',
            supplierMessage : '',
            message :''
        }
    },
    methods: {
        view(id) {
            this.viewM = true;
            this.getInfo(id);

        },
        getInfo(id) {
            var self = this;
            self.id = id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/item",
                    data: {id: self.id},
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success') {
                        self.inquiry = response.data.inquiry;
                        self.inquiryName = response.data.inquiry.name;
                    }
                })
        },
        hideView() {
            this.viewM = false;
        },
        hideViewC() {
            this.viewC = false;
        },
        hideViewR() {
            this.viewR = false;
        },
        hideViewS() {
            this.viewS = false;
        },
        saveC(){
            var self = this;
            var fData = new FormData(document.getElementById("frmComment"));
            fData.append("inquiry_id" , self.inquiry_id);
            fData.append("supplier_id" , self.supplier_id);
            this.errors = '';
            this.message ='';
            axios(
                {
                    method: "post",
                    url: "/inquiry/comment",
                    data: fData,
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success'){
                        self.message = response.data.message;
                    }else{
                        self.errors = response.data.message;
                    }
                })
        },
        viewReplies(id) {
            this.getInfo(id);
            this.viewR = true;
            var self = this;
            self.id = id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/replies",
                    data: {id: self.id},
                }
            )
                .then(function (response) {
                    self.replies = response.data;
                })
        },
        viewSupplier(supplier_id) {
            this.viewS = true;
            var self = this;
            self.supplier_id = supplier_id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/supplier",
                    data: {id: self.supplier_id , inquiry_id : self.inquiry.id},
                }
            )
                .then(function (response) {
                    if(response.data.state ==='success'){
                        self.supplier = response.data.info;
                        self.supplierState = 'success';
                    }
                    else {
                        self.supplierState = 'error';
                        self.supplierMessage = response.data.message
                    }
                })
        },
        commentSupplier(supplier_id , inquiry_id){
            this.viewC = true;
            this.inquiry_id = inquiry_id,
            this.supplier_id = supplier_id
        }

    }
}
</script>

