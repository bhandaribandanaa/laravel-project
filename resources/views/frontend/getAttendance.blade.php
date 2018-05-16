@extends('layout.frontend.app')
@section('title', 'Home')
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="title">Attendance</div>
            <div class="col l4 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="row">
                        <form>
                        <div class="col m12 s12">
                            <div class="input-field">

                                <input type="text" id="barcode" name="barcode" placeholder="Waiting for barcode scan..."
                                       size="20">
                                <label for="barcode">Barcode</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button type="submit" class="btn btn-flat waves-effect waves-light shopping-cart-button"
                                name="action">Submit
                        </button>
                        </form>
                    </div>
                    <!--row end-->
                </div>
            </div>
            <div class="col l8 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="row">
                        <div class="status" id="status">
                            <p class="sub_title" style="color:green;">Please Scan Barcode </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            var pressed = false;
            var chars = [];
            $(window).keypress(function (e) {
                if (e.which >= 48 && e.which <= 57) {
                    chars.push(String.fromCharCode(e.which));
                }
                console.log(e.which + ":" + chars.join("|"));
                if (pressed == false) {
                    setTimeout(function () {
                        // check we have a long length e.g. it is a barcode
                        if (chars.length >= 10) {
                            var barcode = chars.join("");
                            console.log("Barcode Scanned: " + barcode);

                            $.ajax({
                                type: 'POST',
                                url: '{{ route("barcode.attendance") }}',
                                data: {barcodeData: barcode, _token: '{!! csrf_token() !!}'},
                                success: function (response) {
                                    $("#status").html('<div class="col m8 s12">' + response.message + '</div>');
//                                    debugger;
                                    //alert(response.message);
                                },
                                error: function (e) {
                                    alert('Oops, something went wrong. Please refresh the page.');
                                },
                            });

//                            $("#barcode").val('');
                            $("#barcode").val(barcode);
                        }
                        chars = [];
                        pressed = false;
                    }, 500);
                }
                pressed = true;
            });
            $('form').on('submit', function (e) {
                e.preventDefault();
                var barcode_data = $('#barcode').val();
                debugger;
                $.ajax({
                    type: 'post',
                    url: '{{ route("barcode.attendance") }}',
                    data: {barcodeData: barcode_data, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        $("#status").html('<div class="col m8 s12">' + response.message + '</div>');
//                                    debugger;
                        //alert(response.message);
                    },
                    error: function (e) {
                        alert('Oops, something went wrong. Please refresh the page.');
                    },
                });
                $("#barcode").val(barcode_data);

            });
        });
    </script>
@stop
