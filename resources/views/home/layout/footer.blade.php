@php
    $visitor_total = DB::table('views')->sum('view');
    $visitor_today = DB::table('views')->whereDate('created_at',date("Y-m-d"))->sum('view');
    $visitor_month = DB::table('views')->whereMonth('created_at',date("m"))->sum('view');
@endphp
<footer id="footer" class="footer">
    <div class="logo-footer">
        <img src="public/uploads/logobg/logo-footer.png?v={{time()}}" alt="logo">
    </div>
    <div class="footer-txt">
        www.bestkwave.com / bestkwave@gmail.com / +84 0862 303 059<br>
        B2-10 Scenic Valley 2, Phú Mỹ Hưng, Quận 7, Thành Phố Hồ Chí Minh, Vietnam <br>
        COPYRIGHT ⓒ  2021 KWAVE ALL RIGHTS RESERVED
        <p>
            <a href="page/about">About us</a> 
            <a href="page/advertisement">Hợp tác quảng cáo</a> 
        </p>
        <ul class="list-unstyled text-right p-3 footer-count">
            <li>Count Per Day</li>
            <li>Total Visitors: {{$visitor_total}}</li>
            <li>Visitors today: {{$visitor_today}}</li>
            <li>Visitors per month: {{$visitor_month}}</li>
        </ul>
    </div>
    <div class="scroll"><i class="fas fa-chevron-up"></i></div>
</footer>

<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'vi' , includedLanguages : 'en,ko,vi'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>