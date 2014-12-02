<div>
  <div class="project_main">
    <div class="project_main_inner">
      <form action="<?php echo site_url('projects/submit');?>" method="post">
        <span>重复周期</span>
        <select name="repeat" id="repeat">
          <option value="yearly">每年</option>
          <option value="monthly">每月</option>
          <option value="weekly">每周</option>
          <option value="daily">每天</option>
        </select>
        <div class="repeat_detail">
          第
          <span class="yearly_detail">
            <select name="yearly_month" id="yearly_month"></select>
            个月的第
          </span>
          <span class="monthly_detail">
            <select name="yearly_th" id="yearly_th"></select>
          </span>
          <select name="yearly_weekorday" id="yearly_weekorday"></select>
        </div>
      </form>
    </div>
  </div>
  <?php include 'sidebar.php'; ?>
</div>
<script type="text/javascript">
  function add_selection(sel_id, content_array) {
    for (key in content_array) {
      $('#'+sel_id).append($("<option></option>")
                   .attr("value", key)
                   .text(content_array[key])); 
    };
  }
  $(document).ready(function(){
    yearly_weekorday_arr = {"day":"天","Monday":"星期一","Tuesday":"星期二","Wednesday":"星期三","Thursday":"星期四","Friday":"星期五","Saturday":"星期六","Sunday":"星期天"};
    add_selection("yearly_weekorday", yearly_weekorday_arr);

    var yearly_th_arr = new Object();
    for (var i = 1; i <= 31; i++) {
      yearly_th_arr[i] = i;
    };
    add_selection("yearly_th", yearly_th_arr);

    var yearly_month_arr = new Object();
    for (var i = 1; i <= 12; i++) {
      yearly_month_arr[i] = i;
    };
    add_selection("yearly_month", yearly_month_arr);
  });

  $(document).ready(function(){
    $('#repeat').change(function(){
      if (jQuery("#repeat option:selected").val() == "yearly") {
        $(".yearly_detail").show();
        $(".monthly_detail").show();
      }else if( jQuery("#repeat option:selected").val() == "monthly"){
        $(".yearly_detail").hide();
        $(".monthly_detail").show();
      }
    });
  });
</script>