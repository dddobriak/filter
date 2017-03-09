<?php
function project_filter() {
  wp_reset_query();
  wp_reset_postdata();
  if(is_page('test-filtra')) {
  ?>
<script>
  jQuery(document).ready(function($) {
    $("#filterPrice").slider({
      min: <?php echo getFilterSlider('price')['limit_min']; ?>,
      max: <?php echo getFilterSlider('price')['limit_max']; ?>,
      step: 1,
      values: [<?php echo getFilterSlider('price')['min']; ?>, <?php echo getFilterSlider('price')['max']; ?>],
      range: true,
      slide: function(event, ui) {
          for (var i = 0; i < ui.values.length; ++i) {
              $("input.filterPriceValue[data-index=" + i + "]").val(ui.values[i]);
          }
      }
    });
    $("input.filterPriceValue").change(function() {
        var $this = $(this);
        $("#filterPrice").slider("values", $this.data("index"), $this.val());
    });
    $("#filterArea").slider({
      min: <?php echo getFilterSlider('area')['limit_min']; ?>,
      max: <?php echo getFilterSlider('area')['limit_max']; ?>,
      step: 1,
      values: [<?php echo getFilterSlider('area')['min']; ?>, <?php echo getFilterSlider('area')['max']; ?>],
      range: true,
      slide: function(event, ui) {
          for (var i = 0; i < ui.values.length; ++i) {
              $("input.filterAreaValue[data-index=" + i + "]").val(ui.values[i]);
          }
      }
    });
    $("input.filterAreaValue").change(function() {
        var $this = $(this);
        $("#filterArea").slider("values", $this.data("index"), $this.val());
    });
    $(".filterCheckbox input").checkboxradio();
    $(".filterSelect select").selectmenu();
  });
</script>
  <?php
  }
}
add_action('wp_footer','project_filter');