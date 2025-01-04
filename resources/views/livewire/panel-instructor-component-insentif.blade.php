<div>
    
<div data-card-height="200" class="card card-style bg-15">
    <div class="card-center ms-3">
        <h1 class="color-white mb-0">Total Commision</h1>
        <p class="color-white opacity-50 mb-0 font-12">{{Auth::guard('instructor')->User()->first_name.' '.AUTH::guard('instructor')->User()->last_name}}</p>
    </div>
    <div class="card-center mt-5">
        <h1 class="text-end color-white font-40 bolder pe-3">{{$formateInsentif}}</h1>
    </div>
    <div class="card-bottom ps-3">
        <p class="mb-3 font-8 font-500 opacity-50 color-white"></p>
    </div>       
    <div class="card-bottom pe-3 pb-3 ">
        <i class="float-end fa fa-wifi font-10 rotate-90"></i>
    </div>
    <div class="card-overlay bg-black opacity-70"></div>
</div>  

<div class="card card-style">
    <div class="content mb-0">
        <h3 class="font-600">Recent Transactions</h3>
        <p>
            Your most recent transactions will show up in this area, you can visit the Detailed page for more.
        </p>
        <div class="list-group list-custom-large">
           
            @foreach($data as $key => $value)
            <a href="#">
                <i class="fa fa-user rounded-xl shadow-s bg-blue-dark"></i>
                <span>Pilates Earnings</span>
                <strong>{{$value['name']}}</strong>
                <span class="badge bg-green-dark font-11">{{'Rp. '.number_format($value['amount'],2,'.',',')}}</span>
                <i class="fa fa-angle-right"></i>
            </a>    
            @endforeach
           
            
        </div>

    </div>
</div>

</div>
