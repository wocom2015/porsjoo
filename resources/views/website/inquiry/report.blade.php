@extends("website.layouts.app")

@section("content")

    <h1 class="h6">{{$title}}</h1><hr>


    <div class="row">
        <div class="col-lg-12">
            <img src="/site/images/report.png" />
        </div>
    </div>
    <div class="row report-row mt-4 text-center">
        <div class="col-12 col-lg-3 report-box text-center">
            <p class="report-label">سه ماه گذشته </p>
            <p class="report-stat-num">{{$last_3}}</p>
        </div>
        <div class="col-12 col-lg-3 report-box text-center">
            <p class="report-label">شش ماه گذشته  </p>
            <p class="report-stat-num">{{$last_6}}</p>
        </div>
        <div class="col-12 col-lg-3 report-box text-center">
            <p class="report-label">یک سال گذشته  </p>
            <p class="report-stat-num">{{$last_12}}</p>
        </div>
    </div>
@endsection
