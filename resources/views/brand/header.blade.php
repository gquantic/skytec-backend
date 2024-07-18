@vite([
    'resources/scss/styles.scss'
])

<img src="/img/logo-white.png" alt="">


@push('head')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            if ($('.ckeditor').length) {
                $('.ckeditor').each(function() {
                    CKEDITOR.replace($(this).attr('id'));
                });
            }
        });
    </script>

    <link
        rel="stylesheet"
        data-purpose="Layout StyleSheet"
        title="Web Awesome"
        href="/css/app-wa-a60ddbceb7292f11c9e430d067b1eb9f.css?vsn=d"
    >

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css"
    >

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css"
    >

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css"
    >

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css"
    >

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css"
    >

    <style lang="scss">
        :root {
            --bs-primary-rgb: 0, 174, 239;
        }

        .nav-tabs-alt .nav-tabs .nav-item .nav-link.active {
            border-bottom-color: rgb(var(--bs-primary-rgb)) !important;
        }

        .top-logo-block {
            text-align: center;
            width: fit-content;
            margin: 20px auto 20px auto;
        }
        .top-logo {
            font-size: 25px;
            color: #00aeef;
            font-weight: 600;
            display: block;
        }
        .top-logo span {
            color: rgba(0,0,0,.05);
            font-size: 12px;
        }


        [data-controller="input"] * {
            width: 100%;
            max-width: 100%;
        }

        textarea.form-control {
            width: 100%;
            max-width: 100%;
        }

        .nav-tabs-alt {
            margin-bottom: 15px;
        }

        .nav-tabs-alt ul {
            border-bottom: none;
        }

        .fields-picture-container {
            text-align: left;
        }

        .fields-picture-container img {
            width: 150px;
        }

        .form-group .form-text.text-muted {
            position: relative;
            top: 5px;
        }

        .cke_bottom {
            background: #2b579a !important;
            color: #fff !important;
        }
        .cke_resizer {
            border-color: transparent #ffffff transparent transparent !important;
        }
        a.cke_path_item, span.cke_path_empty {
            color: #fff !important;
        }
        .bg-white a:hover, .dropzone .dz-preview a:hover, .dropzone-wrapper .dz-preview a:hover, .editor-preview-side a:hover, .layout a:hover {
            color: #000 !important;
        }

        .check {
            border-radius: 5px;
            width: 2px;
            height: 2px;
            border: 3px solid rgb(128, 128, 128);
            margin: 0 auto;

            &.check-1 {
                border: 3px solid #5dd41b;
            }
        }
    </style>
@endpush
