@php
    $visitor_total = DB::table('views')->sum('view');
    $visitor_today = DB::table('views')->whereDate('created_at',date("Y-m-d"))->sum('view');
    $visitor_month = DB::table('views')->whereMonth('created_at',date("m"))->sum('view');

    $website = DB::table('informations')->where([['status',1],['type',1]])->get();
    $phone = DB::table('informations')->where([['status',1],['type',2]])->get();
    $email = DB::table('informations')->where([['status',1],['type',3]])->get();
    $address = DB::table('informations')->where([['status',1],['type',4]])->get();
@endphp
<footer id="footer" class="footer">
    <div class="logo-footer">
        <img src="public/uploads/logobg/logo-footer.png?v={{time()}}" alt="logo">
    </div>
    <div class="footer-txt">
        <ul class="list-unstyled text-right p-3 footer-count">
            <li>Count Per Day</li>
            <li>Total Visitors: {{$visitor_total}}</li>
            <li>Visitors today: {{$visitor_today}}</li>
            <li>Visitors per month: {{$visitor_month}}</li>
        </ul>
        {{-- Website: @foreach ($website as $item) {{$item->title}} @endforeach <br>  --}}
        @foreach ($phone as $item) {{$item->title}} &nbsp; @endforeach  &nbsp; @foreach ($email as $item) {{$item->title}} &nbsp; @endforeach <br>
        
        @foreach ($address as $item) {{$item->title}} @endforeach <br>
        COPYRIGHT ⓒ  2021 KWAVE ALL RIGHTS RESERVED
        <p>
            <a href="page/about">About us</a> 
            <a href="page/advertisement">Advertising Cooperation</a> 
        </p>
        
    </div>
    <div class="scroll"><i class="fas fa-chevron-up"></i></div>
</footer>

<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'vi' , includedLanguages : 'en,ko,vi'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>