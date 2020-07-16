<?php require_once 'includes/cabecera.php'; ?>
		
<div id="buscador" class="bloque">
		<h3>Buscar</h3>

		<form action="buscar.php" method="POST"> 
			<input type="text" name="busqueda" />
			<input type="submit" value="Buscar" />
		</form>
</div>	
<!-- CAJA PRINCIPAL -->
<div class="container ">
    <div class="col-sm-12">
        <table class="table table-striped">
        <thead>
				<th>Cédula</th>
				<th>Nombres y apellidos</th>
				<th>Correo particular</th>
                <th>Correo Ucab</th>
                <th>Teléfono</th>
                <th>Fecha Ingreso</th>


		    </thead>		
			
			<tbody>
				
                <tr>
                    <td> 27407957  </td>	
                    <td> Braulio Zapata </td>
                    <td> brauliozapatad@gmail.com </td>
                    <td> bjzapata.18@ucab.edu.ve </td>
                    <td> 04249287567 </td>
                    <td> 20/03/2020 </td>						
							
                </tr>

                <tr>
                    <td> 27296100  </td>	
                    <td> Yohangel Lopéz </td>
                    <td> yohangel@gmail.com </td>
                    <td> yj.lopez.18@ucab.edu.ve </td>
                    <td> 0424587999 </td>
                    <td> 20/03/2020 </td>						
							
                </tr>

                <tr>
                    <td> 25111256  </td>	
                    <td> Angel Gomez</td>
                    <td> angel@gmail.com </td>
                    <td> aj.gomez.18@ucab.edu.ve </td>
                    <td> 0424333698 </td>
                    <td> 20/03/2020 </td>						
							
                </tr>

                <tr>
                    <td> 25123877  </td>	
                    <td> Erick Rozas </td>
                    <td> erick@gmail.com </td>
                    <td> ej.rozas.18@ucab.edu.ve </td>
                    <td> 0414586777 </td>
                    <td> 20/03/2020 </td>						
							
                </tr>

                <tr>
                    <td> 25987666  </td>	
                    <td> Daniel Díaz </td>
                    <td> daniel@gmail.com </td>
                    <td> dj.diaz.18@ucab.edu.ve </td>
                    <td> 0412697888 </td>
                    <td> 20/03/2020 </td>						
							
                </tr>

			</tbody>
        </table>
    </div>
</div>
			
<?php require_once 'includes/pie.php'; ?>