@php $v = fn ($f) => old($f, $student->{$f} ?? ''); @endphp
<div class="row g-3">
    @foreach ([
        ['student_number','Student number','text',6], ['email','Email','email',6],
        ['first_name','First name','text',6], ['last_name','Last name','text',6],
        ['course','Course','text',8], ['phone','Phone','text',4],
    ] as [$f,$label,$type,$col])
    <div class="col-md-{{ $col }}">
        <label class="form-label" for="{{ $f }}">{{ $label }}</label>
        <input id="{{ $f }}" type="{{ $type }}" name="{{ $f }}" value="{{ $v($f) }}" class="form-control @error($f) is-invalid @enderror">
        @error($f)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    @endforeach
    <div class="col-md-4">
        <label class="form-label" for="year_level">Year level</label>
        <select id="year_level" name="year_level" class="form-select @error('year_level') is-invalid @enderror">
            @for ($i = 1; $i <= 6; $i++)<option value="{{ $i }}" @selected($v('year_level') == $i)>Year {{ $i }}</option>@endfor
        </select>
        @error('year_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="gender">Gender</label>
        <select id="gender" name="gender" class="form-select">
            <option value="">Not specified</option>
            @foreach (['Male','Female','Other'] as $g)<option @selected($v('gender') === $g)>{{ $g }}</option>@endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="birthdate">Birthdate</label>
        <input id="birthdate" type="date" name="birthdate" value="{{ old('birthdate', $student->birthdate?->toDateString()) }}" class="form-control @error('birthdate') is-invalid @enderror">
        @error('birthdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="address">Address</label>
        <input id="address" name="address" value="{{ $v('address') }}" class="form-control">
    </div>
</div>
