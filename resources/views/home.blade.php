@extends('layouts.app')

@section('content')
    @push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card border-info" style="width: 18rem;">
                <div class="card-header">{{ __('User profile') }}</div>

                @if ($current_user->role === 0)
                    <img src="{{asset('images/admin.jpg')}}" class="card-img-top" alt="admin">
                @elseif ($current_user->role === 1)
                    <img src="{{asset('images/teacher.jpg')}}" class="card-img-top" alt="teacher">
                @else
                    <img src="{{asset('images/student.jpg')}}" class="card-img-top" alt="student">
                @endif

                <div class="card-body">
                    @if ($current_user->role === 0)
                        <h4 class="card-title fw-bold">{{ __('Admin') }}</h4>
                    @elseif ($current_user->role === 1)
                        <h4 class="card-title fw-bold">{{ __('Teacher') }}</h4>
                    @else
                        <h4 class="card-title fw-bold">{{ __('Student') }}</h4>
                    @endif
                    <p class="card-text fst-italic">{{$current_user->name}}</p>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item alert-success">{{ __('Some info about:') }} : {{$current_user->about}}</li>
                    <li class="list-group-item alert-success">{{ __('Approved:') }} <input type="checkbox" aria-label="" @if ($current_user->approved == true) checked @endif></li>
                </ul>
            </div>
        </div>

        @if ($current_user->role === 1 and $current_user->approved == true)
        <div class="col-md-9">
            <div class="card border-info">
                <div class="card-header">{{ __('Consultation editor') }}</div>

                <form method="POST" action="{{ route('consultations.store') }}">
                    @csrf

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row mb-8">
                            <label for="info" class="col-md-2 col-form-label text-md">{{ __('Info') }}</label>

                            <div class="col-md-10">
                                <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ old('info') }}" required autocomplete="info" autofocus>

                                @error('info')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row mb-8">
                            <div class="input-group mb-8">
                                <label for="link" class="col-md-2 col-form-label text-md">{{ __('Link') }}</label>
                                <span class="input-group-text" id="linkmsg">https://</span>
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" required autocomplete="link">

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row mb-8">
                            <label for="subject" class="col-md-2 col-form-label text-md">{{ __('Subject') }}</label>

                            <div class="col-md-4">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject">

                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="type" class="col-md-2 col-form-label text-md">{{ __('Type of meeting') }}</label>

                            <div class="col-md-4">
                                <select name="type" id="type" class="form-select" aria-label="Select type">
                                    <option value="Just consulting">{{ __('Just consulting') }}</option>
                                    <option value="Tests consultation">{{ __('Tests consultation') }}</option>
                                    <option value="Exam consultation">{{ __('Exam consultation') }}</option>
                                    <option value="Course projects">{{ __('Course projects') }}</option>
                                    <option value="For work at labs">{{ __('For work at labs') }}</option>
                                </select>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row mb-8">
                            <div class="col-md-4">
                                <label for="date_and_time" class="col-md-4 col-form-label text-md-end">{{ __('Date and time') }}</label>
                                <input type="datetime-local" class="form-control" name="date_and_time">
                            </div>

                            <div class="col-md-5 d-flex justify-content-end">
                                <img src="{{asset('images/meeting.jpg')}}" class="img-fluid rounded" alt="meeting">
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">

                    </li>
                </ul>

                <div class="card-body">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add consultation') }}
                    </button>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                </form>
            </div>
        </div>
        @endif

        @if ($current_user->role === 0)
        <div class="col-md-9">
            <div class="card border-info">
                <div class="card-header">{{ __('Users table') }}</div>

                <table class="table table-sm table-hover border-info">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="th-sm">{{ __('Name') }}</th>
                        <th class="th-sm">{{ __('Role') }}</th>
                        <th class="th-sm">{{ __('Ap') }}</th>
                        <th class="th-sm">{{ __('Email') }}</th>
                        <th class="th-sm">{{ __('About') }}</th>
                        <th class="th-sm">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                @if ($user->role === 0)
                                    <div class="bg-danger text-white">{{ __('Admin') }}</div>
                                @elseif ($user->role === 1)
                                    <div class="bg-info text-dark">{{ __('Teacher') }}</div>
                                @else
                                    {{ __('Student') }}
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" aria-label="" @if ($user->approved == true) checked @endif>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->about}}</td>
                            <td>
                                <form id="ms_patch" method="post" action="{{ route('home.approve', $user->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
                                        <button type="button" class="btn btn-white disabled">&nbsp;</button>
                                        <a type="button" onclick="sendLink(this)" href="{{ route('home.destroy', $user->id)}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWindow">{{ __('Delete') }}</a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

    @component('components.delete')
    @endcomponent

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            const flatpickr = require("flatpickr");
            flatpickr("input[type=datetime-local]", { enableTime: true, dateFormat: "Y-m-d H:i", inline: true,});
            function sendLink(id) {
                document.getElementById("ms_receive").action = id.href;
                console.log(id.href);
                document.getElementById("ms_num").innerHTML = (id.href).split('/').reverse()[0];
            }
        </script>
    @endpush
@endsection
