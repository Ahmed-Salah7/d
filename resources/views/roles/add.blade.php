<div class="card mb-0">
    @include('includes.form_error')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
    <div class="card-body pb-0">
        <form  id="add_role" action="{{url('/')}}/role" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nameAdd">الاسم</label>
                        <input type="text" name="name" class="form-control" id="nameAdd"
                               placeholder="ادخل الاسم">
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label>الصلاحيات</label>
                        <select name="permissions[]"
                                class="form-control select2" multiple="" data-placeholder="اختار الصلاحيات">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{ __("page.$permission->name") }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{ __('page.add_role') }} <i class="fas "></i></button>
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
