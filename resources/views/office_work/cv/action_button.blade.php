 <button type="button" class="btn btn-primary edit-cv" data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}" data-title="{{ __('page.edit_cv') }}"><i class="fas fa-edit"></i></button>
 <button type="button" class="btn btn-danger waves-effect waves-light delete-cv"  data-id="{{ base64_encode(\Carbon\Carbon::now()->format('MY').'-'.base64_encode($id)) }}"><i class="fas fa-trash-alt"></i></button>