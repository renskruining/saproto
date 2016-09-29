<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no"/>

    <meta name="theme-color" content="#C1FF00">

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Can you work in the SmartXP?"/>
    <meta property="og:description"
          content="Do you want to know if the SmartXP is available for working? Check the SmartXP timetable here!"/>
    <meta property="og:url" content="https://www.caniworkintheSmartXP.nl/"/>
    <meta property="og:image" content="{{ asset('images/subsites/smartxp.jpg') }}"/>

    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon'.mt_rand(1, 4).'.png') }}"/>

    <title>Can I work in the SmartXP?</title>

    @include('website.layouts.assets.stylesheets')

    <style type="text/css">

        * {
            box-sizing: border-box;
        }

        html, body {
            font-family: Lato, sans-serif;

            position: absolute;

            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;

            background-color: #555;
        }

        .container-fluid, .row, .col-md-2, .col-md-12 {
            height: 100%;
        }

        .box {
            position: relative;

            background-color: rgba(0, 0, 0, 0.5);
            border-bottom: 5px solid #c1ff00;
            box-shadow: 0 0 20px -7px #000;

            overflow: auto;
        }

        .box-header {
            font-size: 30px;
            font-weight: bold;

            color: #fff;

            text-align: center;

            padding: 15px 0;
            margin: 0 40px;
            border-bottom: 2px solid #fff;
        }

        .box-header.small {
            font-size: 20px;

            margin: 0px 10px;
        }

        .notice {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            color: #fff;
        }

        .activity {
            width: 100%;

            color: #fff;

            text-align: left;

            padding: 20px 40px;

            font-size: 20px;
        }

        .activity:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .activity.past {
            opacity: 0.5;
        }

        .activity.current {
            background-image: repeating-linear-gradient(-45deg, transparent, transparent 10px, #333 10px, #333 20px);
        }

    </style>

</head>

<body>

<div class="container-fluid">

    <div class="row" style="height: 10%;">

        <div class="box-header">
            The SmartXP timetable for this week:
        </div>

    </div>

    <div class="row" style="height: 60%;">

        @foreach($timetable as $dayname => $day)

            <div class="col-md-2">

                <div class="box" style="height: 100%;">

                    <div class="box-header">

                        {{ ucfirst($dayname) }}

                    </div>

                    <div id="timetable">

                        @if(count($day) > 0)
                            @foreach($day as $activity)
                                <div class="activity {{ ($activity->current ? 'current' : ($activity->over ? 'past' : '')) }}">
                                    {{ date('H:i', $activity->start) }} - {{ date('H:i', $activity->end) }}<br>
                                    <strong>{{ $activity->title }}</strong> ({{ $activity->type }})
                                </div>
                            @endforeach
                        @else
                            <div class="notice">Nothing!</div>
                        @endif

                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <div class="row" style="height: 30%;">

        <div class="col-md-12" style="text-align: center;">

            <a href="https://www.proto.utwente.nl/">
                <img src="{{ asset('images/logo/inverse.png') }}" style="max-height: 50%; margin-top: 80px;">
            </a>

        </div>

    </div>

</div>

@section('javascript')
    @include('website.layouts.assets.javascripts')
@show

</body>

</html>
