
<?php if (isset($_GET['empresa'])): ?>
	<?php $empresaId = $_GET['empresa']; // ID de la empresa específica

	$empresa = controladorFormularios::ctrVerEmpresas("idEmpresas",$_GET['empresa']);
	$controladorFormularios = new ControladorFormularios();
	$controladorFormularios->generarArchivoCSV($empresaId,$empresa['nombre_razon_social']);
	 ?>
		<script src="https://d3js.org/d3.v7.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/d3-org-chart@2.6.0"></script>
		<script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div
			class="chart-container card"
		></div>
		<link
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
			rel="stylesheet"
		/>

		<script>
			var chart;
			d3.csv(
				'assets/organigrama/<?php echo $empresa['nombre_razon_social']; ?>/org.csv'
			).then((dataFlattened) => {
				chart = new d3.OrgChart()
					.container('.chart-container')
					.data(dataFlattened)
					.nodeHeight((d) => 70)
					.nodeWidth((d) => {
						if (d.depth == 0) return 260;
						if (d.depth == 1) return 240;
						return 220;
					})
					.childrenMargin((d) => 50)
					.compactMarginBetween((d) => 35)
					.compactMarginPair((d) => 40)
					.neightbourMargin((a, b) => 30)
					.buttonContent(({ node, state }) => {
						return `<div style="border-radius:3px;padding:3px;font-size:10px;margin:auto auto;background-color:lightgray"> <span style="font-size:9px">${
							node.children
								? `<i class="fas fa-chevron-up"></i>`
								: `<i class="fas fa-chevron-down"></i>`
						}</span> ${node.data._directSubordinates}  </div>`;
					})
					.nodeContent(function (d, i, arr, state) {
						const colors = ['#278B8D', '#404040', '#0C5C73', '#33C6CB'];
						const color = colors[d.depth % colors.length];
						return `
						<div style="background-color:${color}; position:absolute;margin-top:-1px; margin-left:-1px;width:${d.width}px;height:${d.height}px;border-radius:50px">
							 <img src=" ${
								 d.data.imageUrl
							 }" style="object-fit: cover; position:absolute;margin-top:5px;margin-left:${5}px;border-radius:100px;width:60px;height:60px;" />
							 <div style="position:absolute;top:-15px;width:${
								 d.width
							 }px;text-align:center;color:#fafafa;">
							</div>

							<a href='${d.data.profileUrl}'><div style="color:#fafafa;font-size:${
								d.depth < 2 ? 14 : 12
							}px;font-weight:bold;margin-left:70px;margin-top:5px"> ${d.depth < 2 ? d.data.name : (d.data.name || '').trim().split(/\s+/g)[0]} </div>
							<div style="color:#fafafa;margin-left:70px;margin-top:5px"> ${d.data.positionName} </div>
							<div style="color:#fff;margin-left:70px;margin-top:5px"> ${d.data.area} </div></a>
							
							 <!--
							 <div style="padding:30px; padding-top:35px;text-align:center">
									
							 </div> 
							 -->
					 </div>
	`;
					})
					.render();
			});
		</script></div></div>
<?php else: ?>
<div class="container-fluid dashboard-content ">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h2>Empresas</h2>
						<hr>
						<?php $empresas = ControladorFormularios::ctrVerEmpresas(null,null); ?>
						<?php foreach ($empresas as $empresa): ?>
							<?php if ($empresa['totalEmpleados']==0): ?>
								<a class="btn btn-outline-success rounded btn-block btn-lg disabled" href="Organigrama&empresa=<?php echo $empresa['idEmpresas']; ?>"><?php echo $empresa['nombre_razon_social']; ?> <span class="badge badge-light">EMPLEADOS (<?php echo $empresa['totalEmpleados']; ?>)</span></a>
							<?php else: ?>
								<a class="btn btn-outline-success rounded btn-block btn-lg" href="Organigrama&empresa=<?php echo $empresa['idEmpresas']; ?>"> <?php echo $empresa['nombre_razon_social']; ?> <span class="badge badge-light">EMPLEADOS (<?php echo $empresa['totalEmpleados']; ?>)</span></a>
							<?php endif ?>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>