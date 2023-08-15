@extends('dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Compose Email</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('send-email') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="to">To:</label>
                        <input type="text" class="form-control" id="to" name="to" value="{{ implode(',', $toEmails) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="attachment">Attachment:</label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment">
                    </div>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
