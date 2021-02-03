@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
    @include('home.layout.header-two')
@endsection
@section('content')
<section id="idol">
    <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-laptop-house"></i> BEST IDOL</a></li>
		</ol>
	</nav>
    <div class="row">
        <div class="col-md-8 col-12">
            <canvas id="myChart" width="400" height="250"></canvas>
        </div>
        <div class="col-md-4 col-12 wrap-rank">
            <ul class="list-unstyled ">
                @foreach ($lists as $key => $item)
                
                    <li class="row item-rank">
                        @if ($key == 0)
                            <div class="col-2 num-rank"><img src="public/home/image/gold-medal.png" alt="gold medal"></div>
                        @elseif($key == 1)
                            <div class="col-2 num-rank"><img src="public/home/image/silver-medal.png" alt="silver medal"></div>
                        @elseif($key == 2)
                             <div class="col-2 num-rank"><img src="public/home/image/bronze-medal.png" alt="bronze medal"></div>
                        @else
                            <div class="col-2 num-rank">{{++$key}}</div>
                        @endif
                        <div class="col-3 img-rank"><img src="public/uploads/idol/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->avatar}}" alt="gold medal"></div>
                        <div class="col-5 name-rank"><a href="idol/detail/{{$item->id}}">{{$item->nickname}}</a></div>
                        <div class="col-2 result-rank">{{$item->sumvote}}</div>
                    </li>    
                @endforeach
            </ul>
        </div>
        <p class="col-12 text-right mt-3"> 
            <a href="idol/list" class="btn btn-sm btn-secondary"><i class="fas fa-list"></i> Danh sách</a>
            <a href="idol/ranking" class="btn btn-sm btn-secondary"><i class="fas fa-list-ol"></i> Xem xếp hạng </a> 
        </p>
    </div>

    <div id="label" label="{{json_encode($label)}}"></div>
    <div id="nickname" label="{{json_encode($nickname)}}"></div>
    <div id="mainvote" label="{{json_encode($mainvote)}}"></div>

</section>
@endsection

@push('javascript')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" ></script>

@endpush

@push('script')
<script>
    var ctx = document.getElementById('myChart');
    var ctx = $('#myChart');
    var label = $('#label').attr('label');
    label = label.replace(/'/g, '"');
    label = JSON.parse(label);
    var nickname = $('#nickname').attr('label');
    nickname = nickname.replace(/'/g, '"');
    nickname = JSON.parse(nickname);
    var mainvote = $('#mainvote').attr('label');
    mainvote = mainvote.replace(/'/g, '"');
    mainvote = JSON.parse(mainvote);
console.log(mainvote[5]);
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: label, 
                // [
                // "today: PM", 'today: AM', 'yesterday: PM', 'yesterday: AM', 
                // '2020.12.27: PM', '2020.12.27: AM', '2020.12.27: PM', '2020.12.27: AM',
                // ],
            datasets: [
                {
                    label: nickname[0],
                    data: mainvote[0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0)',
                      
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                },
                {
                    label: nickname[1],
                    data: mainvote[1],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                },
                {
                    label: nickname[2],
                    data: mainvote[2],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                    ],
                },
                {
                    label: nickname[3],
                    data: mainvote[3],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                    ],
                },
                {
                    label: nickname[4],
                    data: mainvote[4],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                    ],
                }
               
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endpush