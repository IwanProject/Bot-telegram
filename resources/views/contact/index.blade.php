@include('layouts.header')


<div class="container mt-3">
    <div class="mt-3 mb-3">
        <a href="/contact/create" class="btn btn-primary">Tambah Kontak</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('success-edit'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success-edit') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('success-delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('success-delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mt-3">

        <div class="card-header">
            Daftar Kontak
        </div>
        <div class="card-body">
            <div class="row">
                <table id="table-contact" class="table table-striped">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>No.HP</td>
                            <td>Dibuat</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contact as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->phone }}</td>
                                <td>{{ $c->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="/contact/{{ $c->id }}/edit" class="btn btn-warning"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <a onclick="ContactDelete({{ $c->id }})" class="btn btn-danger"><i
                                            class="fa-solid fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>

<script>
    function ContactDelete(id) {

        Swal.fire({
            text: 'Apakah kamu yakin menghapus data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/contact') }}" + '/' + id,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                            Swal.fire('Sukses di Hapus !', data.message, 'success').then(function() {
                                window.location.href = '/contact';
                            });
                        }

                        ,
                    error: function(data) {
                        Swal.fire('Upss!', data.responseJSON.message, 'error').then(function() {
                            window.location.href = '/contact';
                        });
                    }
                })
            } else {
                Swal.fire('Data tidak jadi di hapus', '', 'info')
            }
        });
    };
</script>

@include('layouts.footer')
