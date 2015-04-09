<script>
    function conMayusculas(field) {
        field.value = field.value.toUpperCase()
    } 

     $(function () {
            $('.borrarDB').click(function () {
                    formdb = this.form;
                    $('#table_datos_bancarios').load('index.php?url=DatosBancarios&div=delDB',$(formdb).serialize());
                });
        });
</script>

<?php if($div == 'frmDB') : ?>
    <script type="text/javascript">
        /*Funcion para Agregar Datos Bancarios*/
        $(function (agregar) {
            $('#frm_dbank').submit(function (agregar) {
                agregar.preventDefault()
                $('#datos_bancarios').load('index.php?url=DatosBancarios&div=frmDB&' + $('#frm_dbank').serialize())
            });
        });

        $('document').ready(function(){
    	
            $('#table_datos_bancarios').load('index.php?url=DatosBancarios&div=tblDB&' + $('#frm_dbank').serialize())
        });             
    </script>


    <form action='#' method='POST' name='frm_dbank' id='frm_dbank' target='_self'>

          <!-- clave datos bancarios -->
         <input type='text'  name='txt_iddb' value="<?php echo $parametrosDatosBank['idBank'] ?>" readonly />
        <li>
            <label for='lbl_banco'>Banco:</label>
            <select id='banco' name='slt_banco' required>
                <option selected>Selecciona un banco...</option>
                    <?php foreach($parametrosDatosBank ['banco'] as $bank) : ?>
                        <option value="<?php echo $bank['id_banco'] ?>"><?php echo $bank['nombre_banco'] ?></option>
                    <?php endforeach; ?>
                </select>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>
            
        <li>
            <label for='lbl_sucursal'>Sucursal:</label>
            <input type='text' name='txt_suc' required onChange='conMayusculas(this)'/>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>

        <li>
            <label for='lbl_titular'>Titular:</label>
            <input type='text' name='txt_titul' required onChange='conMayusculas(this)'/>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>

        <li>
            <label for='lbl_cuenta'>No. Cuenta:</label>
            <input type='text' name='txt_cuenta' maxlength='20' required/>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>

        <li>
            <label for='lbl_clabe'>Clabe Interbancaria:</label>
            <input type='text' name='txt_clabe' maxlength='18' required/>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>

        <li>
            <label for='lbl_tipo_cuenta'>Tipo de cuenta:</label>
            <select id='tipo_c' name='slt_tipo_c' required>
                <option value selected>Selecciona un tipo de cuenta...</option>
                <?php foreach ($parametrosDatosBank ['tipo_cta'] as $tipo_c) : ?>
                    <option value="<?php echo $tipo_c['id_tipo_cuenta'] ?>"><?php echo $tipo_c['tipo_cuenta'] ?></option>
                <?php endforeach; ?>
            </select>
            <span style='color: red;'><b>&nbsp;*</b></span>
        </li>

        <li>
            <input type="hidden" name="txt_IDProv" value="<?php echo $parametrosProveedores['idprov'] ?>"> 
            <input type='submit' class='boton2' name='btnAddBank' id='btnAddBank' value='Agregar'/>
        </li>
    </form>
<?php endif; ?> <!-- Fin del if div frmDB-->

<?php if($div == 'tblDB') : ?>
    <table class="table" id="miTabla">
        <caption>Datos Bancarios</caption>
        <tr>
            <th>Banco</th>
            <th>Sucursal</th>
            <th>Titular</th>
            <th>No.Cuenta</th>
            <th>Clabe</th>
            <th>Tipo</th>
            <th>Operaciones</th>
        </tr>

        <?php /*var_dump($tablaDB_Prov['datos-bancarios']);*/ 
        if($tablaDB_Prov['datos-bancarios'] != NULL) :?>
            <?php foreach($tablaDB_Prov['datos-bancarios'] as $tableDB) :?>
                <tr>
                    <td><?php echo $tableDB['nombre_banco'] ?></td>
                    <td><?php echo $tableDB['sucursal'] ?></td>
                    <td><?php echo $tableDB['titular'] ?></td>
                    <td><?php echo $tableDB['no_cuenta'] ?></td>
                    <td><?php echo $tableDB['no_cuenta_interbancario'] ?></td>
                    <td><?php echo $tableDB['tipo_cuenta'] ?></td>
                    <td>
                        <form action='#' method='POST' enctype='application/x-www-form-urlencoded' target="_self">
                            <input type="hidden" value="<?php echo $tableDB['id_datBank'] ?>" name="idDB" id="idDB"/>
                            <input type="hidden" value="<?php echo $tableDB['id_det_bp'] ?>" name="iddetDB" id="iddetDB"/>
                            <input type="hidden" name="txt_IDProv" value="<?php echo $parametrosProveedores['idprov'] ?>"> 
                            <!-- botón de tabla datos bancarios -->
                            <input type="button" value="Borrar" class="borrarDB boton2"/>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?> 
    </table>
<?php endif; ?>