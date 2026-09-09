@foreach($emis as $emi)
<tr>
    <td>
        <input type="text" class="form-control ami-input"
            value="{{ $emi->bank_name }}"
            data-id="{{ $emi->id }}"
            data-field="bank_name"
            data-url="{{ route('admin.themeSettingAction',['ami-update']) }}" placeholder="Enter Bank Name">
    </td>

    @foreach([3,6,9,12,18,24,36] as $m)
    <td>
        <input type="number" class="form-control ami-input monthChargeInput"
            value="{{ $emi['month_'.$m] }}"
            data-id="{{ $emi->id }}"
            data-field="month_{{ $m }}"
            data-url="{{ route('admin.themeSettingAction',['ami-update']) }}">
    </td>
    @endforeach

    <td>
        <span class="badge badge-danger deleteAMI"
            data-id="{{ $emi->id }}"
            data-url="{{ route('admin.themeSettingAction',['ami-delete']) }}"
            style="cursor:pointer;">
            <i class="fa fa-trash"></i>
        </span>
    </td>
</tr>
@endforeach
