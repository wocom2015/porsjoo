<template>
    <div class="am-sent-table">
        <div class="the-table the-flex">
            <div class="row p-2">
                <!--            <div class="col-lg-3"><h1>استعلام های ارسالی شما : {{ this.count }} مورد</h1></div>-->
                <div class="col-lg-3"><strong><a class="text-success" href="/inquiry/report">گزارش</a></strong></div>

            </div>

            <div class="the-header the-flex" style="background-color: #f0f0f0;padding: 10px">
                <div class="the-flex-item the-flex-item-1">شناسه استعلام</div>
                <div class="the-flex-item the-flex-item-2">نام محصول</div>
                <div class="the-flex-item the-flex-item-3">تاریخ</div>
                <div class="the-flex-item the-flex-item-4">دسته بندی</div>
                <div class="the-flex-item the-flex-item-5">مشخصات</div>
                <div class="the-flex-item the-flex-item-6">پاسخ ها</div>
            </div>
            <div class="the-body the-flex">
                <div v-for="item in this.inquiries" v-if="this.count>0" class="the-row the-flex">
                    <div class="the-flex-item the-flex-item-1">{{ item.id }}</div>
                    <div class="the-flex-item the-flex-item-1-1 col-header">شناسه استعلام</div>
                    <div class="the-flex-item the-flex-item-2"> {{ item.name }}</div>
                    <div class="the-flex-item the-flex-item-2-1 col-header">نام محصول</div>
                    <div class="the-flex-item the-flex-item-3">{{ item.created }}</div>
                    <div class="the-flex-item the-flex-item-3-1 col-header">تاریخ</div>
                    <div class="the-flex-item the-flex-item-4">{{ item.categoryName }}</div>
                    <div class="the-flex-item the-flex-item-4-1 col-header">دسته بندی</div>
                    <div class="the-flex-item the-flex-item-5">
                        <button class="btn-no-bordered mb-1" @click="view(item.id)">
                            <img src="/site/images/view_pj.png" style="width:12px; color:orange"/>
                            مشاهده
                        </button>
                    </div>
                    <div class="the-flex-item the-flex-item-5-1 col-header">مشخصات</div>
                    <div class="the-flex-item the-flex-item-6">
                        <button class="btn-no-bordered mb-1" @click="viewReplies(item.id)">
                            <img src="/site/images/view_pj.png" style="width:12px; color:orange"/>
                            مشاهده
                            ({{ item.repliesCount }})
                        </button>
                    </div>
                    <div class="the-flex-item the-flex-item-6-1 col-header">پاسخ ها</div>
                    <div class="the-flex-break">
                        <hr>
                    </div>
                </div>
            </div>
            <div v-if="this.count===0" class="row mb-2 p-2">
                <p>شما تا کنون استعلامی ارسال ننموده اید</p>
            </div>


            <div v-show="this.viewM" id="viewModal" class="modal fade show" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ this.inquiryName }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div v-if="this.inquiry.picture !=''" class="col-lg-12 text-center"
                                     style="overflow-y: scroll;max-height: 250px;padding: 20px">
                                    <img :src=this.inquiry.pictureSrc style="width: 50%"/>
                                </div>


                                <div class="col-12 col-lg-6"><span>تعداد : </span><strong>{{ this.inquiry.count }}
                                    {{ this.inquiry.unitName }}</strong></div>
                                <div class="col-12 col-lg-6">
                                    <span>دسته بندی : </span><strong>{{ this.inquiry.categoryName }}</strong></div>
                                <div class="col-12 col-lg-6"><span>زمان خرید : </span><strong>{{
                                        this.inquiry.buy_date
                                    }}</strong>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <span>زمان پرداخت : </span><strong>{{ this.inquiry.pay_date }}</strong></div>
                                <div class="col-12 col-lg-6"><span>استان : </span><strong>{{
                                        this.inquiry.provinceName
                                    }}</strong>
                                </div>
                                <div class="col-12 col-lg-6"><span>شهر : </span><strong>{{
                                        this.inquiry.cityName
                                    }}</strong>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <span>میزان قدرت خرید : </span><strong>{{ this.inquiry.price }}</strong></div>
                                <div class="col-12 col-lg-6">
                                    <span>امکان خرید چکی : </span><strong>{{
                                        (this.inquiry.cheque_enable) ? 'بله' : 'خیر'
                                    }}</strong>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <span>درخواست ارسال نمونه : </span><strong>{{
                                        (this.inquiry.sample_enable) ? 'بله' : 'خیر'
                                    }}</strong>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <span>نیاز به ضمانت دارد؟ : </span><strong>{{
                                        (this.inquiry.guarantee_enable) ? 'بله' : 'خیر'
                                    }}</strong>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <span>مسئولیت حمل و نقل با : </span><strong>{{
                                        (this.inquiry.move_conditions == "buyer") ? 'فروشنده' : 'خریدار'
                                    }}</strong>
                                </div>
                                <div class="col-lg-12">
                                    <span>توضیحات : </span><strong>{{ this.inquiry.description }}</strong></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom-outline" type="button" @click="this.hideView()">متوجه شدم
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div v-show="this.viewR" id="viewModal" class="modal fade show" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">
                                پاسخ ها به استعلام
                                <small class="text-danger">{{ this.inquiryName }}</small>
                            </h6>
                        </div>
                        <div class="modal-body">

                            <div v-show='this.replies.length==0' class="alert alert-info">
                                <p>کاربر گرامی ، در حال حاضر هیچ پاسخی برای این استعلام از طرف تامین کنندگان داده نشده
                                    است.</p>
                            </div>

                            <div v-show="this.replies.length>0" class="row"
                                 style="max-height: 400px; overflow-y: scroll">
                                <div v-show='this.replies.length>0' class="alert alert-warning">
                                    <strong>توجه:</strong>
                                    <p class="text-danger">کاربر گرامی ، دقت داشته باشید که با هر انتخاب تامین کننده و
                                        مشاهده
                                        اطلاعات تامین کننده ، یکی از
                                        فرصت های استعلام شما کم می شود</p>
                                </div>
                                <div v-for="item in this.replies" class="col-lg-12">
                                    <div class="inquiry-box text-center">
                                        <p><strong>قیمت : {{ item.price }}</strong></p>
                                        <p><small>{{ item.description }}</small></p>
                                        <p><small class="ml-10">امکان پرداخت چکی : {{ item.cheque_enable }}</small> |
                                            <small class="ml-10"> امکان ارسال نمونه : {{ item.sample_enable }}</small> |
                                            <small class="ml-10"> دارای گارانتی : {{ item.guarantee_enable }}</small> |
                                            <small class="ml-10">امکان بازدید از محل محصول : {{
                                                    item.visit_place_enable
                                                }}</small></p>

                                        <a class="btn default-btn mb-1" href="javascript:void(0)"
                                           title="با کلیک بر روی این دکمه از تعداد استعلام های شما یکی کم می شود"
                                           @click="viewSupplier(item.user_id)">
                                            مشاهده اطلاعات تامین کننده
                                        </a>
                                        <a :href="item.url" class="btn default-btn mb-1">
                                            مشاهده پروفایل تامین کننده
                                        </a>
                                        <!--                                    <a href="javascript:void(0)" v-if="item.hasSeen==1" class="btn default-btn mb-1"-->
                                        <!--                                            @click="commentSupplier(item.user_id , item.inquiry_id)"-->
                                        <!--                                            title="با کلیک بر روی این دکمه می توانید به تامین کننده پاسخ دهید">-->
                                        <!--                                        پاسخ به تامین کننده-->
                                        <!--                                    </a>-->
                                        <a class="btn default-btn mb-1" href="javascript:void(0)"
                                           title="با کلیک بر روی این دکمه می توانید با تامین کننده چت کنید"
                                           @click="chatBox(item.user_id)">
                                            گفتگو با تامین کننده
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom-outline" style="margin: 0 auto" type="button"
                                    @click="this.hideViewR()">
                                <img src="/site/images/check.png"> متوجه شدم
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="this.viewChat" id="viewModal" class="modal fade show" role="dialog" tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">
                                گفتگو با تامین کننده
                                <small class="text-danger">{{ this.inquiryName }}</small>
                            </h6>
                        </div>
                        <div class="modal-body">
                            <div class="chat-box">
                                <div class="chat-header">
                                    <span>{{ this.chatUser }}</span>
                                </div>
                                <div v-for="item in this.chats" :class="item.class">
                                    <div class="content">
                                        <p>
                                            {{ item.message }}
                                        </p>
                                        <span style="float: right">{{ item.created_at }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-footer">
                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                                     xmlns="http://www.w3.org/2000/svg" @click="sendMsg()">
                                    <path clip-rule="evenodd"
                                          d="M5.9482 3.23906C5.3284 2.90532 4.57878 2.92199 3.97443 3.28297C3.37008 3.64394 3 4.29605 3 5V19C3 19.7039 3.37008 20.3561 3.97443 20.717C4.57878 21.078 5.3284 21.0947 5.9482 20.7609L18.9482 13.7609C19.596 13.4121 20 12.7358 20 12C20 11.2642 19.596 10.5879 18.9482 10.2391L5.9482 3.23906ZM5 19V14L12 12L5 10V5L18 12L5 19Z"
                                          fill="#D64012"
                                          fill-rule="evenodd"/>
                                </svg>
                                <div class="chat-message">
                                    <input ref="msg" class="form-control" placeholder="نوشتن پیام..." type="text">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom-outline" style="margin: 0 auto" type="button"
                                    @click="this.viewChat = 0">
                                بستن مکالمه
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show="this.viewS" id="viewModal" class="modal fade show" role="dialog" tabindex="-1">
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
                                <div class="col-lg-6"><span>نام تامین کننده : </span><strong>{{
                                        this.supplier.name
                                    }}</strong></div>
                                <div class="col-lg-6"><span>شماره تماس : </span><strong>{{
                                        this.supplier.mobile
                                    }}</strong>
                                </div>
                                <div class="col-lg-6"><span>آدرس : </span><strong>{{ this.supplier.address }}</strong>
                                </div>
                                <div class="col-lg-6"><span>نام کسب و کار : </span><strong>{{
                                        this.supplier.job_name
                                    }}</strong></div>

                            </div>

                            <div v-show="this.supplierState=='error'" class="row">
                                <div class="alert alert-danger">
                                    {{ this.supplierMessage }}
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom-outline" type="button" @click="this.hideViewS()">متوجه شدم
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div v-show="this.viewC" id="viewModal" class="modal fade show" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">
                                پاسخ به تامین کننده
                                <small class="text-danger">{{ this.inquiryName }}</small>
                            </h6>
                        </div>
                        <div class="modal-body">
                            <div v-show="(this.errors !=='') " class="content-frame">
                                <p>لطفا خطاهای زیر را برطرف نمایید:</p>
                                <ul>
                                    <li v-for="item in this.errors" class="mb-0 text-danger"><i
                                        class="bi bi-exclamation-triangle"></i> <small>{{ item }}</small></li>
                                </ul>
                            </div>
                            <form id="frmComment" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>نظر شما:</label>
                                        <textarea class="form-control bg-gray" name="comment"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mt-2">
                                        <button class="btn btn-custom-outline" type="button" @click="this.saveC()">ذخیره
                                        </button>
                                    </div>

                                    <div class="col-lg-12 mt-2 text-info">{{ this.message }}</div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-custom-outline" type="button" @click="this.hideViewC()">متوجه شدم
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "inquirySentComponent",
    props: ['inquiries', 'count', 'type'],
    data() {
        return {
            viewC: false,
            viewChat: false,
            viewM: false,
            viewR: false,
            inquiryName: '',
            inquiry_id: 0,
            inquiry: [],
            replies: [],
            errors: '',
            viewS: false,
            supplier: [],
            supplier_id: 0,
            supplierState: '',
            supplierMessage: '',
            message: '',
            chats: [],
            chatUser: ''
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
        saveC() {
            var self = this;
            var fData = new FormData(document.getElementById("frmComment"));
            fData.append("inquiry_id", self.inquiry_id);
            fData.append("supplier_id", self.supplier_id);
            this.errors = '';
            this.message = '';
            axios(
                {
                    method: "post",
                    url: "/inquiry/comment",
                    data: fData,
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success') {
                        self.message = response.data.message;
                    } else {
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
                    data: {id: self.supplier_id, inquiry_id: self.inquiry.id},
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success') {
                        self.supplier = response.data.info;
                        self.supplierState = 'success';
                    } else {
                        self.supplierState = 'error';
                        self.supplierMessage = response.data.message
                    }
                })
        },
        commentSupplier(supplier_id, inquiry_id) {
            this.viewC = true;
            this.inquiry_id = inquiry_id,
                this.supplier_id = supplier_id
        },
        chatBox(supplier_id) {
            this.viewChat = true;
            var self = this;
            self.supplier_id = supplier_id;
            axios(
                {
                    method: "post",
                    url: "/messages",
                    data: {user_id: self.supplier_id},
                }
            )
                .then(function (response) {
                    self.chats = response.data.messages;
                    self.chatUser = response.data.supplier;
                });
        },
        sendMsg() {
            let message = this.$refs.msg.value;
            var self = this;
            if (message.length > 0) {
                axios(
                    {
                        method: "post",
                        url: "/messages/send",
                        data: {user_id: self.supplier_id, message: message},
                    }
                )
                    .then(function (response) {
                        self.chatBox(self.supplier_id);
                        self.$refs.msg.value = "";
                    });
            }
        }

    }
}
</script>

