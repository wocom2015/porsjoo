<template>
    <form class="row form-frame" id="frmPJ">
        <div class="col-lg-6 col-sm-12 mb-3">
            <input class="form-control" name="name" placeholder="نام محصول مورد نظر شما *" type="text"/>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <input class="form-control" name="count" placeholder="تعداد محصول *" type="text"/>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control" name="unit_id">
                <option value="">
                    -- واحد --
                    <span class='text-danger'>*</span>
                </option>
                <option v-for="item in units" :value="item.id">{{ item.name }}</option>
            </select>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                دسته بندی محصول
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-9 col-sm-12 mb-3">
            <select class="form-control" name="category_id">
                <option value="">-- انتخاب کنید --</option>
                <option v-for="item in categories" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
        <div class="col-lg-12 col-sm-12 mb-3">
            <textarea class="form-control" name="description" placeholder="مشخصات فنی محصول" rows="3"></textarea>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                چه زمانی قصد خرید دارید؟
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker :aria-required="true" aria-required="true" name="buy_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                زمان تحویل کالا
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker name="pay_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                زمان بستن استعلام
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker aria-required="true" name="close_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                استان
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control" name="province_id" @change="fetchCities()" ref="province">
                <option v-for="item in provinces" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                شهری که مورد نیاز است
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select class="form-control select2" name="city_id">
                <option v-for="item in cities" :value="item.id">{{ item.name }}</option>
            </select>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <input class="form-control" name="price" placeholder="میزان قدرت خرید (ریال)" type="text"/>
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
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input class="form-control" name="cheque_count" placeholder="تعداد چک" type="text"/>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input class="form-control" name="cash_percent" placeholder="درصد پرداخت نقدی" type="text"/>
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
            <label class="mt-2">در صورت نیاز به حمل و نقل ، مسئولیت حمل و نقل با کیست؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="move_conditions" value="buyer" checked>
                <label class="form-check-label">خریدار</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="move_conditions" type="radio" value="seller">
                <label class="form-check-label">فروشنده</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 mb-3">
            <hr style="color: indianred"/>
            <strong class="text-danger">توجه : در صورت معرفی هر تامین کننده سابق خود یک pj رایگان دریافت کنید</strong>
        </div>

        <div class="col-lg-4 col-sm-12 mb-3">
            <input class="form-control" name="vendor_introduce_name" placeholder="نام تامین کننده" type="text"/>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <input class="form-control" maxlength="11" name="vendor_introduce_mobile" placeholder="شماره تلفن همراه"
                   dir="ltr"
                   style="text-align:left;" type="text"/>
        </div>


        <div v-if="this.submitted === 0 && !isDisabled"
             class="default-btn"
             type="button"
             @click="submit()">
            ثبت
        </div>
        <div v-if="this.submitted === 0 && isDisabled"
             class="default-btn disabled-btn"
             style="background: #D1D1D1;"
             type="button">
            ثبت
        </div>
        <div class="col-lg-12 col-sm-12 mb-3"><a class="close-btn" href="/" v-if="this.submitted === 1">بازگشت</a></div>

        <div v-show="(this.message !=='') " class="content-frame text-success font-weight-bold">{{ this.message }}</div>
        <div class="content-frame" v-show="(this.errors !=='') ">
            <p>لطفا خطاهای زیر را برطرف نمایید:</p>
            <ul>
                <li v-for="item in this.errors" class="mb-0 text-danger"><i class="bi bi-exclamation-triangle"></i>
                    <small>{{ item }}</small></li>
            </ul>
        </div>
    </form>
</template>

<script>
import DatePicker from 'vue3-persian-datetime-picker'

export default {
    name: "inquiryComponent.vue",
    props: ['provinces', 'units', 'captcha', 'categories'],
    components: {DatePicker},
    data() {
        return {
            province_id: 0,
            message: '',
            errors: '',
            cities: [],
            shI: 1,
            submitted: 0,
            isFreeze: false,
        }
    },
    computed: {
        isDisabled() {
            return this.isFreeze;
        }
    },
    methods: {
        fetchCities() {
            if (this.$refs.province.value > 0) {
                this.province_id = this.$refs.province.value;
                var self = this;
                axios(
                    {
                        method: "post",
                        url: "/cities",
                        data: {p: self.province_id}
                    }
                )
                    .then(function (response) {
                        self.cities = response.data;
                    });
            }
        },
        submit() {
            this.isFreeze = true;
            var self = this;
            var fData = new FormData(document.getElementById('frmPJ'));
            this.errors = '';
            this.message = '';
            axios(
                {
                    method: "post",
                    url: "/inquiry/create",
                    data: fData,
                }
            ).then(function (response) {
                self.isFreeze = false;
                if (response.data.state === 'success') {
                    self.message = response.data.message;
                    self.submitted = 1;

                } else {
                    self.errors = response.data.message;
                }
            }).catch(error => {
                self.isFreeze = false;
            })
        }

    },
    mounted() {
        this.fetchCities(1)
    }

}
</script>
