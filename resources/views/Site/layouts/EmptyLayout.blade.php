<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Site/main.css') }}">
</head>
<body>
    
    <!-- Chen trang hien thi -->
    @yield('content')

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        @if(session('status'))
            alertify.set('notifier','position','top-right');
            alertify.success("{{ session('status') }}");
        @endif

        @if(session('error'))
            alertify.set('notifier','position','top-right');
            alertify.error("{{ session('error') }}");
        @endif
    </script>

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                format: "dd-mm-yyyy",
            }).val();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function($) {
            $(".table-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>

    <script type="text/javascript">
        $("#province").change(function(e){

            e.preventDefault();

            var provinceId = $("#province").val();

            $.ajax({
                type:'get',
                url:"{{ route('site.address.district') }}",
                data:{provinceId:provinceId},
                success:function(data){
                    $("#district").html(data);
                }
            });
        });

        $("#district").change(function(e){

            e.preventDefault();

            var districtId = $("#district").val();

            $.ajax({
                type:'get',
                url:"{{ route('site.address.ward') }}",
                data:{districtId:districtId},
                success:function(data){
                    $("#ward").html(data);
                }
            });
        });
    </script>
</body>
</html>