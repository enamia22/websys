@extends('layouts.app')

@section('content')
        <div class="container">

            <br>

            <div class="row justify-content-center title">
                {{ __('List of consultations:') }}
            </div>

            <br>

            <form id="searchform" method="GET" action="{{ route('consultations.search') }}">
                @csrf
                <div class="row">
                        <button type="submit" class="btn btn-info border-success col-md-1">{{ __('Search') }}</button>
                    <div class="col-md-4">
                        <input id="search" type="text" class="form-control @error('search') is-invalid @enderror" name="search" value="">
                    </div>
                </div>
            </form>

            <br>

            <table class="table table-hover border-info">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="th-sm">{{ __('Teacher') }}</th>
                    <th class="th-sm">{{ __('Subject') }}</th>
                    <th class="th-sm">{{ __('Time and Data') }}</th>
                    <th class="th-sm">{{ __('Consultation type') }}</th>
                    <th class="th-lg">{{ __('Info') }}</th>
                    <th class="th-lg">{{ __('Link') }}</th>
                    <th class="th-sm">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($lists as $list)
                    @if ($role === 1 && Auth::user()->id === $list->user_id)
                        <tr class="table-info">
                    @else
                        <tr>
                    @endif
                        <td>{{$list->id}}</td>
                        <td>{{$list->user->name}}</td>
                        <td>{{$list->subject}}</td>
                        <td>{{Carbon\Carbon::parse($list->date_and_time)->format('h:i l jS \of F')}}</td>
                        <td>{{$list->type}}</td>
                        <td>{{$list->info}}</td>
                            @auth
                                <td>
                                    <a id="ms_{{$list->id}}" href="{{$list->link}}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$list->link}}</a>
                                </td>
                            @endauth
                            @guest
                                <td>{{ __('Not available for unregistered users') }}</td>
                            @endguest

                        @if ($role === 0)
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    <button type="button" onclick="copyClip('{{$list->link}}')" class="btn btn-primary">{{ __('Cp') }}</button>
                                    <button type="button" class="btn btn-white disabled">&nbsp;</button>
                                    <a type="button" onclick="sendLink(this)" href="{{ route('consultations.destroy', $list->id)}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWindow">{{ __('Del') }}</a>
                                </div>
                            </td>
                        @elseif ($role === 1 && Auth::user()->id === $list->user_id)
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    <button type="button" onclick="copyClip('{{$list->link}}')" class="btn btn-primary">{{ __('Cp') }}</button>
                                    <button type="button" class="btn btn-white disabled">&nbsp;</button>
                                    <a type="button" onclick="sendLink(this)" href="{{ route('consultations.destroy', $list->id)}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWindow">{{ __('Del') }}</a>
                                </div>
                            </td>
                        @else
                            @auth
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <button type="button" onclick="copyClip('{{$list->link}}')" class="btn btn-primary">{{ __('Cp') }}</button>
                                        <button type="button" class="btn btn-white disabled">&nbsp;</button>
                                        <button type="button" class="btn btn-white disabled">{{ __('Del') }}</button>
                                    </div>
                                </td>
                            @endauth
                            @guest
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <button type="button" class="btn btn-white disabled">{{ __('Cp') }}</button>
                                        <button type="button" class="btn btn-white disabled">&nbsp;</button>
                                        <button type="button" class="btn btn-white disabled">{{ __('Del') }}</button>
                                    </div>
                                </td>
                            @endguest
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
               <div class="d-flex justify-content-center">
                     {{ $lists->links() }}
               </div>
        </div>

    @component('components.delete')
    @endcomponent

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function copyClip(link) {
                navigator.clipboard.writeText(link);
                console.log(link);
            }
            function sendLink(id) {
                document.getElementById("ms_receive").action = id.href;
                console.log(id.href);
                document.getElementById("ms_num").innerHTML = (id.href).split('/').reverse()[0];
            }
        </script>
    @endpush
@endsection