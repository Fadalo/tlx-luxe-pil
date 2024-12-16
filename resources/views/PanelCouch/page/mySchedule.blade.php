@extends('PanelCouch.layout')
@section('meta_title','INSTRUCTOR-LISTPACKAGE')

@section('contentsMenu')
    <?php
    $menu_link = 'instructor.mySchedule';
    ?>
    @include('PanelCouch.common.header2')
@endsection
@section('contents')

<div class="page-title page-title-small">
    <h2><a href="{{ route('instructor.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE INSTRUCTOR</h2>
    <a href="{{ route('instructor.mySchedule')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>


<div class="calendar bg-theme shadow-xl rounded-m">
    <div class="cal-header">
        <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">TODAY SCHEDULE</h4>
    </div>
    <div class="clearfix"></div>
    <div class="divider mb-1"></div>
    <div class="cal-days bg-theme opacity-80 pt-2 pb-2">
        <a href="#" class="color-highlight">SUN</a>
        <a href="#" class="color-highlight">MON</a>
        <a href="#" class="color-highlight">TUE</a>
        <a href="#" class="color-highlight">WED</a>
        <a href="#" class="color-highlight">THU</a>
        <a href="#" class="color-highlight">FRI</a>
        <a href="#" class="color-highlight">SAT</a>
        <div class="clearfix"></div>
    </div>
    <div class="divider mb-1"></div>
    <div class="cal-dates cal-dates-border">
        <a href="#" class="cal-disabled">25</a>
        <a href="#" class="cal-disabled">26</a>
        <a href="#" class="cal-disabled">27</a>
        <a href="#" class="cal-disabled">28</a>
        <a href="#" class="cal-disabled">29</a>
        <a href="#" class="cal-disabled">30</a>
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
        <a href="#">9</a>
        <a href="#" class="color-red-dark">10</a>
        <a href="#" class="color-red-dark">11</a>
        <a href="#" class="cal-selected"><i class="fa fa-square color-highlight"></i><span>12</span></a>
        <a href="#" class="color-green-dark">13</a>
        <a href="#" class="color-green-dark">14</a>
        <a href="#">15</a>
        <a href="#">16</a>
        <a href="#">17</a>
        <a href="#">18</a>
        <a href="#">19</a>
        <a href="#">20</a>
        <a href="#">21</a>
        <a href="#">22</a>
        <a href="#">23</a>
        <a href="#">24</a>
        <a href="#">25</a>
        <a href="#">26</a>
        <a href="#">27</a>
        <a href="#">28</a>
        <a href="#">29</a>
        <a href="#">30</a>
        <a href="#">31</a>
        <a href="#" class="cal-disabled">1</a>
        <a href="#" class="cal-disabled">2</a>
        <a href="#" class="cal-disabled">3</a>
        <a href="#" class="cal-disabled">4</a>
        <a href="#" class="cal-disabled">5</a>
        <div class="clearfix"></div>
    </div>

    <div class="cal-footer">
        <div class="cal-schedule">
            <em>08:00 PM<br>10:00 AM</em>
            <strong>Private Batch 1, Session 1</strong>
            <span><i class="fa fa-building"></i>LUXE PILATES</span>
        </div>
        <div class="cal-schedule">
            <em>10:00 AM<br>12:00 AM</em>
            <strong>Private Batch 1, Session 2</strong>
            <span><i class="fa fa-building"></i>LUXE PILATES</span>
        </div>
        <div class="cal-schedule">
            <em>12:00 AM<br>02:00 PM</em>
            <strong>Private Batch 1, Session 3</strong>
            <span><i class="fa fa-building"></i>LUXE PILATES</span>
        </div>
        
    </div>
</div>


@endsection