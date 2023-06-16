@extends("admin.layouts.app")

@section("content")
    <div class="card">
        <div class="card-body table-responsive">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>لطفا موارد زیر را تکمیل نمایید:</strong>
                    <ul class="mr-5 mt-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <form action="/admin/plans/{{$plan->id}}" method="post">
                @csrf
                @method("patch")
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>نام طرح
                            <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="نام طرح" value="{{old("name" , $plan->name)}}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>مدت زمان اشتراک به ماه
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="length" class="form-control text-left" placeholder="مدت زمان اشتراک به ماه" value="{{old("length", $plan->length)}}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>تعداد استعلام در هر ماه
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pj_per_month" class="form-control text-left" placeholder="تعداد استعلام در هر ماه"  value="{{old("pj_per_month" , $plan->pj_per_month)}}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>قیمت طرح (تومان)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="price" class="form-control text-left" placeholder="قیمت طرح" value="{{old("price" , $plan->price)}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>تعداد تامین کننده در هر بار استعلام
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="suppliers_count" class="form-control text-left" placeholder="تعداد تامین کننده در هر بار استعلام" value="{{old("suppliers_count" , $plan->suppliers_count)}}">
                        </div>
                    </div>
                    <label class="col-3 col-form-label mt-8">فعال بودن طرح</label>
                    <div class="col-3 mt-8">
							<span class="switch switch-outline switch-icon switch-success">
								<label>
									<input type="hidden" name="active" value="0" {{(($plan->active==0)?"checked":"")}}>
									<input type="checkbox" name="active" value="1" {{(($plan->active==1)?"checked":"")}}>
									<span></span>
								</label>
							</span>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>توضیحات طرح</label>
                            <textarea name="description" class="form-control">{{old("description" , $plan->description)}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <button class="btn btn-primary mr-2">ثبت اطلاعات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
