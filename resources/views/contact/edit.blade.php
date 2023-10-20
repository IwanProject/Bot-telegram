@include('layouts.header')

<div class="container mt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>
                <div class="card-body">
                    <div class="row">

                        <form action="{{ route('contact.update', $contact->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group mt-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan Nama ..." value="{{ $contact->name }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone">No.Hp</label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="Masukkan No.Hp ..." value="{{ $contact->phone }}" required>
                            </div>
                            <div class="form-group mt-3 ">
                                <button type="submit" class="btn btn-warning btn-block">Update</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@include('layouts.footer')
