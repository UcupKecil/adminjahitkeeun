<script>
    let client_id;

    const create = () => {
        $('#createForm').trigger('reset');
        $('#createModal').modal('show');
    }

    const deleteData = (id) => {
        Swal.fire({
            title: 'Apa anda yakin untuk menghapus client ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            Swal.close();

            if(result.value) {
                Swal.fire({
                    title: 'Mohon tunggu',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    type: "delete",
                    url: `/client/${id}`,
                    dataType: "json",
                    success: function (response) {
                        Swal.close();

                        if(response.status) {
                            Swal.fire(
                                'Success!',
                                response.msg,
                                'success'
                            )

                            $('#table').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            }
        });
    }

    const edit = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        client_id = id;

        $.ajax({
            type: "get",
            url: `/client/${client_id}`,
            dataType: "json",
            success: function (response) {
                $('#name').val(response.name);
                $('#email').val(response.email);
                $('#photo').val(response.photo);
                $('#phone').val(response.phone);
                $('#phone1').val(response.placeBirth);
                $('#placebirth').val(response.placeBirth);
                $('#datebirth').val(response.dateBirth);




                Swal.close();
                $('#editModal').modal('show');
            }
        });
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        @if(Auth::user()->getRoleNames()[0] == 'User')
            $('#table').DataTable({
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], ['Sepuluh', 'Salawe', 'lima puluh', 'cepe', 'kabeh']],
                filter: true,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '/client/kumahaaingwe'
                },
                "columns":
                [
                    { data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'name', name:'client.name'},
                    { data: 'photo', name:'client.photo'},
                ]
            });
        @else
            $('#table').DataTable({
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], ['Sepuluh', 'Salawe', 'lima puluh', 'cepe', 'kabeh']],
                filter: true,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '/client/kumahaaingwe'
                },
                "columns":
                [
                    { data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'name', name:'client.name'},
                    { data: 'email', name:'client.email'},
                    { data: 'photo', name:'client.photo'},
                    { data: 'phone', name:'client.phone'},
                    { data: 'dateBirth', name:'client.dateBirth'},
                    { data: 'placeBirth', name:'client.placeBirth'},

                    { data: 'action', orderable: false, searchable: false},
                ]
            });
        @endif

        $('.price').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;

            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        $('#createSubmit').click(function (e) {
            e.preventDefault();


            var formData = new FormData($("#createForm")[0]);

            Swal.fire({
                title: 'Mohon tunggu',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                type: "post",
                url: "/client",
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if(data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        $('#createModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            })
        });

        $('#editSubmit').click(function (e) {
            e.preventDefault();

            var formData = new FormData($("#editForm")[0]);

            Swal.fire({
                title: 'Mohon tunggu',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({

                type: "post",
                url: `/client/${client_id}`,
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close();

                    if(data.status) {
                        Swal.fire(
                            'Success!',
                            data.msg,
                            'success'
                        )

                        client_id = null;
                        $('#editModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'warning'
                        )
                    }
                }
            })
        });
    });
</script>
