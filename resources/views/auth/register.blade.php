<x-app-layout>
    <div class="container">
        <div class="rows">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success mb-2">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h5 class="card-title">Register</h5>
                        <form method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>