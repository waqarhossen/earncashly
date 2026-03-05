
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>{{$offer->title}}</title>
    <link rel="icon" type="image/png" href="images/favicon.png" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Javascript Assets -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
      rel="stylesheet"
    />
  </head>
  <body x-data class="is-header-blur bg-slate-50" x-bind="$store.global.documentBody" style="height:100%;">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50">

    <div
    class="spinner is-elastic h-7 w-7 animate-spin rounded-full border-[3px] border-slate-150 border-r-error dark:border-navy-500 dark:border-r-navy-300"
    ></div>

    </div>

    <style>
    .opnv{
    border-radius: 0;
    height: 60px;
    display: flex;
    gap: 5px;
    align-items: center;
    padding-right: 5px;
    padding-left: 10px;
    }
    .backof{font-size:21px; }
    .hd{
        background: #1d1e30;
        border-color: #292b43;
    }
    </style>

    <div class="h-10 b-0 opnv bg-white dark:bg-navy-750 border-b dark:border-navy-700 border-slate-200 hd">
    <div class="opnv-se">
    <a href="{{url('/')}}" class="closeBtn backof btn mr-1 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    </div>
    <a href="{{url('/')}}">
        <img
          class="h-8"
          src="{{asset('images/app/logonew.svg')}}"
          alt="logo"
        />
      </a>
    </div>

    <iframe class="offeriframe" loading="lazy" src="{{ $offer->slug }}"></iframe>

    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
    <script type="text/javascript">
        document.body.innerHTML
        = document.body.innerHTML
        .replaceAll("USERID", "{{Auth::user()->id}}");
        </script>
  </body>
</html>
