 <div class="dropdown mo-mb-2">
    <a class="btn btn-primary dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ __('page.procedures') }}
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
{{--        <button class="dropdown-item customer-details" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.edit_customer_details') }}"> {{ __('page.more_details') }}</button>--}}
        <button style="display:none;" class="dropdown-item customer-contract" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.employment_contract') }}"> {{ __('page.contract') }}</button>
        <button class="dropdown-item add-new-contract" data-c_id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.add_contract') }}" >{{ __('page.add_contract') }}</button>
	</div>
</div>