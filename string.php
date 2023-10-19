<?

include ("include/inc.define.php");

$conn = oci_connect("nu0","c0nu","pm10prod");

$stid = oci_parse($conn, "select t.legajo from NU0.vpersonal_basico t, NU0.temail v, META4.vpersonal_sjg u
							where t.legajo = v.legajo
							and t.legajo = u.legajo
							and t.empresa = 'ALUAR'
							and ((u.cod_tipo in ('001','011')) or (t.ctro_trab = 'ABASTO'))
							and t.legajo < 95000
							and t.f_baja is null order by 1");
oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    // Usar nombres de columna en mayúsculas para los índices del array asociativo
    echo $row[0]."<br>";
}

oci_free_statement($stid);
oci_close($conn);

?>