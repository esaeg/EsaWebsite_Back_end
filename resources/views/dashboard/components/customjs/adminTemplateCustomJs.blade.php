<!-- Initialize Scripts -->
<script type="module">
    $(document).ready(function () {
        $(".treeview-menu").each(function () {
            if ($(this).children().hasClass('active-submenu')) {
                $(this).addClass('menu-open');
                $(this).css('display', 'block');
                $(this).parent('li.treeview').addClass('active');
            }
        });
    });
</script>

<!-- Initialize Delete Action -->
<script type="module">
    $(document).ready(function () {

        $('.delete').click(function () {
            let id = $(this).data('id');
            $(".modal-body #row_id").val(id);

            $(this).parent().parent().addClass('about_to_delete');

        });

        $('.cancel_delete').click(function () {
            $("table").find(".about_to_delete").removeClass('about_to_delete');
        });

        $('.delete_row').click(function () {

            let id = $('#row_id').val();
            let total_result = $('#totalResult').text();
            let url = $('#path').val() + id;

            //return false;
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {"_token": "{{ csrf_token() }}"},
                cache: false,
                dataType: "json",
                success: function (success_array) {
                    $("table").find(".about_to_delete").addClass('destroy_tr');
                    setTimeout(remove_tr, 1500);
                    $("#totalResult").text(total_result - 1);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                }

            });

        });

        function remove_tr() {
            $(".destroy_tr").remove();
        }

    });
</script>

<!-- Initialize Toggle Action -->
<script type="module">
    $(document).ready(function () {

        $('.toggle').click(function (e) {

            let id = $(this).attr("data-id");
            let col = $(this).attr("data-col");
            let table = $(this).attr("data-table");
            let pk = $(this).attr("data-pk");
            let path = $('body').data('base-path');

            $.ajax({
                url: path + "/common/toggle_active",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", id: id, col: col, table: table, pk: pk},
                cache: false,
                dataType: "json",
                success: function (success_array) {

                    $(".data-table tr[id=" + id + "]  td." + col + " p ").css("color", "green").html(success_array.returned_array == 0 ? "No" : "Yes");

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Test not working " + thrownError);
                }
            });
            e.preventDefault();
        });
    });
</script>


<!-- Initialize Change Password -->
<script type="module">
    $(document).ready(function () {

        $('.popup').click(function () {
            $(".field_error").hide();
            $("#password").val("");
            $("#confirm_password").val("");
            let id = $(this).data('id');
            let email = $(this).data('email');
            $(".modal-body #row_id").val(id);
            $(".modal-body #email").html(email);
            //$(this).parent().parent().addClass('about_to_delete');
        });

        $('.popup_validate').click(function () {
            let id = $(this).data('id');
            $(".modal-body #user_id").val(id);
        });

        //hide popup window after ajax call
        function hide_popup() {
            $(".close_popup").click();
        }

        // $('.cancel_delete').click(function () {
        //     $("table").find(".about_to_delete").removeClass('about_to_delete');
        // });

        // Change Password Via Ajax
        $('.submit_change_password').click(function () {
            $(".field_error").hide();
            let id = $('#row_id').val();
            // let path = $('body').data('base-path');
            let password = $('#password').val();
            let confirm_password = $('#confirm_password').val();

            let state = Boolean();
            state = true;

            if (password === "") {
                $("#password_error").fadeIn("fast");
                state = false;
            }

            if (confirm_password === "") {
                $("#confirm_password_error").fadeIn("fast");
                state = false;
            }

            if (confirm_password !== password) {
                $("#not_match_error").fadeIn("fast");
                state = false;
            }

            if (state === true) {
                $.ajax({
                    url: '/dashboard/admins/change_password',
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}", id: id, password: password},
                    cache: false,
                    dataType: "json",
                    success: function (success_array) {
                        //alert(success_array.msg);
                        if (success_array.status === "success") {
                            $(".modal-footer #success").html(success_array.msg);
                        } else {
                            $(".modal-footer #fail").html(success_array.msg);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //alert("Test not working "+thrownError);
                    }
                });
                setTimeout(function () {
                    $('#btn-close').click();
                }, 3000);
            } else {
                return false;
            }

        });

        //Validate Code Via Ajax
        $('.submit_validate_account').click(function () {
            $(".field_error").hide();
            let id = $('#user_id').val();
            let path = $('body').data('base-path');
            let code = $('#code').val();

            let state = Boolean();
            state = true;

            if (code === "") {
                $("#code_error").fadeIn("fast");
                state = false;
            }

            if (state === true) {
                $.ajax({
                    url: path + '/validate_sms',
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}", id: id, code: code},
                    cache: false,
                    dataType: "json",
                    success: function (success_array) {
                        if (success_array.status_code === 200) {
                            $(".modal-footer #success").html(success_array.status_description);
                        } else {
                            $(".modal-footer #fail").html(success_array.status_description);
                        }

                        setTimeout(hide_popup, 3000);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        //alert("Test not working "+thrownError);
                    }

                });
            } else {
                return false;
            }

        });
    });
</script>
<!-- Show Pop up Window if there is message called back -->
@if (session('message'))
    <script>
        document.getElementById("popup_message").click();
    </script>;
@endif
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="module">
    $(document).ready(function () {
        try {
            CKEDITOR.replace('editor');
        } catch (error) {
            // console.error(error);
        }
    });
</script>
