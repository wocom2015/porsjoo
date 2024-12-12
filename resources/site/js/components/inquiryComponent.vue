<template>
    <form class="row form-frame" id="frmPJ">
        <div class="col-lg-6 col-sm-12 mb-3">
            <input v-model="the_data.name"
                   class="form-control"
                   name="name"
                   placeholder="نام محصول مورد نظر شما *"
                   type="text"/>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <input v-model="the_data.count"
                   class="form-control"
                   name="count"
                   placeholder="تعداد محصول *" type="text"/>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select v-model="the_data.unit_id" class="form-control" name="unit_id">
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
            <treeselect v-model="the_data.category_id"
                        :multiple="false"
                        :normalizer="normalizer"
                        :options="categories"
                        name="category_id"
                        ref="treeselect"
                        v-bind:aria-selected="the_data.category_id"
                        placeholder="&#45;&#45; انتخاب کنید &#45;&#45;">
            </treeselect>
            <!--
                        <select class="form-control" name="category_id">
                            <option value="">&#45;&#45; انتخاب کنید &#45;&#45;</option>
                            <option v-for="item in categories" :value="item.id">{{ item.name }}</option>
                        </select>
            -->
        </div>
        <div class="col-lg-12 col-sm-12 mb-3">
            <textarea v-model="the_data.description"
                      class="form-control"
                      name="description"
                      placeholder="مشخصات فنی محصول" rows="3"></textarea>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                چه زمانی قصد خرید دارید؟
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker v-model="the_data.buy_date"
                         :aria-required="true"
                         aria-required="true"
                         name="buy_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                زمان تحویل کالا
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker v-model="the_data.pay_date"
                         name="pay_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                زمان بستن استعلام
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <date-picker v-model="the_data.close_date"
                         aria-required="true"
                         name="close_date"></date-picker>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">
                استان
                <span class='text-danger'>*</span>
            </label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <select ref="province"
                    v-model="the_data.province_id"
                    class="form-control"
                    name="province_id"
                    @change="fetchCities()">
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
            <select v-model="the_data.city_id"
                    class="form-control select2"
                    name="city_id">
                <option v-for="item in cities" :value="item.id">{{ item.name }}</option>
            </select>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <input v-model="the_data.price"
                   class="form-control"
                   name="price"
                   placeholder="میزان قدرت خرید (ریال)" type="text"/>
            <!--
            <input class="form-control"
                   name="price"
                   value="{{data !== null? (data.) : ''}}"
                   placeholder="میزان قدرت خرید (ریال)" type="text"
            />
-->
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">آیا شرایط پرداخت با چک دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input v-model="the_data.cheque_enable"
                       checked
                       class="form-check-input"
                       name="cheque_enable"
                       type="radio" value="1" @click="this.shI=1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input v-model="the_data.cheque_enable"
                       class="form-check-input"
                       name="cheque_enable"
                       type="radio"
                       value="0" @click="this.shI=0">
                <label class="form-check-label">خیر</label>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input v-model="the_data.cheque_count"
                   class="form-control"
                   name="cheque_count"
                   placeholder="تعداد چک" type="text"/>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3" v-if="this.shI===1">
            <input v-model="the_data.cash_percent"
                   class="form-control"
                   name="cash_percent"
                   placeholder="درصد پرداخت نقدی" type="text"/>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به ارسال نمونه است؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input v-model="the_data.sample_enable"
                       class="form-check-input"
                       name="sample_enable"
                       type="radio"
                       value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input v-model="the_data.sample_enable"
                       class="form-check-input"
                       name="sample_enable"
                       type="radio"
                       value="0">
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به ضمانت دارد؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input v-model="the_data.guarantee_enable"
                       class="form-check-input"
                       name="guarantee_enable"
                       type="radio"
                       value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input v-model="the_data.guarantee_enable"
                       checked
                       class="form-check-input"
                       name="guarantee_enable"
                       type="radio" value="0">
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">نیاز به بازدید از مکان خرید را دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input v-model="the_data.visit_place_enable"
                       class="form-check-input"
                       name="visit_place_enable"
                       type="radio"
                       value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input v-model="the_data.visit_place_enable"
                       checked
                       class="form-check-input"
                       name="visit_place_enable"
                       type="radio" value="0">
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <label for="formFileSm" class="form-label">تصویر محصول</label>
            <input class="form-control form-control-sm"
                   name="picture"
                   type="file">
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <label class="mt-2">در صورت نیاز به حمل و نقل ، مسئولیت حمل و نقل با کیست؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input v-model="the_data.move_conditions"
                       checked
                       class="form-check-input"
                       name="move_conditions"
                       type="radio" value="buyer">
                <label class="form-check-label">خریدار</label>
            </div>
            <div class="form-check form-check-inline">
                <input v-model="the_data.move_conditions"
                       class="form-check-input"
                       name="move_conditions"
                       type="radio"
                       value="seller">
                <label class="form-check-label">فروشنده</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 mb-3">
            <hr style="color: indianred"/>
            <strong class="text-danger">توجه : در صورت معرفی هر تامین کننده سابق خود یک pj رایگان دریافت کنید</strong>
        </div>

        <div class="col-lg-4 col-sm-12 mb-3">
            <input v-model="the_data.vendor_introduce_name"
                   class="form-control"
                   name="vendor_introduce_name"
                   placeholder="نام تامین کننده" type="text"/>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <input v-model="the_data.vendor_introduce_mobile"
                   class="form-control"
                   maxlength="11"
                   name="vendor_introduce_mobile"
                   placeholder="شماره تلفن همراه"
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
        <div class="col-lg-12 col-sm-12 mb-3"><a v-if="this.submitted === 1" class="close-btn"
                                                 href="/profile">بازگشت</a></div>

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
import Treeselect from 'vue3-treeselect'
import 'vue3-treeselect/dist/vue3-treeselect.css'


export default {
    name: "inquiryComponent.vue",
    props: ['provinces', 'units', 'captcha', 'categories', 'entity'],
    components: {DatePicker, Treeselect/*,VueTreeselect.Treeselect*/},
    data() {
        return {
            province_id: 0,
            message: '',
            errors: '',
            cities: [],
            shI: 1,
            submitted: 0,
            isFreeze: false,
            nullValue: null,
            the_data: {
                name: 'abouzar',
                count: null,
                unit_id: null,
                category_id: this.entity === null ? null : this.entity.category_id,
                description: '',
                buy_date: null,
                pay_date: null,
                close_date: null,
                province_id: null,
                city_id: null,
                price: null,
                cheque_enable: "1",
                cheque_count: null,
                cash_percent: null,
                sample_enable: 0,
                guarantee_enable: 0,
                visit_place_enable: 0,
                picture: null,
                move_conditions: 'buyer',
                vendor_introduce_name: null,
                vendor_introduce_mobile: null
            }
        }
    },
    computed: {
        isDisabled() {
            return this.isFreeze;
        }
    },
    methods: {
        setExpandLevel() {
            const {treeselect} = this.$refs

            treeselect.traverseAllNodesByIndex(node => {
                if (node.isBranch) {
                    node.isExpanded = true;
                }
            })
        },
        normalizer(node) {
            return {
                id: node.id,
                label: node.name,
                children: node.children,
            }
        },
        setDefaults() {
            if (this.entity == null) return;
            this.the_data.name = this.entity.name;
            this.the_data.count = this.entity.count;
            this.the_data.unit_id = this.entity.unit_id;
            this.the_data.category_id = this.entity.category_id;
            this.the_data.description = this.entity.description;
            this.the_data.buy_date = this.entity.buy_date;
            this.the_data.pay_date = this.entity.pay_date;
            this.the_data.close_date = this.entity.close_date;
            this.the_data.province_id = this.entity.province_id;
            this.the_data.city_id = this.entity.city_id;
            this.the_data.price = this.entity.price;
            this.the_data.cheque_enable = this.entity.cheque_enable;
            this.the_data.cheque_count = this.entity.cheque_count;
            this.the_data.cash_percent = this.entity.cash_percent;
            this.the_data.sample_enable = this.entity.sample_enable;
            this.the_data.guarantee_enable = this.entity.guarantee_enable;
            this.the_data.visit_place_enable = this.entity.visit_place_enable;
            this.the_data.picture = this.entity.picture;
            this.the_data.move_conditions = this.entity.move_conditions;
            this.the_data.vendor_introduce_name = this.entity.vendor_introduce_name;
            this.the_data.vendor_introduce_mobile = this.entity.vendor_introduce_mobile;
        },
        fetchCities(flag = true) {
            if (this.$refs.province.value > 0) {
                if (flag === true) {
                    this.province_id = this.$refs.province.value;
                } else {
                    this.province_id = this.the_data.province_id;
                }
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
                if (error.response !== undefined && error.response !== null) {
                    if (error.response.status = 401) {
                        // router.push({ path: 'signin' });
                        window.location.href = '/signin?redirect=/inquiry/request';
                    }
                }
            })
        }

    },
    mounted() {
        this.setDefaults();
        this.fetchCities(false)
        this.setExpandLevel();
    }

}
</script>
