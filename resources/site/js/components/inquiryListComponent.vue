<template>
    <div>
        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>استعلام های متناسب با حرفه شما : {{this.count}} مورد</h1></div>
            </div>

            <div class="row mb-2 p-2" v-for="item in this.inquiries">
                <div class="col-lg-2">{{item.provinceName}}</div>
                <div class="col-lg-4"><strong>{{item.name}}</strong><br>{{item.description}}</div>
                <div class="col-lg-2">{{item.created}}</div>
                <div class="col-lg-2"><button @click="view(item.id)" class="btn btn-custom-outline">مشاهده مشخصات</button></div>
                <div class="col-lg-2"><button @click="reply(item.id)" class="btn btn-custom-outline">پاسخ</button> </div>
            </div>



        </div>

        <div v-show="this.replyM" class="modal fade show" tabindex="-1" role="dialog" id="replyModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">پاسخ به استعلام</h5>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">توجه : کاربر گرامی با پاسخ به هر استعلام از تعداد امکان استعلام شما یکی کم می شود.</div>
                        <form id="frmReply">
                            <div class="row mb-2">
                                <div class="col-lg-3">
                                    <label>قیمت پیشنهادی شما (تومان)</label>
                                    <input type="text" name="price" class="form-control text-black text-left bg-gray">
                                </div>
                                <div class="col-lg-9">
                                    <label>توضیحات شما</label>
                                    <input type="text" name="description" class="form-control text-black bg-gray">
                                </div>
                            </div>
                        </form>
                        <div v-show="replyMessage!==''" :class="replyState">
                            <p v-for="item in replyMessage">{{item}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default-btn" @click="sendReply(this.id)">ارسال پاسخ</button>
                        <button type="button" class="btn btn-custom-outline" @click="hideReply()">بستن</button>
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
                            <div class="col-lg-6"><span>تعداد : </span><strong>{{this.inquiry.count}} {{this.inquiry.unitName}}</strong></div>
                            <div class="col-lg-6"><span>دسته بندی : </span><strong>{{this.inquiry.categoryName}}</strong></div>
                            <div class="col-lg-6"><span>زمان خرید : </span><strong>{{this.inquiry.buy_date}}</strong></div>
                            <div class="col-lg-6"><span>زمان پرداخت : </span><strong>{{this.inquiry.pay_date}}</strong></div>
                            <div class="col-lg-6"><span>استان : </span><strong>{{this.inquiry.provinceName}}</strong></div>
                            <div class="col-lg-6"><span>شهر : </span><strong>{{this.inquiry.cityName}}</strong></div>
                            <div class="col-lg-6"><span>میزان قدرت خرید : </span><strong>{{this.inquiry.price}}</strong></div>
                            <div class="col-lg-6"><span>امکان خرید چکی : </span><strong>{{(this.inquiry.cheque_eneable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-6"><span>درخواست ارسال نمونه : </span><strong>{{(this.inquiry.sample_enable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-6"><span>نیاز به ضمانت دارد؟ : </span><strong>{{(this.inquiry.guarantee_enable)?'بله':'خیر'}}</strong></div>
                            <div class="col-lg-12"><span>توضیحات : </span><strong>{{this.inquiry.description}}</strong></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom-outline" @click="hideView()">متوجه شدم</button>
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
            inquiryName : '',
            inquiry : [],
            id : 0,
            replyMessage : '',
            replyState : ''
        }
    },
    methods:{
        view(id) {
            this.viewM = true;
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

                        console.log(response.data);
                        self.inquiry = response.data.inquiry;
                        self.inquiryName = response.data.inquiry.name;
                    }else{

                    }
                })
        },
        reply(id){
            this.replyM = true;
            this.id = id;
        },
        hideView(){
            this.viewM = false;
        },
        hideReply(){
            this.replyM = false;
        },
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
    }
}
</script>


