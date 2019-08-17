<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Social Links</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label for="social_facebook" class="control-label">Facebook Profile</label>
                <input class="form-control" type="text" name="social_facebook" id="social_facebook" placeholder="Enter facebook profile link" value="{{ config('settings.social_facebook') }}">
            </div>
            <div class="form-group">
                <label for="social_twitter" class="control-label">Twitter Profile</label>
                <input class="form-control" type="text" name="social_twitter" id="social_twitter" placeholder="Enter Twitter profile link" value="{{ config('settings.social_twitter') }}">
            </div>
            <div class="form-group">
                <label for="social_instagram" class="control-label">Instagram Profile</label>
                <input class="form-control" type="text" name="social_instagram" id="social_instagram" placeholder="Enter Instagram profile link" value="{{ config('settings.social_instagram') }}">
            </div>
            <div class="form-group">
                <label for="social_facebook" class="control-label">Linkedin Profile</label>
                <input class="form-control" type="text" name="social_linkedin" id="social_linkedin" placeholder="Enter Linkedin profile link" value="{{ config('settings.social_linkedin') }}">
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        Update Settings
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
