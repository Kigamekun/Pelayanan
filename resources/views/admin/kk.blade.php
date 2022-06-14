@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
crossorigin="anonymous" referrerpolicy="no-referrer">
<style>
    .dropify-wrapper .dropify-message p {
        font-size: 14px;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createData">
                    Create Akta
                </button>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Akta table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Formulir</th>
                                        <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr >
                                            <td class="align-middle ">
                                                <span
                                                    class="text-secondary text-xs ms-3 font-weight-bold">{{ $item->nik }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item->no_kk }}</span>
                                            </td>
                                            <td style="width: 20%">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateData" data-id="{{ $item->id }}"
                                                    data-nik="{{  $item->nik }}"
                                                    data-no_kk="{{  $item->no_kk }}"
                                                    data-url="{{ route('admin.kk.update', ['id' => $item->id]) }}">
                                                    Update
                                                </button>
                                                <a class="btn btn-danger"
                                                    href="{{ route('admin.kk.delete', ['id' => $item->id]) }}">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateDataLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-body">
                    Loading..
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create KK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.kk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">nik</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="isi nik">
                        </div>

                        <div class="mb-3">
                            <label for="no_kk" class="form-label">no_kk</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="isi no_kk">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>




    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="${$(e.relatedTarget).data('url')}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                                <label for="nama" class="form-label">nik</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="isi nik" value="${$(e.relatedTarget).data('nik')}">
                    </div>
                    <div class="mb-3">
                                <label for="no_kk" class="form-label">no_kk</label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="isi no_kk" value="${$(e.relatedTarget).data('no_kk')}">
                            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>`;

            $('#modal-content').html(html);
            $('.dropify').dropify();

        });
    </script>

@endsection
