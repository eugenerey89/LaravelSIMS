@php $c = ['Enrolled' => 'primary', 'Completed' => 'success', 'Dropped' => 'danger'][$status] ?? 'secondary'; @endphp
<span class="badge text-bg-{{ $c }}">{{ $status }}</span>
