<span class="text-primary"><i class="fas fa-comment"></i>  ({{ countThreadMessage($id) }})<a class="check-ticket" data-title="{{ __('page.check_ticket') }}" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}"> {{ $thread_title }} </a></span>

