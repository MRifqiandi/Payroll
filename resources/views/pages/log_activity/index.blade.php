@extends('layouts.admin.main')
@section('title', 'Log Activity')


@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">
        <h2 class="fw-bold text-primary mb-4">Log Activity</h2>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">User</th>
                        <th style="width: 15%;">Action</th>
                        <th class="text-center" style="width: 10%;">Level</th>
                        <th>Description</th>
                        <th style="width: 18%;">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user ? $log->user->name : 'Unknown' }}</td>
                        <td>{{ $log->action }}</td>
                        <td class="text-center">
                            @php
                                $level = strtolower($log->level);
                                $badgeClass = match($level) {
                                    'error' => 'badge bg-danger',
                                    'warning' => 'badge bg-warning text-dark',
                                    'info' => 'badge bg-info text-dark',
                                    'debug' => 'badge bg-secondary',
                                    default => 'badge bg-primary',
                                };
                            @endphp
                            <span class="{{ $badgeClass }}">{{ ucfirst($level) }}</span>
                        </td>
                        <td>
                            <span title="{{ $log->description }}">
                                {{ \Illuminate\Support\Str::limit($log->description, 50) }}
                            </span>
                        </td>
                        <td>{{ $log->created_at->format('d M Y, H:i:s') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data log</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        <div class="mt-3">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</div>
</div>
@endsection
