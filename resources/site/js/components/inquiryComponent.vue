<template>
    <form class="row form-frame" id="frmPJ">
        <div class="col-lg-6 col-sm-12 mb-3">
            <input type="text" class="form-control" name="name" placeholder="نام محصول مورد نظر شما *" />
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <input type="text" class="form-control" name="count" placeholder="تعداد محصول *" />
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control" name="unit_id">
                <option value="">-- واحد --</option>
                <option v-for="item in units" :value="item.id">{{item.name}}</option>
            </select>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">دسته بندی محصول</label>
        </div>
        <div class="col-lg-9 col-sm-12 mb-3">
            <select class="form-control" name="category_id" >
                <option value="">-- انتخاب کنید --</option>
                <option v-for="item in categories" :value="item.id">{{item.name}}</option>
            </select>
        </div>
        <div class="col-lg-12 col-sm-12 mb-3">
            <textarea  class="form-control" name="description" placeholder="مشخصات فنی محصول" rows="3"></textarea>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">چه زمانی قصد خرید دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker name="buy_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">زمان تحویل کالا</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker name="pay_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">زمان بستن استعلام</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker name="close_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">استان</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control" name="province_id" @change="fetchCities()" ref="province">
                <option v-for="item in provinces" :value="item.id">{{item.name}}</option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">شهری که مورد نیاز است</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control select2" name="city_id">
                <option v-for="item in cities" :value="item.id">{{item.name}}</option>
            </select>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <input type="text" class="form-control" name="price" placeholder="میزان قدرت خرید (ریال)" />
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">آیا شرایط پرداخت با چک دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cheque_enable" value="1" checked @click="this.shI=1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cheque_enable" value="0" @click="this.shI=0">
                <label class="form-check-label" >خیر</label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input type="text" class="form-control" name="cheque_count" placeholder="تعداد چک" />
        </div>
        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input type="text" class="form-control" name="cash_percent" placeholder="درصد پرداخت نقدی" />
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به ارسال نمونه است؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sample_enable" value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sample_enable" value="0" checked>
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به ضمانت دارد؟</label>
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

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به بازدید از مکان خرید را دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="visit_place_enable" value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="visit_place_enable" value="0" checked>
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <label for="formFileSm" class="form-label">تصویر محصول</label>
            <input class="form-control form-control-sm" name="picture" type="file">
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <label  class="mt-2">در صورت نیاز به حمل و نقل ، مسئولیت حمل و نقل با کیست؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="move_conditions" value="buyer" checked>
                <label class="form-check-label">خریدار</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="move_conditions" value="seller" >
                <label class="form-check-label">فروشنده</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 mb-3">
            <hr style="color: indianred"/>
            <strong class="text-danger">توجه : در صورت معرفی هر تامین کننده سابق خود یک pj رایگان دریافت کنید</strong>
        </div>

        <div class="col-lg-4 col-sm-12 mb-3">
            <input type="text" class="form-control" name="vendor_introduce_name" placeholder="نام تامین کننده" />
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <input type="text" class="form-control" style="text-align:left;direction:ltr" maxlength="11" name="vendor_introduce_mobile" placeholder="شماره تلفن همراه" />
        </div>



        <div class="default-btn" type="button" @click="submit()" v-if="this.submitted === 0">ثبت</div>
        <div class="col-lg-12 col-sm-12 mb-3"><a class="close-btn" href="/" v-if="this.submitted === 1">بازگشت</a></div>

        <div class="content-frame text-success font-weight-bold" v-show="(this.message !=='') ">{{this.message}}</div>
        <div class="content-frame" v-show="(this.errors !=='') ">
            <p>لطفا خطاهای زیر را برطرف نمایید:</p>
            <ul>
                <li v-for="item in this.errors" class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i> <small >{{item}}</small></li>
            </ul>
        </div>
    </form>
</template>

<script>
import DatePicker from 'vue3-persian-datetime-picker'
export default {
    name: "inquiryComponent.vue",
    props :['provinces' , 'units' , 'captcha' , 'categories'],
    components: { DatePicker },
    data() {
        return {
            province_id : 0,
            message : '',
            errors : '',
            cities : [],
            shI : 1,
            submitted : 0
        }
    },
    methods:{
        fetchCities(){
            if(this.$refs.province.value>0) {
                this.province_id = this.$refs.province.value;
                var self = this;
                axios(
                    {
                        method: "post",
                        url: "/cities",
                        data: {p:self.province_id}
                    }
                )
                    .then(function(response){
                        self.cities = response.data;
                    });
            }
        },
        submit(){
            var self = this;
            var fData = new FormData(document.getElementById('frmPJ'));
            this.errors = '';
            this.message ='';
            axios(
                {
                    method: "post",
                    url: "/inquiry/create",
                    data: fData,
                }
            )
                .then(function (response) {
                    if (response.data.state === 'success'){
                        self.message = response.data.message;
                        self.submitted = 1;

                    }else{
                        self.errors = response.data.message;
                    }
                })
        }

    },
    mounted(){
        this.fetchCities(1)
    }

}
</script>
