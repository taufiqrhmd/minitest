<div>
    <div class="card text-bg-dark">
        <div class="card-body">
            <form action="{{ route('admin.login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mb-4">
                    <label class="col-form-label mb-2" for="email">E-mail</label>
                    <input type="email" class="form-control @if ($errors->has('email')) is-invalid @elseif($email == null) @else is-valid @endif" placeholder="user@example.com" id="email" name="email" wire:model='email'>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="col-form-label mb-2" for="password">Kata Sandi</label>
                    <input type="password" class="form-control @if ($errors->has('password')) is-invalid @elseif($password == null) @else is-valid @endif" id="password" name="password" wire:model='password'>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary fw-bold w-100 mb-4">Yuk Masuk!</button>
            </form>
        </div>
    </div>
</div>
