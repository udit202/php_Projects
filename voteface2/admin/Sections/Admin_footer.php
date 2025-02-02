</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php       

if (isset($model)) {
    require $model;
} else {
    // Do nothing if the variable is not set
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script>
        $(".drop_btn").click(function (e) {
            e.stopPropagation();
            $('.drop_btn').not(this).children('ul').slideUp();
            $(this).find('span .drop_arrow').css('transform', 'rotate(180deg)');
            $(this).children('ul').slideToggle('slow');
        });
        $(document).click(function () {
            $('.drop_btn').children('ul').slideUp();

        });
        $(".menu_open_btn").click(function () {
            //alert("working")
            $(".sidemenu").css({ "display": "block", "width": "280px", "z-index": "3" });
            $(".sideblock").css({ "display": "block" });

        });
        $(".close_me").click(function () {
            //alert("working")
            $(".sidemenu").css({ "display": "none", "width": "0px", "z-index": "0" });
            $(".sideblock").css({ "display": "none" });

        });
        $(".menu_btn").click(function () {

            $(".menu_link").css({ "width": "300px", "left": "0px" });
            setTimeout(() => {
                $(".menu_link_ul").css({ "display": "block" });
            }, 100)
        });
        $('.dt-button').addClass(' btn btn-primary');

    </script>
    <!-- <script src="JS/Employecrud.js"></script> -->
    
        <?php       

if (isset($script)) {
    require $script;
} else {
    // Do nothing if the variable is not set
}
        ?>


</body>

</html>
    