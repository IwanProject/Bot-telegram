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

                        <form action="/contact" method="post">
                            @csrf

                            <div class="form-group mt-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan Nama ..." required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone">No.Hp</label>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="Masukkan No.Hp ..." required>
                            </div>
                            <div class="form-group mt-3 ">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@include('layouts.footer')
