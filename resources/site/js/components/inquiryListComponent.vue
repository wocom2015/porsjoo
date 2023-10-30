<template>
    <div>
        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>استعلام های متناسب با حرفه شما : {{this.count}} مورد</h1></div>
            </div>
            <div class="row" style="background-color: #f0f0f0;padding: 10px">
                <div class="col">استان</div>
                <div class="col">محصول</div>
                <div class="col">تاریخ</div>
                <div class="col">مشاهده مشخصات</div>
                <div class="col">پاسخ شما</div>
                <div class="col">پاسخ مشتری</div>
                <div class="col">گفتگو</div>
            </div>
            <div v-if="this.count>0" class="row mb-2 p-2" v-for="item in this.inquiries">
                <div class="col">{{item.provinceName}}</div>
                <div class="col">
                    <strong>{{item.name}}</strong></div>
                <div class="col">{{item.created}}</div>
                <div class="col"><button @click="view(item.id)" class="btn-no-bordered mb-1"><img style="width:12px; color:orange" src="/site/images/view_pj.png"/>مشاهده</button></div>
                <div class="col" v-show="item.reply_by_user==0" ><button @click="this.replyIt(item.id)" class="btn-no-bordered mb-1"><img style="width:12px; color:orange" src="/site/images/view_pj.png"/>
                    مشاهده</button> </div>
                <div v-show="item.reply_by_user==1" class="col"><button @click="this.replyReview(item.id)" class="btn-no-bordered mb-1"><img style="width:12px; color:orange" src="/site/images/view_pj.png"/>
                    مشاهده</button> </div>
                <div class="col"><button @click="this.commentReview(item.id)" class="btn-no-bordered mb-1"><img style="width:12px; color:orange" src="/site/images/view_pj.png"/>
                    مشاهده</button> </div>
                <div class="col"><button @click="this.chatBox(item.user_id)" class="btn-no-bordered mb-1"><img style="width:12px; color:orange" src="/site/images/view_pj.png"/>
                    مشاهده</button> </div>

            </div>

            <div v-if="this.count===0" class="row mb-2 p-2">
                <p>در حال حاضر ، استعلامی متناسب با دسته بندی شما وجود ندارد</p>
            </div>
        </div>

        <div v-show="this.replyM" class="modal fade show" tabindex="-1" role="dialog" id="replyModal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">پاسخ به استعلام
                            <small class="text-warning">{{this.inquiryName}}</small>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">توجه : کاربر گرامی با پاسخ به هر استعلام از تعداد امکان استعلام شما یکی کم می شود.</div>
                        <form id="frmReply">
                            <div class="row mb-2">
                                <div class="col-lg-3 col-sm-12 col-xs-12">
                                    <label>قیمت پیشنهادی شما (تومان)</label>
                                    <input type="text" name="price" class="form-control text-black text-left bg-gray">
                                </div>
                                <div class="col-lg-9 col-sm-12 col-xs-12">
                                    <label>توضیحات شما</label>
                                    <input type="text" name="description" class="form-control text-black bg-gray">
                                </div>

                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <label class="mt-2">امکان فروش به صورت چکی را دارید؟</label>
                                </div>
                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cheque_enable" value="1">
                                        <label class="form-check-label">بله</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cheque_enable" value="0" checked>
                                        <label class="form-check-label">خیر</label>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <label class="mt-2">امکان ارسال نمونه دارید؟</label>
                                </div>
                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sample_enable" value="1">
                                        <label class="form-check-label">بله</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sample_enable" value="0" checked>
                                        <label class="form-check-label">خیر</label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <label class="mt-2">امکان ضمانت از طرف شما وجود دارد؟</label>
                                </div>
                                <div class="col-lg-3 col-sm-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="guarantee_enable" value="1">
                                        <label class="form-check-label">بله</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="guarantee_enable" value="0" checked>
                                        <label class="form-check-label">خیر</label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <label class="mt-2">امکان بازدید از مکان خرید وجود دارد؟</label>
                                </div>
                                <div class="col-lg-3 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visit_place_enable" value="1">
                                        <label class="form-check-label">بله</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visit_place_enable" value="0" checked>
                                        <label class="form-check-label">خیر</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12" v-show="replyMessage!==''" :class="replyState">
                                <p v-if="replyState==='alert alert-danger'" v-for="item in replyMessage">{{item}}</p>
                                <p v-if="replyState==='alert alert-success'">{{replyMessage}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default-btn"  @click="this.sendReply(this.id)">ارسال پاسخ</button>
                        <button type="button" class="btn close-btn" @click="this.hideReply()">بستن</button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="this.viewM" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{this.inquiryName}}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 text-center" v-if="this.inquiry.picture !=''">
                                <img :src=this.inquiry.pictureSrc style="max-width:100%;max-height: 200px;margin-bottom:30px" />
                            </div>
                            <div class="col-lg-6"><span>تعداد : </span><strong>{{this.inquiry.count}} {{this.inquiry.unitName}}</strong></div>
                            <div class="col-lg-6"><span>دسته بندی : </span><strong>{{this.inquiry.categoryName}}</strong></div>
                            <div class="col-lg-6"><span>زمان خرید : </span><strong>{{this.inquiry.buy_date}}</strong></div>
                            <div class="col-lg-6"><span>زمان پرداخت : </span><strong>{{this.inquiry.pay_date}}</strong></div>
                            <div class="col-lg-6"><span>استان : </span><strong>{{this.inquiry.provinceName}}</strong></div>
                            <div class="col-lg-6"><span>شهر : </span><strong>{{this.inquiry.cityName}}</strong></div>
                            <div class="col-lg-6"><span>میزان قدرت خرید : </span><strong>{{this.inquiry.price}}</strong></div>
                            <div class="col-lg-6"><span>امکان خرید چکی : </span><strong>{{(this.inquiry.cheque_enable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-6"><span>تعداد چک : </span><strong>{{this.inquiry.cheque_count}}</strong></div>
                            <div class="col-lg-6"><span>درصد نقد : </span><strong>{{this.inquiry.cash_percent}}</strong></div>
                            <div class="col-lg-6"><span>درخواست ارسال نمونه : </span><strong>{{(this.inquiry.sample_enable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-6"><span>نیاز به ضمانت دارد؟ : </span><strong>{{(this.inquiry.guarantee_enable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-6"><span>مسئولیت حمل و نقل با : </span><strong>{{(this.inquiry.move_conditions=="buyer")?'فروشنده':'خریدار'}}</strong></div>
                            <div class="col-lg-12"><span>توضیحات : </span><strong>{{this.inquiry.description}}</strong></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideView()">متوجه شدم</button>
                    </div>
                </div>
            </div>
        </div>


        <div v-show="this.replyReviewM" class="modal fade show" tabindex="-1" role="dialog" id="replyModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">پاسخ شما به استعلام
                        <small class="text-success">{{this.inquiryName}}</small>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6"><span>قیمت شما : </span><strong>{{this.reply.price}}</strong></div>
                            <div class="col-lg-6"><span>توضیحات شما : </span><strong>{{this.reply.description}}</strong></div>
                            <div class="col-lg-6"><span>زمان پاسخ : </span><strong>{{this.reply.created}}</strong></div>
                            <div class="col-lg-6"><span>وضعیت : </span><strong></strong></div> <!--TODO : must be assign-->
                            <p><small class="ml-10">امکان پرداخت چکی : {{ this.reply.cheque_enable }}</small> |
                                <small class="ml-10"> امکان ارسال نمونه : {{ this.reply.sample_enable }}</small> |
                                <small class="ml-10"> دارای گارانتی : {{ this.reply.guarantee_enable }}</small> |
                                <small class="ml-10">امکان بازدید از محل محصول : {{ this.reply.visit_place_enable }}</small></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideReplyR()">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="this.commentReviewM" class="modal fade show" tabindex="-1" role="dialog" id="commentModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">پاسخ مشتری به استعلام
                            <small class="text-success">{{this.inquiryName}}</small>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"><strong>{{this.comment}}</strong></div>
                            <div class="col-lg-12"><strong>{{this.comment_time}}</strong></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="this.hideCommentR()">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="this.viewChat" class="modal fade show" tabindex="-1" role="dialog" id="viewModal">
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
                                <span>{{this.chatUser}}</span>
                            </div>
                            <div v-for="item in this.chats" :class="item.class">
                                <div class="content">
                                    <p>
                                        {{item.message}}
                                    </p>
                                    <span style="float: right">{{item.created_at}}</span>
                                </div>
                            </div>


                        </div>
                        <div class="chat-footer">
                            <svg @click="sendMsg()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.9482 3.23906C5.3284 2.90532 4.57878 2.92199 3.97443 3.28297C3.37008 3.64394 3 4.29605 3 5V19C3 19.7039 3.37008 20.3561 3.97443 20.717C4.57878 21.078 5.3284 21.0947 5.9482 20.7609L18.9482 13.7609C19.596 13.4121 20 12.7358 20 12C20 11.2642 19.596 10.5879 18.9482 10.2391L5.9482 3.23906ZM5 19V14L12 12L5 10V5L18 12L5 19Z" fill="#D64012"/>
                            </svg>
                            <div class="chat-message">
                                <input ref="msg" type="text" class="form-control" placeholder="نوشتن پیام...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" style="margin: 0 auto" @click="this.viewChat = 0">
                            بستن مکالمه</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "inquiryListComponent",
    props :['inquiries' , 'count'],
    data() {
        return {
            viewM : false,
            replyM : false,
            viewChat: false,
            replyReviewM : false,
            commentReviewM : false,
            inquiryName : '',
            inquiry : [],
            id : 0,
            replyMessage : '',
            replyState : '',
            reply : [],
            comment : '',
            comment_time : '',
            message: '',
            chats : [],
            chatUser : ''
        }
    },
    methods:{
        view(id) {
            this.viewM = true;
            this.getInfo(id);

        },
        getInfo(id){
            var self = this;
            self.id = id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/item",
                    data: {id : self.id},
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success'){
                        self.inquiry = response.data.inquiry;
                        self.inquiryName = response.data.inquiry.name;
                    }
                })
        },
        replyIt(id){
            this.replyM = true;
            this.id = id;
            this.replyMessage = '';
        },
        hideView(){this.viewM = false;},
        hideReply(){this.replyM = false;},
        hideReplyR(){this.replyReviewM = false;},
        hideCommentR(){this.commentReviewM = false;},
        sendReply(id){
            var self = this;
            var fData = new FormData(document.getElementById('frmReply'));
            this.replyMessage = '';
            this.replyState = '';
            fData.append("id" , id);
            axios(
                {
                    method: "post",
                    url: "/inquiry/reply",
                    data: fData,
                }
            )
                .then(function (response) {
                    self.replyMessage = response.data.message;
                    if (response.data.state === 'success'){
                        self.replyState = 'alert alert-success';
                    }else{
                        self.replyState = 'alert alert-danger';
                    }
                })
        }
        ,
        replyReview(id){
            this.replyReviewM =  true;
            var self = this;
            self.id = id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/reply-info",
                    data: {id : self.id},
                }
            )
                .then(function (response) {
                    //if (response.state===200){
                        self.reply = response.data;
                        self.inquiryName = response.data.name;
                    //}
                })

        },

        commentReview(id){
            this.commentReviewM =  true;
            var self = this;
            self.id = id;
            axios(
                {
                    method: "post",
                    url: "/inquiry/comment-info",
                    data: {id : self.id , },
                }
            )
                .then(function (response) {
                    //if (response.state===200){
                    self.comment = response.data.comment;
                    self.comment_time = response.data.comment_time;
                    //}
                })
        },
        chatBox(supplier_id){
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
        sendMsg(){
            let message = this.$refs.msg.value;
            var self = this;
            if(message.length>0){
                axios(
                    {
                        method: "post",
                        url: "/messages/send",
                        data: {user_id: self.supplier_id , message : message},
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


