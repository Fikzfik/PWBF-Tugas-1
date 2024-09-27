.@extends('app', ['page' => 'messageview'])
@section('content')
    <div class="col-md-8 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Message Details</h4>

                <div class="mb-3">
                    <strong>From:</strong> {{ $message->massage_reference }}
                </div>

                <div class="mb-3">
                    <strong>Subject:</strong> {{ $message->subject }}
                </div>

                <div class="mb-3">
                    <strong>Received at:</strong> {{ \Carbon\Carbon::parse($message->created_at)->format('d M Y, H:i A') }}
                </div>

                <div class="mb-3">
                    <strong>Message:</strong>
                    <p>{{ $message->text }}</p>
                </div>

                <!-- Tombol Action -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mailbox.index') }}" class="btn btn-light">Back to Mailbox</a>
                    <a href="{{ route('message.compose', ['to' => $message->massage_reference, 'subject' => 'Re: ' . $message->subject]) }}" class="btn btn-primary">Reply</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-body p {
            font-size: 1rem;
            color: #333;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
@endsection
