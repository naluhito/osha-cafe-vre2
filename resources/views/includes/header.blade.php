<div class="" id="l-header">
        <div class="container">
            <nav class="navbar">
                <a class="navbar-brand" href="https://oshi-cafe.com">
                    <span class="fz-12 d-block">オリジナルドリップバッグ工房</span>
                    <span class="d-block"><img src="https://oshi-cafe.com/img/SVG/logo-name.svg" alt="オリジナルドリップバッグ工房 Oshi Cafe Factory 推しカフェファクトリー" class=""></span>
                    <span class="fz-10 d-block">推しカフェファクトリー</span>
                </a>
                <div class="ml-sm-auto pl-16 pl-sm-0 fz-12 fz-md-14">
                    @auth
                    <a href="#" class="text-cha">
                        <span class="pr-md-16 fz-14 fz-md-18">{{ Auth::user()->name }}</span>
                    </a>
                    <br class="d-md-none">
                    @endauth
                    <a href="basket" class="text-cha" style="position: relative;">
                        <i class="fas fa-shopping-cart d-block text-center d-md-inline fz-18 fz-20 mr-md-24 mt-8 mt-md-0" aria-hidden="true"></i>
                        <span id="badge" class="badge badge-hoge badge-mark" style="position: absolute; top: -8px; left: 9px;"></span>
                    </a>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#gnav" aria-controls="gnav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="gnav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-originaldripbag">オリジナルドリップバッグ</a></li>
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-flow">購入の流れ</a></li>
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-price">料金について</a></li>
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-delivery">納期について</a></li>
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-payment">支払い・発送方法</a></li>
                        <li class="nav-item"><a class="nav-link pagelink" href="https://oshi-cafe.com#l-other">その他</a></li>
                        @auth
                        <li class="nav-item"><a class="nav-link pagelink" href="#">マイページ</a></li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </div>
