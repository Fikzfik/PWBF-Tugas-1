@extends('app', ['page' => 'messageview'])
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

                <!-- Tampilkan dokumen jika ada -->
                {{-- @dd($message); --}}
                @if ($message->dokumen->count() > 0)
                    <div class="mb-3">
                        <strong>Attached Documents:</strong>
                        <ul>
                            @foreach ($message->dokumen as $dokumen)
                                <li>
                                    @if (in_array(pathinfo($dokumen->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <!-- Jika file adalah gambar, tampilkan gambar -->
                                        <img src="{{ Storage::url($dokumen->file) }}"
                                            alt="{{ $dokumen->description ?? 'Attached Image' }}"
                                            style="max-width: 200px; max-height: 200px;" />
                                    @else
                                        <!-- Jika bukan gambar, tampilkan link untuk mengunduh -->
                                        <a href="{{ Storage::url($dokumen->file) }}" target="_blank">
                                            {{ $dokumen->description ?? 'Download File' }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <!-- Tombol Action -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mailbox.index') }}" class="btn btn-light">Back to Mailbox</a>
                    <a href="{{ route('message.compose', ['to' => $message->massage_reference, 'subject' => 'Re: ' . $message->subject]) }}"
                        class="btn btn-primary">Reply</a>
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
