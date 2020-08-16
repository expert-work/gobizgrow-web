
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--begin::Head-->
    <head>
        <base href="../../../">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173081917-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-173081917-1');
        </script>


        <meta charset="utf-8" />
        <title>{{ config('app.name', 'GoBiz Grow') }}</title>
        <meta name="description" content="Login page example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/pages/login/login-1.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{url('theme/html/demo1/dist')}}/assets/plugins/global/plugins.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <link href="{{url('theme/html/demo1/dist')}}/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/style.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/themes/layout/header/base/light.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/themes/layout/header/menu/light.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/themes/layout/brand/dark.css?v=7.0.4" rel="stylesheet" type="text/css" />
        <link href="{{url('theme/html/demo1/dist')}}/assets/css/themes/layout/aside/dark.css?v=7.0.4" rel="stylesheet" type="text/css" />


        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165828808-1"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-165828808-1');
            </script>



        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="{{url('theme/html/demo1/dist')}}/assets/media/logos/favicon.ico" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                    <!--begin::Aside Top-->
                    <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                        <!--begin::Aside header-->
                        <center>
                                <a href="#" class="text-center mb-10">
                                    <img src="{{url('')}}/assets/pages/img/login/login-invert.png" class="max-h-70px" alt="" />
                                </a>
                                <h2 style="    margin-top: 10px;font-size: 14px;font-weight: 800;">Start Your Free Trail!</h2>
                                <!--end::Aside header-->
                                <!--begin::Aside title-->
                                <p style="font-size: 16px;margin-bottom: 5px;">"This app has tripled my income" </p>
                                <i style="line-height: 0;color: #9191a5;">-Mike's Mobile Auto Detailing</i>
                                <p>
                                    <span class="fa fa-star" style=" color: orange;"></span>
                                    <span class="fa fa-star" style=" color: orange;"></span>
                                    <span class="fa fa-star" style=" color: orange;"></span>
                                    <span class="fa fa-star" style=" color: orange;"></span>
                                    <span class="fa fa-star" style=" color: orange;"></span>
                                </p>
                        </center>
                        <!--end::Aside title-->
                    </div>
                    <!--end::Aside Top-->
                    <!--begin::Aside Bottom-->
                    <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{url('theme/html/demo1/dist/')}}/assets/media/svg/illustrations/login-visual-1.svg)"></div>
                    <!--end::Aside Bottom-->
                </div>




                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                    <!--begin::Content body-->
                    <div class="d-flex flex-column-fluid flex-center">
                        <!--begin::Signin-->
                         @yield('content')
                        <!--end::Forgot-->
                    </div>
                    <!--end::Content body-->
                    <!--begin::Content footer-->
                    <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                        <a href="#" class="text-primary font-weight-bolder font-size-h5">Terms</a>
                        <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Plans</a>
                        <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Contact Us</a>
                    </div>
                    <!--end::Content footer-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->
        <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{url('theme/html/demo1/dist')}}/assets/plugins/global/plugins.bundle.js?v=7.0.4"></script>
        <script src="{{url('theme/html/demo1/dist')}}/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4"></script>
        <script src="{{url('theme/html/demo1/dist')}}/assets/js/scripts.bundle.js?v=7.0.4"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{url('theme/html/demo1/dist')}}/assets/js/pages/custom/login/login-general.js?v=7.0.4"></script>
        <!--end::Page Scripts-->
        <script type="text/javascript">
            function show(a) {
  var x=document.getElementById(a);
  var c=x.nextElementSibling
  if (x.getAttribute('type') == "password") {
  c.removeAttribute("class");
  c.setAttribute("class","fas fa-eye");
  x.removeAttribute("type");
    x.setAttribute("type","text");
  } else {
  x.removeAttribute("type");
    x.setAttribute('type','password');
 c.removeAttribute("class");
  c.setAttribute("class","fas fa-eye-slash");
  }
}
        </script>

        <style type="text/css">
           .password_eye {position: absolute;
    margin-top: -40px;
    right: 40px;}
        </style>
    </body>
    <!--end::Body-->
</html>