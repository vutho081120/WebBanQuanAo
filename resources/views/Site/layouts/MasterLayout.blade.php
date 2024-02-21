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

    <!-- Chen logo thanh tim kiem tai khoan gio hang -->
    @include("Site.blocks.header")

    <!-- Chen thanh dieu huong -->
    @include("Site.blocks.menu")
    
    <!-- Chen trang hien thi -->
    @yield('content')

    <!-- Chen chan trang -->
    @include("Site.blocks.footer")
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script type="text/javascript">
        @if ($errors->has('updatePassword'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('passwordModal')).show()
        @endif
        
        @if ($errors->has('phoneLogin') || $errors->has('passwordLogin'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('loginModal')).show()
        @elseif ($errors->has('phoneSignup') || $errors->has('passwordSignup'))
            bootstrap.Modal.getOrCreateInstance(document.getElementById('signupModal')).show()
        @endif

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
        // for sidebar menu entirely but not cover treeview
        $('ul.nav a').filter(function() {
            var path = this.href.replace(top.location.origin,'');
            return path == top.location.pathname;
        }).parent().addClass('active');

        // for treeview
        $('ul.nav a').filter(function() {
            var path = this.href.replace(top.location.origin,'');
            return path == top.location.pathname;
        }).parentsUntil(".nav > .sub-menu").addClass('active');
    </script>

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                format: "dd-mm-yyyy",
            }).val();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change', function(){
                var url = $(this).val();
                if (url) {
                    window.location.href = url;
                }
                return false;
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