@php $v = fn ($f) => old($f, $subject->{$f} ?? ''); @endphp
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label" for="code">Subject code</label>
        <input id="code" name="code" value="{{ $v('code') }}" class="form-control @error('code') is-invalid @enderror">
        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-5">
        <label class="form-label" for="name">Subject name</label>
        <input id="name" name="name" value="{{ $v('name') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="units">Units</label>
        <input id="units" type="number" min="1" max="12" name="units" value="{{ $v('units') ?: 3 }}" class="form-control @error('units') is-invalid @enderror">
        @error('units')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ $v('description') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
