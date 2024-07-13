<html lang="ru" data-controller="html-load" dir="ltr"><head><style type="text/css">.turbo-progress-bar {
            position: fixed;
            display: block;
            top: 0;
            left: 0;
            height: 3px;
            background: #0076ff;
            z-index: 2147483647;
            transition:
                width 300ms ease-out,
                opacity 150ms 150ms ease-in;
            transform: translate3d(0, 0, 0);
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <title>
        Войдите в свою учетную запись                    - Laravel
    </title>
    <meta name="csrf_token" content="Lxgl9uWBJafcBXJlRvJ5U1VWVtyzm7Lk3wgTvW6I" id="csrf_token">
    <meta name="auth" content="" id="auth">
    <link rel="stylesheet" type="text/css" href="/vendor/orchid/css/orchid.css?id=a6c98500647ed07d202417322f2c342c">


    <meta name="view-transition" content="same-origin">
    <meta name="turbo-root" content="/admin">
    <meta name="turbo-refresh-method" content="replace">
    <meta name="turbo-refresh-scroll" content="reset">
    <meta name="turbo-prefetch" content="true">
    <meta name="dashboard-prefix" content="/admin">


    <script src="/vendor/orchid/js/manifest.js?id=a0cf0beb2ef26ed536c04092e6558f2a" type="text/javascript"></script><script charset="utf-8" src="chrome-extension://oakbcaafbicdddpdlhbchhpblmhefngh/dist/ruffle.js?id=28990954407"></script>
    <script src="/vendor/orchid/js/vendor.js?id=7ce0714114f727695cb0f94abb0e035e" type="text/javascript"></script>
    <script src="/vendor/orchid/js/orchid.js?id=930568a98389e92b855f0994a950cb6b" type="text/javascript"></script><style type="text/css">.chart-container{position:relative;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen,Ubuntu,Cantarell,Fira Sans,Droid Sans,Helvetica Neue,sans-serif}.chart-container .axis,.chart-container .chart-label{fill:#555b51}.chart-container .axis line,.chart-container .chart-label line{stroke:#dadada}.chart-container .dataset-units circle{stroke:#fff;stroke-width:2}.chart-container .dataset-units path{fill:none;stroke-opacity:1;stroke-width:2px}.chart-container .dataset-path{stroke-width:2px}.chart-container .path-group path{fill:none;stroke-opacity:1;stroke-width:2px}.chart-container line.dashed{stroke-dasharray:5,3}.chart-container .axis-line .specific-value{text-anchor:start}.chart-container .axis-line .y-line{text-anchor:end}.chart-container .axis-line .x-line{text-anchor:middle}.chart-container .legend-dataset-text{fill:#6c7680;font-weight:600}.graph-svg-tip{position:absolute;z-index:99999;padding:10px;font-size:12px;color:#959da5;text-align:center;background:rgba(0,0,0,.8);border-radius:3px}.graph-svg-tip ol,.graph-svg-tip ul{padding-left:0;display:-webkit-box;display:-ms-flexbox;display:flex}.graph-svg-tip ul.data-point-list li{min-width:90px;-webkit-box-flex:1;-ms-flex:1;flex:1;font-weight:600}.graph-svg-tip strong{color:#dfe2e5;font-weight:600}.graph-svg-tip .svg-pointer{position:absolute;height:5px;margin:0 0 0 -5px;content:" ";border:5px solid transparent;border-top-color:rgba(0,0,0,.8)}.graph-svg-tip.comparison{padding:0;text-align:left;pointer-events:none}.graph-svg-tip.comparison .title{display:block;padding:10px;margin:0;font-weight:600;line-height:1;pointer-events:none}.graph-svg-tip.comparison ul{margin:0;white-space:nowrap;list-style:none}.graph-svg-tip.comparison li{display:inline-block;padding:5px 10px}</style>




</head>

<body class="page-platform-login" data-controller="pull-to-refresh">

<div class="container-fluid" data-controller="">

    <div class="row justify-content-center d-md-flex h-100">

        <div class="col-xxl col-xl-9 col-12">

            <div class="container-md">
                <div class="form-signin h-full min-vh-100 d-flex flex-column justify-content-center">

                    <a class="d-flex justify-content-center mb-4 p-0 px-sm-5" href="/admin">
                        <link rel="preload" as="style" href="http://localhost/build/assets/styles-Dw1hhHUf.css"><link rel="stylesheet" href="http://localhost/build/assets/styles-Dw1hhHUf.css">
                        <h2 style="font-weight: 500;"><p style="color:#376AF7;margin-bottom: -7px;">SKY</p> ALLIANCE</h2>
                    </a>

                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-5 col-xxl-5 px-md-5">

                            <div class="bg-white p-4 p-sm-5 rounded shadow-sm">
                                <h1 class="h4 text-black mb-4">Войдите в свою учетную запись</h1>

                                <form class="m-t-md" role="form" method="POST" data-controller="form" data-form-need-prevents-form-abandonment-value="false" data-action="form#submit" action="http://localhost/admin/login">
                                    <input type="hidden" name="_token" value="Lxgl9uWBJafcBXJlRvJ5U1VWVtyzm7Lk3wgTvW6I" autocomplete="off">
                                    <div class="mb-3">

                                        <label class="form-label">
                                            Адрес электронной почты
                                        </label>

                                        <div class="form-group">

                                            <div data-controller="input" data-input-mask="">
                                                <input class="form-control" name="email" type="email" required="required" tabindex="1" autofocus="autofocus" autocomplete="email" inputmode="email" placeholder="Введите ваш адрес электронной почты" id="field-email-0846911c6f1d29776637b3f0ed9b1deb39cb43cd">
                                            </div>

                                        </div>


                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label w-100">
                                            Пароль
                                        </label>

                                        <div class="form-group">

                                            <div data-controller="password" class="input-icon">
                                                <input type="password" class="form-control" name="password" required="required" autocomplete="current-password" tabindex="2" placeholder="Введите ваш пароль" id="field-password-a3e433c8df91dfe0bd6414d499fc5fdda380bc4e" data-password-target="password">
                                                <div class="input-icon-addon cursor" data-action="click->password#change">

            <span data-password-target="iconShow">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="small me-2" viewBox="0 0 16 16" role="img" id="field-password-a3e433c8df91dfe0bd6414d499fc5fdda380bc4e" path="bs.eye" componentname="orchid-icon">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"></path>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"></path>
</svg>

            </span>

                                                    <span data-password-target="iconLock" class="none">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="small me-2" viewBox="0 0 16 16" role="img" id="field-password-a3e433c8df91dfe0bd6414d499fc5fdda380bc4e" path="bs.eye-slash" componentname="orchid-icon">
  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"></path>
  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"></path>
  <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"></path>
</svg>

            </span>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-xs-12">
                                            <label class="form-check">
                                                <input type="hidden" name="remember">
                                                <input type="checkbox" name="remember" value="true" class="form-check-input" checked="">
                                                <span class="form-check-label"> Запомнить меня</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="small me-2" viewBox="0 0 16 16" role="img" path="bs.box-arrow-in-right" componentname="orchid-icon">
                                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"></path>
                                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"></path>
                                                </svg>

                                                Логин
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="m-4 text-center text-muted">
                        <p>Crafted with

                            <span title="Love from Lipetsk">
            <svg height="1.5em" width="1.5em" class="text-success" fill="currentColor" role="img" viewBox="0 0 44.07 52.31" xmlns="http://www.w3.org/2000/svg">
                <path d="m33.39 33.23c-1.48 1.03-2.83 2.2-4.06 3.52-.23.25-.41.8-.77.63-.38-.18.04-.64 0-1.12-2.09 1.39-3.66 3.21-5.36 5.04v-1.04c-2.14 1.43-4.59 2.12-5.98 4.33l-.1-.77-.22-.14c-2.22 2.74-5.49 4.65-6.41 8.63-.25-4.49-1.24-8.58-3.2-12.5l-.64.84c-.05-1.68-.47-3.07-1.15-4.42l-.58.94c-.31-1.09-.25-2.12-.57-3.07-.09-.26-.21-.54-.25-.84-.08-.5-.27-.97-.94-.36-.04-2.33-.87-4.43-1-6.68-.46.18-.5.77-1.04.79.16-2-.3-3.96-.34-6.08l-.44.89-.25-.17c-.1-.8 0-1.59.09-2.39.12-.93.22-1.87.31-2.81.03-.34.43-.84-.38-.85-.2 0-.12-.25-.07-.44.5-1.91.98-3.81 2.06-5.51 2.05-3.22 6.97-7.12 12.11-5.87 2.35.57 4.24 1.8 5.33 4.05.14.3.26.62.31.94.04.23-.03.56.25.58.27.01.31-.34.38-.56.73-2.42 1.44-4.84 2.58-7.11.18-.35.33-.73.56-1.04.18-.25.26-.72.66-.63.41.09.79.33.99.75.22.44-.1.71-.36.94-2.22 2.04-2.98 4.83-3.96 7.53.89-.91 1.63-1.94 2.6-2.76 3.63-3.08 7.69-4.2 12.22-2.46 4.06 1.56 6.51 4.63 7.73 8.78.91 3.11.62 6.13-.37 9.15-.31.95-.51 1.94-.77 2.91-.08.31-.07.72-.62.57-.11-.03-.35.17-.41.31-.66 1.45-1.83 2.57-2.57 3.97-.16.31-.28.64-.51 1.19l-.14-1.38c-1.41 1.8-3.43 2.87-4.69 4.73-.47-.42.06-.7-.06-1.01h.04l-.02-.02zm-14.81-16.07c-.56.3-.52.91-.68 1.4-.17.52-.33.82-.99.55-.99-.39-2.06-.56-3.12-.63-1.24-.09-2.5-.12-3.67.45.34.04.67.03 1.01 0 1.88-.16 3.7.15 5.46.8.54.2.82.43.59 1.14-.53 1.7-.94 3.44-1.38 5.17-.13.53-.34.78-.95.87-1.55.23-3.1.53-4.52 1.57 1.82.06 3.27-1.35 5.01-.89-.4 2.1-.78 4.15-1.18 6.2-.08.41-.15.86-.71.93-.22.03-.24.23-.11.33.55.43.29.97.2 1.46-.27 1.51-.58 3.02-.87 4.53.3-.38.52-.79.57-1.22.06-.5.3-.91.44-1.37.58-2.05.6-2.05 2.14-.47.08-.73-.49-1.01-.88-1.39-.24-.23-.57-.36-.49-.79.36-2.06.71-4.12 1.05-6.18.08-.46.27-.49.73-.43 1.03.12 1.79.76 2.88 1.34-.79-1.08-1.61-1.55-2.67-1.67-.63-.07-.92-.26-.63-1.06.49-1.37.93-2.8 1.05-4.23.1-1.14.67-1.16 1.46-1.2 1.04-.05 2.06.1 3.1.14-1.03-.51-2.13-.64-3.24-.55-.62.05-.78-.08-.6-.75.36-1.34.89-2.65 1-4.06.47.09.82-.18 1.18-.39 1.04-.57 2.12-1.04 3.24-1.44 1.66-.6 3.39-.91 5.12-1.21-3.28-.24-6.2.95-9.14 2.39.23-1.53.96-2.81.93-4.26-.53.74-.28 1.76-.94 2.48-1.17-2.34-2.55-4.46-4.98-5.64 2.52 2.14 4.78 4.4 4.61 8.09zm-7.69 18.99c.65-.06 1.09-.32 1.68-.72-.76-.01-1.17.34-1.68.72z"></path>
            </svg>
        </span>

                            by Alexandr Chernyaev</p>
                    </div>

                    <p class="small text-center mb-1 px-5">
                        Код приложения публикуется под лицензией MIT.
                    </p>

                    <ul class="nav justify-content-center mb-5">
                        <li class="nav-item"><a href="https://orchid.software" class="nav-link px-2 text-muted">Documentation</a></li>
                        <li class="nav-item"><a href="https://github.com/orchidsoftware/platform/discussions" target="_blank" class="nav-link px-2 text-muted">Discussions</a></li>
                        <li class="nav-item"><a href="https://opencollective.com/orchid" target="_blank" class="nav-link px-2 text-muted">Donation</a></li>
                        <li class="nav-item"><a href="https://orchid.software/en/hig/" target="_blank" class="nav-link px-2 text-muted">Design</a></li>
                        <li class="nav-item"><a href="https://github.com/orchidsoftware" target="_blank" class="nav-link px-2 text-muted">GitHub</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <div class="toast-wrapper" data-controller="toast">
        <template id="toast">
            <div class="toast rounded shadow-sm bg-white mb-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true">
                <div class="toast-body p-3 d-flex">
                    <p class="mb-0">
                    <span class="text-{type}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="me-2" viewBox="0 0 16 16" role="img" path="bs.circle-fill" componentname="orchid-icon">
  <circle cx="8" cy="8" r="8"></circle>
</svg>

                    </span>
                        {message}
                    </p>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </template>



    </div>


</div>





</body></html>
