@extends('app', ['page' => 'compose'])
@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Compose Email</h4>

                <form action="{{ route('mailbox.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="sender">From</label>
                        <input type="email" name="sender" class="form-control" id="sender" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control" id="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" id="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                    <a href="{{ route('mailbox.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
