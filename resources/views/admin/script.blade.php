 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.2/sweetalert2.min.js"
        integrity="sha512-2bCb2rCmddSPBLbYUoGR9R+gmLU/kaoYiTM4OVG3Jz+6E26MTzdozuEYt5j3X60ueQ9x6Xufz7y3jhmrHiHLZg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('assets/admincss/js/front.js') }}"></script>

    <script>
        $('.deleteConfirmationAlert').on('click', function(e){
            e.preventDefault();

            const url = $(this).attr("href");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>
