@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
    @include('home.layout.header-two')
@endsection
@section('content')
<section id="idol">
    <div class="row">
        <div class="col-md-8 col-12">
            <canvas id="myChart" width="400" height="250"></canvas>
        </div>
        <div class="col-md-4 col-12 wrap-rank">
            <ul class="list-unstyled ">
                <li class="row item-rank">
                    <div class="col-2 num-rank"><img src="public/home/image/gold-medal.png" alt="gold medal"></div>
                    <div class="col-3 img-rank"><img src="public/home/image/idol-men.jpg" alt="gold medal"></div>
                    <div class="col-5 name-rank"><a href="">Kang Daniel SFG FGG</a></div>
                    <div class="col-2 result-rank first">400.000</div>
                </li>
                <li class="row item-rank">
                    <div class="col-2 num-rank"><img src="public/home/image/silver-medal.png" alt="silver medal"></div>
                    <div class="col-3 img-rank"><img src="public/home/image/idol-men.jpg" alt="gold medal"></div>
                    <div class="col-5 name-rank"><a href="">Kang Daniel</a></div>
                    <div class="col-2 result-rank second">400.000</div>
                </li>
                <li class="row item-rank">
                    <div class="col-2 num-rank"><img src="public/home/image/bronze-medal.png" alt="bronze medal"></div>
                    <div class="col-3 img-rank"><img src="public/home/image/idol-men.jpg" alt="gold medal"></div>
                    <div class="col-5 name-rank"><a href="">Kang Daniel</a></div>
                    <div class="col-2 result-rank third">400.000</div>
                </li>
                @for ($i = 4; $i <= 20; $i++)
                <li class="row item-rank">
                    <div class="col-2 num-rank">{{$i}}</div>
                    <div class="col-3 img-rank"><img src="public/home/image/idol-men.jpg" alt="gold medal"></div>
                    <div class="col-5 name-rank"><a href="">Kang Daniel</a></div>
                    <div class="col-2 result-rank">400.000</div>
                </li>    
                @endfor
            </ul>
        </div>
        <p class="col-12 text-right mt-3"> <a href="" class="btn btn-sm btn-secondary">xem thêm</a> </p>
    </div>
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
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'today: PM', 'today: AM', 'yesterday: PM', 'yesterday: AM', 
                '2020.12.27: PM', '2020.12.27: AM', '2020.12.27: PM', '2020.12.27: AM', 
                '2020.12.27: PM', '2020.12.27: AM', '2020.12.27: PM', '2020.12.27: AM'
                ],
            datasets: [
                {
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0)',
                      
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                },
                {
                    label: '# of Likes',
                    data: [3, 5, 2, 3,12, 19, 3, 5, 2, 3,12, 19],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                },
                {
                    label: '# of không biết',
                    data: [ 5, 2, 3,12, 19,3, 5, 2, 3,12, 19, 3,],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0)',
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                    ],
                },
               
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