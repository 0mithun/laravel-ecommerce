<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
            <h3 class="tile-title">Analytics</h3>
            <hr>
        <div class="tile-body">
            <div class="form-group">
                <label for="google_analytics" class="control-label">Google Analytics</label>
                <textarea name="google_analytics" id="google_analytics" cols="30" rows="5" class="form-control" placeholder="Enter google analytics code">{!! Config::get('settings.google_analytics') !!}</textarea>
            </div>
            <div class="form-group">
                <label for="facebook_pixels" class="control-label">Facebook Pixels</label>
                <textarea name="facebook_pixels" id="facebook_pixels" cols="30" rows="5" class="form-control" placeholder="Enter facebook pixels code">{!! Config::get('settings.facebook_pixels') !!}</textarea>
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
