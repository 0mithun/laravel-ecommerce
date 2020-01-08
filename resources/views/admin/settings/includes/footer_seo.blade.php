<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Footer &amp; SEO</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label for="footer_copyright_text" class="control-label">Footer Copyright</label>
                <input type="text" class="form-control" name="footer_copyright_text" id="footer_copyright_text" value="{{ config('settings.footer_copyright_text') }}" placeholder="Enter footer copyright text">
            </div>
            <div class="form-group">
                <label for="seo_meta_title" class="control-label">SEO Meta Title</label>
                <input type="text" class="form-control" name="seo_meta_title" id="seo_meta_title" value="{{ config('settings.seo_meta_title') }}" placeholder="Enter SEO meta title ">
            </div>seo_meta_title
            <div class="form-group">
                <label for="seo_meta_description" class="control-label">SEO Meta Description</label>
                    <textarea rows="5" class="form-control" name="seo_meta_description" id="seo_meta_description" placeholder="Enter SEO meta description ">{!! config('settings.seo_meta_description') !!}</textarea>
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
