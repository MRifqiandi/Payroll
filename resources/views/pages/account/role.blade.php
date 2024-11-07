@switch($query->getRoleNames()[0])
    @case('staff')
        <span class="badge badge-light-success">Staff</span>
    @break

    @case('finance')
        <span class="badge badge-light-warning">Finance</span>
    @break

    @case('admin')
        <span class="badge badge-light-danger">Admin</span>
    @break

    @default
@endswitch
