<?php 
    include("database/db.php");
    include("function.php");
    include("includes/header.php");

    if(isset($_SESSION['message'])) {
        ?>
        <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
        #session_unset(); 
    }?>    

    <div class="container p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-body">
                    <form action="crud/save.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <input type="text" name="parte" class="form-control" placeholder="Parte" autofocus>  
                        </div>
                        
                        <div class="form-group">
                        <label for="delito">Delito</label>
                            <select name="delito" class="form-control" required>
                                <option value="">Selecciona el tipo de delito</option>
                                <option value="Accidentes de tránsito">Accidentes de tránsito</option>
                                <option value="Actos impúdicos o contra el honor">Actos impúdicos o contra el honor</option>
                                <option value="Agresión verbal y psicológica">Agresión verbal y psicológica</option>
                                <option value="Agresión física">Agresión física</option>
                                <option value="Ancianos extraviados">Ancianos extraviados</option>
                                <option value="Apoyo a gerencias y subgerencias de la MPH">Apoyo a gerencias y subgerencias de la MPH</option>
                                <option value="Apoyo a la PNP">Apoyo a la PNP</option>
                                <option value="Colapso de viviendas y afines">Colapso de viviendas y afines</option>
                                <option value="Consumo de drogas y estupefacientes">Consumo de drogas y estupefacientes</option>
                                <option value="Contaminación ambiental">Contaminación ambiental</option>
                                <option value="Contaminación auditiva">Contaminación auditiva</option>
                                <option value="Cuerpos sin vida">Cuerpos sin vida</option>
                                <option value="Desalojo en intervención de sospechosos">Desalojo en intervención de sospechosos</option>
                                <option value="Detenidos con armas, Disturbios de ebrios">Detenidos con armas, Disturbios de ebrios</option>
                                <option value="Estafas">Estafas</option>
                                <option value="Gresca callejera">Gresca callejera</option>
                                <option value="Incendios">Incendios</option>
                                <option value="Intento de suicidio">Intento de suicidio</option>
                                <option value="Maltrato animal">Maltrato animal</option>
                                <option value="Manifestaciones y protestas">Manifestaciones y protestas</option>
                                <option value="Menores y anciano en estado de abandono">Menores y anciano en estado de abandono</option>
                                <option value="Menores extraviados">Menores extraviados</option>
                                <option value="Otros">Otros</option>
                                <option value="Objetos hallados o recuperados">Objetos hallados o recuperados</option>
                                <option value="Personas danando areas verdes">Personas danando areas verdes</option>
                                <option value="Personas libando licor">Personas libando licor</option>
                                <option value="Resguardo en centros educativos">Resguardo en centros educativos</option>
                                <option value="Retiro de afiches y otros">Retiro de afiches y otros</option>
                                <option value="Retiro de comerciantes de la vía pública">Retiro de comerciantes de la vía pública</option>
                                <option value="Robo a inmuebles">Robo a inmuebles</option>
                                <option value="Robo a inmuebles">Robo a inmuebles</option>
                                <option value="Robo de vehículos">Robo de vehículos</option>
                                <option value="Robo de autoparte">Robo de autoparte</option>
                                <option value="Tentativa de violación o tocamientos indebidos y acoso">Tentativa de violación o tocamientos indebidos y acoso</option>
                                <option value="Apoyo médico por inseguridad ciudadana">Apoyo médico por inseguridad ciudadana</option>
                                <option value="Apoyo médico">Apoyo médico</option>
                                <option value="Vehículos recuperados">Vehículos recuperados</option>
                                <option value="Violencia familiar">Violencia familiar</option>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div class="input-group">
                                <input type="text" name="fecha" id="datepicker" class="form-control" placeholder="Selecciona una fecha" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="calendarBtn"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" name="hora" class="form-control" placeholder="Hora" required>  
                        </div>

                        <div class="form-group">
                            <label for="grupo">Grupo</label>
                            <select name="grupo" class="form-control" required>
                                <option value="">Selecciona el grupo</option>
                                <option value="KELO">KELO</option>
                                <option value="PULP">PULP</option>
                                <option value="CUYA">CUYA</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion" required>  
                        </div>

                        <div class="form-group">
                            <label for="zona">Zona</label>
                            <select name="zona" class="form-control" required>
                                <option value="">Selecciona la zona</option>
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                                <option value="1C">1C</option>
                                <option value="2A">2A</option>
                                <option value="2B">2B</option>
                                <option value="3A">3A</option>
                                <option value="3B">3B</option>
                                <option value="3C">3C</option>
                                <option value="4A">4A</option>
                                <option value="4B">4B</option>
                                <option value="4C">4C</option>
                                <option value="5A">5A</option>
                                <option value="5B">5B</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <input type="text" name="efectivo" class="form-control" placeholder="Efectivo" required>  
                        </div>
                        <div class="form-group">
                            <textarea name="resumen" rows="2" placeholder="Resumen"></textarea>  
                        </div>
                        <div class="form-group">  
                            <input type="file" name="archivo" class="form-control" accept="image/*"> <!-- Acepta solo imágenes --> 
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="registrar" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?> 
