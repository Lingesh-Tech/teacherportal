$(document).ready(function(){

    $('#studentTable').DataTable({
        "ajax": {
            "url": "form_submits/fetch_students.php", 
            "type": "GET", 
            "dataSrc": "data" 
        },
        "columns": [
            { "data": null },
            { "data": "roll_no" },
            { "data": "student_name" },
            { "data": "standard" },
            { "data": "english" },
            { "data": "language" },
            { "data": "maths" },
            { "data": "science" },
            { "data": "social" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="btn btn-warning px-4" id="editBtn" data-id="' + row.id + '">Edit</button> ' +
                           '<button class="btn btn-danger mt-2 px-3" id="deleteBtn" data-id="' + row.id + '">Delete</button>';
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        }
    });

    $('.mark_field').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#createBtn').click(function(){
        $('#studentModalTitle').text('Create Student');
        $('.saveStudent').text('Create');
        $('#student_form')[0].reset();
    });

    // Student form submit
    $('#student_form').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: "form_submits/student.php",
            type: 'POST',
            data: formData,
            success: function(response) {
                let res = JSON.parse(response);
                let status = res.status;
                if (status == 'success') {
                    Swal.fire({
                        title: "Success!",
                        text: res.message,
                        icon: "success",
                        willClose: () => {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: res.message,
                        icon: "error"
                    });
                }
            },
        });
    });
    
    // Edit button
    $(document).on('click','#editBtn',function(){
        let id = $(this).data('id');
        $.ajax({
            url: "form_submits/get_student.php", 
            type: 'POST',
            data: {id: id},
            success: function(response) {
                $('#studentModal').modal('show');
                $('#studentModalTitle').text('Edit Student');
                $('.saveStudent').text('Update');
                let parseResponse = JSON.parse(response);
                let student = parseResponse.data;
                $('input[name="roll_no"]').val(student.roll_no);
                $('input[name="student_name"]').val(student.student_name);
                $('select[name="standard"]').val(student.standard);
                $('input[name="english"]').val(student.english);
                $('input[name="language"]').val(student.language);
                $('input[name="maths"]').val(student.maths);
                $('input[name="science"]').val(student.science);
                $('input[name="social"]').val(student.social);
                $('#stud_id').val(student.id);
            },
        });
    });

    $(document).on('click', '#deleteBtn', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'form_submits/delete_student.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        let res = JSON.parse(response);
                        let status = res.status;
                        if (status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: res.message,
                                icon: "success",
                                willClose: () => {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: res.message,
                                icon: "error"
                            });
                        }
                    },
                });
            }
        });
    });
    
});