<!-- Title -->
<title> @yield('title') </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/images/fav.png')}}" type="image/x-icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link href="{{URL::asset('assets/css/main.min.css')}}" rel="stylesheet">

<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet"/>

<link href="{{URL::asset('assets/css/color.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{URL::asset('assets/css/responsive.css')}}">

@yield('css')

@livewireStyles
