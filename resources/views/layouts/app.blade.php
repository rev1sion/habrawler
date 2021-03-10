<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--Title and Meta--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    {{--    @meta--}}

    {{--Common App Styles--}}
    {{--    {{ Html::style(mix('css/app.css')) }}--}}

    {{--Styles--}}
    @yield('styles')

    {{--Head--}}
    @yield('head')

</head>
<body class="@yield('body_class')">

<div class="container body">
    <div class="main_container">
        {{--        @section('header')--}}
        {{--            @include('sections.navigation')--}}
        {{--            @include('sections.header')--}}
        {{--        @show--}}

        @yield('left-sidebar')

        <div class="main_col">
            <div class="page-title">
                <div class="title_left">
                    <h1 class="h3">@yield('title')</h1>
                </div>
                {{--                @if(Breadcrumbs::exists())--}}
                {{--                    <div class="title_right">--}}
                {{--                        <div class="pull-right">--}}
                {{--                            {!! Breadcrumbs::render() !!}--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
            </div>
            @yield('content')
        </div>

        <footer>
            {{--            @include('sections.footer')--}}
        </footer>
    </div>
</div>
{{--@stop--}}

@section('styles')
    {{--    {{ Html::style(mix('assets/admin/css/admin.css')) }}--}}
@endsection

@section('scripts')
    {{--    {{ Html::script(mix('assets/admin/js/admin.js')) }}--}}
@endsection

{{--Common Scripts--}}
{{--{{ Html::script(mix('assets/app/js/app.js')) }}--}}

{{--Laravel Js Variables--}}
{{--@tojs--}}

{{--Scripts--}}
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@yield('scripts')
</body>
</html>
