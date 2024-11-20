<div class="d-flex justify-content-center align-items-center">
    <button class="btn btn-sm btn-icon btn-light w-30px h-30px btn-reset-password mx-1" data-id="{{ $query->id }}"
        data-name="{{ $query->name }}" data-email="{{ $query->email }}">
        <span class="fa fa-key"></span>
    </button>
    @if ($query['2fa_secret'])
        <button class="btn btn-sm btn-icon btn-info w-30px h-30px mx-1"
            onclick="onDisableAuthenticator('{{ $query->id }}')">
            <span class="fa fa-lock"></span>
        </button>
    @else
        <button class="btn btn-sm btn-icon btn-light w-30px h-30px mx-1" disabled>
            <span class="fa fa-lock-open"></span>
        </button>
    @endif
    <button class="btn btn-sm btn-icon btn-danger w-30px h-30px mx-1"
        {{ $query->id !== Auth::user()->id ? '' : 'disabled' }} onclick="onDeleteAccount('{{ $query->id }}')">
        <span class="fa fa-times"></span>
    </button>
    <button class="btn btn-sm btn-icon btn-warning w-30px h-30px btn-edit-account mx-1"
        {{ $query->id !== Auth::user()->id ? '' : 'disabled' }} data-id="{{ $query->id }}"
        data-name="{{ $query->name }}" data-email="{{ $query->email }}" data-number="{{ $query->number }}"
        data-rank="{{ $query->rank }}" data-position="{{ $query->position }}"
        data-role="{{ $query->getRoleNames()[0] }}">
        <span class="fa fa-edit"></span>
    </button>
</div>
