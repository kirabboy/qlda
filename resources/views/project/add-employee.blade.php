@foreach ($add_employee as $employee)
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <img class="avatar" src="{{$employee->avatar}}"
                    alt="">
            </div>
            <div class="col text-truncate d-flex justify-content-between">
                <div class="">
                    <span class="">{{$employee->fullname}}</span>
                </div>
                <button type="button" class="btn add-product btn-sm btn-outline-primary" type="button"
                    data-product-id="{{$employee->id}}">
                    <i class="fa-solid fa-plus"></i>{{ __('add') }}
                </button>
            </div>
        </div>
    </div>
@endforeach
