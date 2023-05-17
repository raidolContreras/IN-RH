<script src="assets/libs/vendor/OrgChartJS/OrgChart.js"></script>
<?php 
$organigrama = ControladorFormularios::ctrOrganigrama();
?>
<div id="tree"></div>

<script>
//JavaScript


OrgChart.templates.cool = Object.assign({}, OrgChart.templates.ana);
OrgChart.templates.cool.defs = '<filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="cool-shadow"><feOffset dx="0" dy="4" in="SourceAlpha" result="shadowOffsetOuter1" /><feGaussianBlur stdDeviation="10" in="shadowOffsetOuter1" result="shadowBlurOuter1" /><feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.1 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1" /><feMerge><feMergeNode in="shadowMatrixOuter1" /><feMergeNode in="SourceGraphic" /></feMerge></filter>';

OrgChart.templates.cool.size = [310, 190];
OrgChart.templates.cool.node = '<rect filter="url(#cool-shadow)"  x="0" y="0" height="190" width="310" fill="#ffffff" stroke-width="1" stroke="#eeeeee" rx="10" ry="10"></rect><rect fill="#ffffff" x="100" y="10" width="200" height="100" rx="10" ry="10" filter="url(#cool-shadow)"></rect><rect stroke="#eeeeee" stroke-width="1" x="10" y="120" width="290" fill="#ffffff" rx="10" ry="10" height="60"></rect>';

OrgChart.templates.cool.img = '<clipPath id="{randId}"><rect  fill="#ffffff" stroke="#039BE5" stroke-width="5" x="10" y="10" rx="10" ry="10" width="80" height="100"></rect></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#{randId})" xlink:href="{val}" x="10" y="10"  width="80" height="100"></image><rect fill="none" stroke="#F57C00" stroke-width="2" x="10" y="10" rx="10" ry="10" width="80" height="100"></rect><text style="font-size: 16px;" fill="#F57C00" x="30" y="145">Empresa</text>';

OrgChart.templates.cool.link = '<path stroke-linejoin="round" stroke="#aeaeae" stroke-width="1px" fill="none" d="{curve}" />';

OrgChart.templates.cool.name = '<text  style="font-size: 16px;" fill="#afafaf" x="110" y="45">{val}</text>';
OrgChart.templates.cool.title = '<text  style="font-size: 14px;" fill="#F57C00" x="110" y="65">{val}</text>';
OrgChart.templates.cool.title2 = '<text style="font-size: 14px;" fill="#afafaf" x="110" y="85">{val}</text>';
OrgChart.templates.cool.title3 = '<text style="font-size: 16px;" fill="#afafaf"  x="30" y="165">{val}</text>';
OrgChart.templates.cool.nodeMenuButton =
	'<g style="cursor:pointer;" transform="matrix(1,0,0,1,270,20)" data-ctrl-n-menu-id="{id}">'
	+ '<rect x="-4" y="-10" fill="#000000" fill-opacity="0" width="22" height="22"></rect>'
	+ '<circle cx="0" cy="0" r="2" fill="#F57C00"></circle>'
	+ '<circle cx="7" cy="0" r="2" fill="#F57C00"></circle><circle cx="14" cy="0" r="2" fill="#F57C00"></circle>'
	+ '</g>';

var chart;
chart = new OrgChart(document.getElementById('tree'), {

    editForm: {
		buttons: {
			edit: {
				hideIfDetailsMode: true
			},
			share: {
				hideIfDetailsMode: true
			},
			pdf: {
				hideIfDetailsMode: true
			},
			remove: {
				hideIfDetailsMode: true
			}
		}
	},
	mouseScrool: OrgChart.none,
	enableSearch: false,
	template: 'cool',
	nodeBinding: {
		name: 'Nombre',
		title: 'Puesto',
		title2: 'Departamento',
		title3: 'Empresa',
		img: 'img'
	},
});

chart.load([
	<?php foreach ($organigrama as $key => $value): ?>
		<?php 
			// Obtener los datos del empleado
			$idEmpleado = $value['idEmpleados'];
			$name = ucwords(mb_strtolower($value['name']." ".$value['lastname']));
			$namePuesto = $value['namePuesto'];
			$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $value['Departamentos_idDepartamentos']);
			$nameDepa = ucwords(mb_strtolower($departamento['nameDepto']));
			$idDepto = $departamento['idDepartamentos'];
			$fotoEmpleado = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $value['idEmpleados']);
			$idEmpleadoDepa = $departamento['Empleados_idEmpleados'];
			
			// Obtener datos de pertenencia (si existe)
			$pertenencia = null;
			$idPertenencia = null;
			if ($departamento['Pertenencia'] != 0) {
				$pertenencia = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $departamento['Pertenencia']);
				$idPertenencia = $pertenencia['Empleados_idEmpleados'];
			}
			
			// Obtener la URL de la foto del empleado
			if (isset($fotoEmpleado['namePhoto'])) {
				$foto = "view/fotos/thumbnails/".$fotoEmpleado['namePhoto'];
			} else {
				$foto = ($value['genero'] == 1) ? "assets/images/Ejecutivo.webp" : "assets/images/Ejecutiva.webp";
			}

			// Construir el arreglo de datos
			$data = [
				'id' => $idEmpleado,
				'pid' => ($departamento['Pertenencia'] == 0) ? null : $idPertenencia,
				'Nombre' => $name,
				'Empresa' => 'InConsulting',
				'Puesto' => $namePuesto,
				'Departamento' => $nameDepa,
				'img' => $foto
			];
		?>
		<?= json_encode($data, JSON_UNESCAPED_UNICODE) ?>,
	<?php endforeach ?>
]);
</script> 