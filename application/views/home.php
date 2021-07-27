<div class="row">
 
  <div class="col-lg-6 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3>2</h3>

        <p>Pesan Baru</p>
      </div>
      <a href="<?php echo base_url('Kotakmasuk') ?>" class="small-box-footer">Kotak Masuk <i class="fa fa-arrow-circle-right"></i></a>
      <div class="icon">
        <i class="fa fa-envelope-o"></i>
      </div>
 
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>6 Pegawai</h3>

        <p><a href="<?php echo base_url(); ?>"><i class="fa fa-circle text-success"></i> Online</a></p>
      </div>
      <div class="small-box-footer"><br></div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>2 Admin</h3>

        <p><a href="<?php echo base_url(); ?>"><i class="fa fa-circle text-success"></i> Online</a></p>
      </div>
      <div class="small-box-footer"><br></div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-pie-chart"></i>
        <h3 class="box-title">Statistik <small>Data Posisi</small></h3>

      
      </div>
      <div class="box-body">
        <canvas id="data-posisi" style="height:250px"></canvas>
      </div>
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-pie-chart"></i>
        <h3 class="box-title">Statistik <small>Data Kota</small></h3>

      
      </div>
      <div class="box-body">
        <canvas id="data-kota" style="height:250px"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
      <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_pegawai; ?></h3>

        <p>Jumlah Pegawai</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-contact"></i>
      </div>
      <a href="<?php echo base_url('Pegawai') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
      <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $jml_kota; ?></h3>
        <p>Jumlah Kota</p>
      </div>
      <div class="icon">
        <i class="ion ion-location"></i>
      </div>
      <a href="<?php echo base_url('Kota') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $jml_posisi; ?></h3>

        <p>Jumlah Posisi</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-briefcase-outline"></i>
      </div>
      <a href="<?php echo base_url('Posisi') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<script>
  //data posisi
  var pieChartCanvas = $("#data-posisi").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_posisi; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 50,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);

  //data kota
  var pieChartCanvas = $("#data-kota").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = <?php echo $data_kota; ?>;

  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 50,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  pieChart.Doughnut(PieData, pieOptions);
</script>