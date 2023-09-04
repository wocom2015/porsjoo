@extends("website.layouts.app")
@section("content")
    <div class="content-frame">
        {{$lastPJ->id}}
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
                    <button class="default-btn">ذخیره</button>
                </div>

            </div>
        </form>
    </div>
@endsection
