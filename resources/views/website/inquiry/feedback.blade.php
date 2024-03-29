@extends("website.layouts.app")
@section("content")
    <div class="content-frame">
        <p>کاربر گرامی لطفا قبل از پر کردن فرم Pj جدید به سوالات زیر پاسخ دهید:</p>
        <form method="post" action="/inquiry/feedback">
            @csrf
            <input type="hidden" name="id" value="{{$lastPJ->id}}">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">آیا محصولی که در استعلام
                        <strong>{{$lastPJ->name}}</strong>
                        به دنبال آن بودید خریداری نمودید؟
                    </label>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_bought" value="1" checked>
                        <label class="form-check-label">بله</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_bought" value="0">
                        <label class="form-check-label">خیر</label>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">اگر جواب سوال قبلی شما بله است از کدام تامین کننده؟
                    </label>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <select class="form-control" name="vendor_id">
                        <option value="">-- انتخاب کنید --</option>
                        @foreach($vendors as $v)
                            <option value="{{$v->user->id}}">{{$v->user->name.' '.$v->user->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">در صورتی که تامین کننده را انتخاب نمودید نظر خود را در مورد آن بنویسید
                    </label>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <textarea class="form-control" name="comment" rows="4" style="border: 1px solid #D64012"></textarea>
                </div>

                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="mt-2">در صورتی که تامین کننده را انتخاب نمودید امتیاز شما به تامین کننده از 1 تا 5 چند
                        است؟
                    </label>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <select class="form-control" name="score">
                        <option value="">--انتخاب کنید--</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>

                <div class="col-lg-6 col-sm-12 mb-3">
                    <button class="default-btn">ذخیره</button>
                </div>

            </div>
        </form>
    </div>
@endsection
