<template>

    <div class="content-frame">
        <p>کاربر گرامی لطفا قبل از پر کردن فرم Pj جدید به سوالات زیر پاسخ دهید:</p>
        <form id="theform" action="/inquiry/feedback" method="post">
            <input :value="id" name="id" type="hidden">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">آیا محصولی که در استعلام
                        <strong>{{ username }}</strong>
                        به دنبال آن بودید خریداری نمودید؟
                    </label>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <div class="form-check form-check-inline">
                        <input checked
                               class="form-check-input"
                               name="is_bought"
                               type="radio"
                               :value="status ? 1 : 0"
                               @click="changeSelected()">
                        <label class="form-check-label">بله</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input :value="status ? 0 : 1"
                               class="form-check-input"
                               name="is_bought"
                               type="radio"
                               @click="changeSelected()">
                        <label class="form-check-label">خیر</label>
                    </div>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">اگر جواب سوال قبلی شما بله است از کدام تامین کننده؟
                    </label>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <select class="form-control" name="vendor_id" required>
                        <option value="">-- انتخاب کنید --</option>
                        <option v-for="v in vendors" :value="v.user.id">{{ v.user.name + ' ' + v.user.last_name }}
                        </option>
                    </select>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">در صورتی که تامین کننده را انتخاب نمودید امتیاز شما به تامین کننده از 1 تا 5 چند
                        است؟
                    </label>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <select class="form-control" name="score" required>
                        <option value="">--انتخاب کنید--</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">در صورتی که تامین کننده را انتخاب نمودید نظر خود را در مورد آن بنویسید
                    </label>
                </div>
                <div v-if="status" class="yes col-lg-6 col-sm-12 mb-3">
                    <textarea class="form-control" name="comment" required rows="4"
                              style="border: 1px solid #D64012"></textarea>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <button id="thebutton" class="default-btn" type="submit">ذخیره</button>
                </div>

            </div>
        </form>
    </div>


</template>

<script>
export default {
    name: "feedbackComponent.vue",
    props: ['lastPJ', 'username', 'id', 'vendors'],
    data() {
        return {
            status: true,
        }
    },
    methods: {
        changeSelected() {
            this.status = !this.status;
            // if (status === 'yes') {
            //     document.querySelectorAll(".yes").forEach(function (e) {
            //         e.style.display = 'block';
            //         // e.type = null;
            //         e.required = true;
            //         e.attributes.required = true;
            //         e.setAttribute('required', true);
            //         e.novalidate = false;
            //         e.attributes.novalidate = false;
            //         e.setAttribute('novalidate', false);
            //     });
            //     document.getElementById("theform").removeAttribute("novalidate");
            //     document.getElementById("thebutton").removeAttribute("formnovalidate");
            // } else if (status === 'no') {
            //     document.querySelectorAll(".yes").forEach(function (e) {
            //         e.required = false;
            //         e.attributes.required = false;
            //         e.setAttribute('required', false);
            //         e.novalidate = true;
            //         e.attributes.novalidate = true;
            //         e.setAttribute('novalidate', true);
            //         e.style.display = 'none';
            //         // e.type = 'hidden';
            //     });
            //     document.getElementById("theform").setAttribute("novalidate", "novalidate");
            //     document.getElementById("thebutton").setAttribute("formnovalidate", "formnovalidate");
            // }
        }
    },
    mounted() {
        this.status = true;
    }

}
</script>

