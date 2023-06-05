@extends("website.layouts.app")

@section("content")
    <p>شما می توانید از طریق pj ها همزمان از چندین فروشنده استعلام قیمت بگیرید</p>

    <div class="row form-frame">
        <div class="col-lg-6 col-sm-12 mb-3">
            <input type="text" class="form-control" placeholder="نام محصول" />
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <select class="form-control select2" >
                <option value="1"></option>
            </select>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <input type="text" class="form-control" placeholder="تعداد محصول" />
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <textarea  class="form-control" placeholder="مشخصات فنی محصول" rows="3"></textarea>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">چه زمانی قصد خرید دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <input type="text" class="form-control">
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">چه زمانی پرداخت می کنید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <input type="text" class="form-control">
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <select class="form-control select2" placeholder="استان">
                <option value="1"></option>
            </select>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <select class="form-control select2" placeholder="شهر">
                <option value="1"></option>
            </select>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <input type="text" class="form-control" placeholder="قیمت مورد نظر" />
        </div>


        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">آیا شرایط پرداخت با چک دارید؟</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cheque_enable" value="1">
                <label class="form-check-label">بله</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cheque_enable" value="0">
                <label class="form-check-label">خیر</label>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <label for="formFileSm" class="form-label">تصویر محصول</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="form-check">
                <input class="form-check-input checkbox-success" type="checkbox" value="" id="flexCheckChecked" checked="">
                <label class="form-check-label" for="flexCheckChecked">
                    نمایش محصولات مشابه
                </label>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="form-check">
                <input class="form-check-input checkbox-success" type="checkbox" value="" id="flexCheckChecked" checked="">
                <label class="form-check-label" for="flexCheckChecked">
                    ارسال این درخواست برای چند تامین کننده
                </label>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="mt-2">عبارت امنیتی</label>
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <input type="text" class="form-control" placeholder="?=2+4">
        </div>

        <div class="default-btn" type="button">ثبت</div>


    </div>
@endsection
