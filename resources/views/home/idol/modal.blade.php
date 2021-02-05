<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-title text-center">
                    <h4>Đăng nhập</h4>
                </div>
                <div class="d-flex flex-column text-center">
                    <form action="logauth/login" method="post" id="loginLogAuth">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="emailLogAuth" placeholder="Your email address...">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="passwordLogAuth" placeholder="Your password...">
                        </div>
                        <div class="form-group text-left">
                            <div class="icheck-secondary">
                                <input type="checkbox" name="remember" id="rememberLogAuth" checked >
                                <label for="remember">
                                    Nhớ đăng nhập
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-round">Đăng nhập</button>
                    </form>

                    <div class="text-center text-muted delimiter m-2">Đăng nhập bằng mạng xã hội</div>
                    <div class="d-flex justify-content-center social-buttons">
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google"><i class="fab fa-google"></i></a>
                        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="{{ url('/auth/redirect/zalo') }}" class="btn btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fab fa-zalo"></i>
                            <img src="public/home/image/zalo.svg" alt="" width="18px">
                        </a>
                        {{-- <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter"> <i class="fab fa-twitter"></i> </button> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Chưa là thành viên? <a href="logauth/signup" class="text-info" > Đăng ký</a>.</div>
            </div>
        </div>
        
    </div>
</div>