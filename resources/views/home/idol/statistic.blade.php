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
                {{-- <li class="row item-rank">
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
                </li> --}}
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
            <a href="idol/list" class="btn btn-sm btn-secondary">danh sách</a>
            <a href="idol/ranking" class="btn btn-sm btn-secondary">xem xếp hạng</a> 
        </p>
    </div>

    <div id="label" label="{{json_encode($label)}}"></div>

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
                    label: '# of Votes',
                    data: {{json_encode($vote)}},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0)',
                      
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                },
                {
                    label: '# of Likes',
                    data: {{json_encode($like)}},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
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