<div class="card mb-0">
    @include('includes.form_error')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
    <div class="card-body pb-0">

        <form id="update_role" method="POST">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nameAdd">الاسم</label>
                        <input type="text" required name="name" value="{{$role->name}}" class="form-control"
                               placeholder="ادخل الاسم">
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label>الصلاحيات</label>
                        <select name="permissions[]"
                                class="form-control select2" multiple="" data-placeholder="اختار الصلاحيات">
                            @foreach($permissions as $permission)

                                <?php $i = 0; $j = 0;?>

                                {{  $i++}}
                                @foreach($role->permissions as $rolePermission)

                                    @if($rolePermission->id == $permission->id)
                                        {{  $j++}}
                                        <option value="{{$permission->id}}"
                                                selected="selected">{{ __("page.$permission->name") }}</option>
                                    @endif
                                @endforeach
                                @if($rolePermission->id != $permission->id && $i>$j)
                                    <option value="{{$permission->id}}">{{ __("page.$permission->name") }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" data-id="{{ $role->id }}" class="btn btn-primary">{{ __('page.edit_role') }} <i class="fas "></i></button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $('.select2').select2({
        dropdownParent: ".modal"
    });
</script>
