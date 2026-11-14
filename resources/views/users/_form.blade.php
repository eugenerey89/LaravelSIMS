@php $editing = $user->exists; @endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="name">Full name</label>
        <input id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="password">{{ $editing ? 'New password' : 'Password' }}</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
        @if ($editing)<div class="form-text">Leave blank to keep the current password.</div>@endif
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
    </div>
</div>
