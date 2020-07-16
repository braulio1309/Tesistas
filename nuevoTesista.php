<?php require_once 'includes/cabecera.php'; ?>
		
		
<!-- CAJA PRINCIPAL -->
<div class="container login-container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8 login-form-2">
                    <h3>Datos del tesista</h3>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <span class="badge badge-warning text-center">Ingrese los datos del tesista para validar sus futuras propuestas</span>

                    </div>
                    <form>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Cedula" value="27407957" />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Correo particular" value="brauliozapatad@gmail.com" />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="telefono" value="0" />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Correo Ucab" value="" />
                        </div>
                        <div class="form-group">
                            <select class="form-control">
                                <option>Masculino</option>
                                <option>Femenino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Registrar" />
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
			
<?php require_once 'includes/pie.php'; ?>