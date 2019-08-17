<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Payment Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label for="stripe_payment_method" class="control-label">Stripe Payment Method</label>
                <select name="stripe_payment_method" id="stripe_payment_method" class="form-control">
                    <option value="1">{{ config('settings.stripe_payment_method') == 1 ? 'selected' : '' }} Enabled</option>
                    <option value="0">{{ config('settings.stripe_payment_method') == 0 ? 'selected' : '' }} Disabled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stripe_key" class="control-label">Key</label>
                <input type="text" class="form-control" id="stripe_key" name="stripe_key" placeholder="Enter key" value="{{ config('settings.stripe_key') }}">
            </div>
            <div class="form-group pb-2">
                <label for="stripe_secret_key" class="control-label">Secret Key</label>
                <input type="text" class="form-control" id="stripe_secret_key" name="stripe_secret_key" placeholder="Enter Secret key" value="{{ config('settings.stripe_secret_key') }}">
            </div>
            <hr>
            <div class="form-group pt-2">
                <label for="paypal_payment_method" class="control-label">Paypal Payment Method</label>
               <select name="paypal_payment_method" id="" class="form-control">
                    <option value="1">{{ config('settings.paypal_payment_method') == 1 ? 'selected' :'' }} Enabled</option>
                    <option value="0">{{ config('settings.paypal_payment_method') == 0 ? 'selected' : '' }} Disabled</option>
               </select>
            </div>
            <div class="form-group">
                <label for="paypal_client_id" class="control-label">Client ID</label>
                <input type="text" class="form-control" name="paypal_client_id" id="paypal_client_id" value="{{ config('settings.paypal_client_id') }}" placeholder="Enter paypal client ID ">
            </div>
            <div class="form-group">
                <label for="paypal_client_secret" class="control-label">Client Secret</label>
                <input type="text" class="form-control" name="paypal_client_secret" id="paypal_client_secret" value="{{ config('settings.paypal_client_secret') }}" placeholder="Enter paypal client secret ">
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
