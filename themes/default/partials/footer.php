  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo "themes/default/assets/js/jquery-3.4.1.min.js"; ?>"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo "themes/default/assets/js/popper.min.js"; ?>"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo "themes/default/assets/js/bootstrap.min.js"; ?>"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo "themes/default/assets/js/mdb.js"; ?>"></script>

  <!-- Custom scripts -->
  <script>

    new WOW().init();

  </script>


 <!-- SCRIPTS -->

  <script>
    $(function () {

      // Data Picker Initialization
      $('.datepicker').pickadate();
      $('.datepicker, select[name="user"]').change(function(){
        $('form').trigger('submit');
      });

     

      $(".button-collapse").sideNav();

      // Material Select Initialization
      $(document).ready(function () {
        $('.mdb-select').materialSelect();

        // $('.mdb-select').on("change", function(event) {
        //     alert($(event.target).find(':selected').val);
        // });

      });

    });

  </script>
  <!-- /.JVectorMap -->

</body>

</html>
