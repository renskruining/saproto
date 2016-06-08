@extends('website.layouts.default-nobg')

@section('page-title')
    {{ $event->title }}
@endsection

@section('content')

    <div class="row vevent">

        <div class="col-md-{{ ($event->activity && $event->activity->participants ? '8' : '8 col-md-offset-2') }}">

            <div class="panel panel-default">

                <div class="panel-heading" style="text-align: center;">{{ $event->title }}</div>

                <div class="panel-body summary" id="event-description">
                    <div class="media">
                        <div class="media-left media-middle">
                            <i class="fa fa-3x fa-calendar-o" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <abbr class="dtstart" title="{{ date('c', $event->start) }}">{{ date('l j F, H:i', $event->start) }}</abbr>
                            </h4>

                            Untill

                            @if (($event->end - $event->start) < 3600 * 24)
                                <abbr class="dtstart" title="{{ date('c', $event->end) }}">{{ date('H:i', $event->end) }}</abbr>
                            @else
                                <abbr class="dtstart" title="{{ date('c', $event->end) }}">{{ date('l j F, H:i', $event->end) }}</abbr>
                            @endif
                        </div>
                    </div>

                    <br>

                    <div class="media">
                        <div class="media-left media-middle">
                            <i class="fa fa-3x fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{ $event->location }}
                            </h4>
                            <a href="https://www.google.nl/maps/search/{{ $event->location }}/">View on Google Maps</a>
                        </div>
                    </div>

                    <hr>

                    {!! $event->description !!}

                </div>

            </div>

            @if($event->activity)

                @foreach($event->activity->helpingCommittees as $key => $committee)

                    @if($key % 2 == 1)

                        <div class="row">

                            @endif

                            <div class="col-md-6">

                                <div class="panel panel-default">

                                    <div class="panel-heading">

                                        {{ $committee->name }}

                                    </div>

                                    <div class="panel-body">

                                        @foreach($event->activity->helpingUsers($committee->pivot->id) as $participation)
                                            <div class="member">
                                                <div class="member-picture"
                                                     style="background-image:url('{{ route("file::get", ['id' => $participation->user->photo]) }}');">
                                                </div>
                                                <a href="{{ route("user::profile", ['id'=>$participation->user->id]) }}">{{ $participation->user->name }}</a>

                                                @if(Auth::user()->can('board'))
                                                    <p class="pull-right activity__admin-controls">
                                                        <a class="activity__admin-controls__button--delete"
                                                           href="{{ route('event::deleteparticipation', ['participation_id' => $participation->id]) }}">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </a>
                                                    </p>
                                                @endif

                                            </div>
                                        @endforeach

                                    </div>

                                    @if($committee->isMember(Auth::user()))

                                        <div class="panel-footer">

                                            @if($event->activity->getHelpingParticipation($committee, Auth::user()) !== null)
                                                <a class="btn btn-warning" style="width: 100%;"
                                                   href="{{ route('event::deleteparticipation', ['participation_id' => $event->activity->getHelpingParticipation($committee, Auth::user())->id]) }}">
                                                    I won't help anymore.
                                                </a>
                                            @else
                                                <a class="btn btn-success" style="width: 100%;"
                                                   href="{{ route('event::addparticipation', ['id' => $event->id, 'helping_committee_id' => $committee->pivot->id]) }}">
                                                    I'll help!
                                                </a>
                                            @endif

                                        </div>

                                    @endif

                                </div>

                            </div>

                            @if($key % 2 === 1)

                        </div>

                    @endif

                @endforeach

            @endif

        </div>

        @if($event->activity && $event->activity->participants)

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        Activity Sign-up
                    </div>

                    <div class="panel-body" id="event-description">
<!-- <<<<<<< HEAD
                        <p>
                            <button type="button" class="btn btn-primary btn-lg btn-block">Join and RSVP &mdash; &euro;{{ $event->activity->price }}</button>
                        </p>

                        <hr>

                        @if (date('U') < $event->activity->registration_start)
                            <p>
                                Open between <abbr class="dtstart" title="{{ date('c', $event->activity->registration_end) }}">{{ date('l j F, H:i', $event->activity->registration_start) }}
                                and <abbr class="dtstart" title="{{ date('c', $event->activity->registration_end) }}">{{ date('l j F, H:i', $event->activity->registration_end) }}</abbr>.

                            </p>
                        @elseif (date('U') < $event->activity->registration_end)
                            <p>
                                Sign-up closes <abbr class="dtstart" title="{{ date('c', $event->activity->registration_end) }}">{{ date('l j F, H:i', $event->activity->registration_end) }}</abbr>.
======= -->

                        @if (date('U') < $event->activity->registration_start)
                            <p style="text-align: center;">
                                Open between {{ date('F d, H:i', $event->activity->registration_start) }}
                                and {{ date('F d, H:i', $event->activity->registration_end) }}.
                            </p>
                        @elseif (date('U') < $event->activity->registration_end)

                            <p>
                                @if($event->activity->getParticipation(Auth::user()) !== null)
                                    <a class="btn btn-warning" style="width: 100%;"
                                       href="{{ route('event::deleteparticipation', ['participation_id' => $event->activity->getParticipation(Auth::user())->id]) }}">
                                        Sign me out. <i class="fa fa-frown-o" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" style="width: 100%;"
                                       href="{{ route('event::addparticipation', ['id' => $event->id]) }}">
                                        Sign me up!
                                    </a>
                                @endif
                            </p>

                            <p style="text-align: center;">
                                Sign-up closes {{ date('F d, H:i', $event->activity->registration_end) }}.
                            </p>
                        @else
                            <p>
                                Sign-up closed.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        Participants
                    </div>

                    <div class="panel-body" id="event-description">

                        <hr>

                        @foreach($event->activity->users as $user)

                            <div class="member">
                                <div class="member-picture"
                                     style="background-image:url('{{ route("file::get", ['id' => $user->photo]) }}');"></div>
                                <a href="{{ route("user::profile", ['id'=>$user->id]) }}">{{ $user->name }}</a>

                                @if(Auth::user()->can('board'))
                                    <p class="pull-right activity__admin-controls">
                                        <a class="activity__admin-controls__button--delete"
                                           href="{{ route('event::deleteparticipation', ['participation_id' => $user->pivot->id]) }}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </p>
                                @endif
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endif

    </div>

@endsection

@section('stylesheet')

    @parent

    <style>

        #event-description {
            text-align: justify;
        }

    </style>

@endsection
