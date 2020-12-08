@if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 )
    <button class="contract_status btn btn-primary" value="{{ $status }}"
            data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}">
        {{ __('page.confirm') }}
    </button>
    @else
    <p>
        Not Permitted
    </p>
@endif