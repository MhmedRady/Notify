@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="py-12 col-lg-8 m-auto">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <form action="{{route('send.notify')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="notify-body" class="form-label">Notification title</label>
                                            <input type="text" class="form-control" id="notify-body" name="notify_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="notify-body" class="form-label">Notification body</label>
                                            <input type="text" class="form-control" id="notify-body" name="notify_body">
                                        </div>
                                        <button class="btn btn-primary btn-sm fw-bold mt-2">Seb Notify</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: 'api-key',
            authDomain: 'project-id.firebaseapp.com',
            databaseURL: 'https://project-id.firebaseio.com',
            projectId: 'project-id',
            storageBucket: 'project-id.appspot.com',
            messagingSenderId: 'sender-id',
            appId: 'app-id',
            measurementId: 'G-measurement-id',
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        function startFCM() {
            console.log('startFCM')
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    console.log(response)
                }).catch(function (error) {
                alert(error);
            });
        }
        startFCM();
        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
@endpush
