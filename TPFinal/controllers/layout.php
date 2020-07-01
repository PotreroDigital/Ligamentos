<?php

//Zona de tablas.
function RootTable()
{
    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {

        if ($r = "SELECT * FROM users WHERE root") {
            mysqli_select_db($conexion, "project");
            $datos1 = mysqli_query($conexion, $r);
    
            $tablaRoots = array("id","dni","nickname","code","name","lastname","email","phone","user");
             echo '<table class="col-11 table table-sm table-bordered table-striped table-dark text-left m-5">
                    <tr class="bg-dark">
                        <th colspan=11 class="text-center text-primary">Root</th>
                    </tr>
                    <tr class="bg-info">';
                        foreach ($tablaRoots as $raiz) {echo "<td class='text-center'>$raiz</td>";}
                    '</tr>'; 

            while ($f1 = mysqli_fetch_array($datos1)) {
                echo '<tr>
                        <td class="text-center">'.$f1["id"].'</td>
                        <td>'.$f1["dni"].'</td>  
                        <td>'.$f1["nickname"].'</td>
                        <td>'.$f1["code"].'</td>
                        <td>'.$f1["name"].'</td>
                        <td>'.$f1["lastname"].'</td>
                        <td>'.$f1["email"].'</td> 
                        <td>'.$f1["phone"].'</td>  
                        <td class="text-center">root</td>                             
                    </tr>';                 
            }
                '</table>';
        }
    }
}

function AdminTable()
{
    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {

        if ($a = "SELECT * FROM users WHERE admin") {
            mysqli_select_db($conexion, "project");
            $datos2 = mysqli_query($conexion, $a);

            $tablaAdmins = array("id","dni","nickname","code","name","lastname","email","phone","user");
            echo '<table class="col-11 table table-sm table-bordered table-striped table-dark text-left m-5">
                    <tr class="bg-dark">
                        <th colspan=11 class="text-center text-primary">Admin</th>
                    </tr>
                    <tr class="bg-info">';
                        foreach ($tablaAdmins as $istrador) {echo "<td class='text-center'>$istrador</td>";}
                    '</tr>'; 

            while ($f2 = mysqli_fetch_array($datos2)) {
                echo '<tr>
                        <td class="text-center">'.$f2["id"].'</td>
                        <td>'.$f2["dni"].'</td>  
                        <td>'.$f2["nickname"].'</td>
                        <td>'.$f2["code"].'</td>
                        <td>'.$f2["name"].'</td>
                        <td>'.$f2["lastname"].'</td>
                        <td>'.$f2["email"].'</td> 
                        <td>'.$f2["phone"].'</td>  
                        <td class="text-center">admin</td>                             
                    </tr>';                 
            }
                '</table>';
        }
    }
}

function ClientTable()
{
    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {

        if ($c = "SELECT * FROM users WHERE client") {
            mysqli_select_db($conexion, "project");
            $datos3 = mysqli_query($conexion, $c);
      
            $tablaClients = array("id","dni","nickname","code","name","lastname","email","phone","user");
             echo '<table class="col-11 table table-sm table-bordered table-striped table-dark text-left m-5">
                    <tr class="bg-dark">
                        <th colspan=11 class="text-center text-primary">Client</th>
                    </tr>
                    <tr class="bg-info">';
                        foreach ($tablaClients as $clientes) {echo "<td class='text-center'>$clientes</td>";}
                    '</tr>'; 

            while ($f3 = mysqli_fetch_array($datos3)) {
                echo '<tr>
                        <td class="text-center">'.$f3["id"].'</td>
                        <td>'.$f3["dni"].'</td>  
                        <td>'.$f3["nickname"].'</td>
                        <td>'.$f3["code"].'</td>
                        <td>'.$f3["name"].'</td>
                        <td>'.$f3["lastname"].'</td>
                        <td>'.$f3["email"].'</td> 
                        <td>'.$f3["phone"].'</td>  
                        <td class="text-center">client</td>                             
                    </tr>';                 
            }
                '</table>';
        }
    }
}


function Visitor()
{
//Sin uso.
}

//Zona de funciones pesadas.
function Register()
{
    $dni = $_POST["dni"];
    $nName = $_POST["nick"];
    $pWord = $_POST["code"];
    $fName = $_POST["nombre"];
    $lName = $_POST["apellido"];
    $email = $_POST["email"];
    $phone = $_POST["telefono"];
    $value = $_POST['filter'];
    
    
    if (empty($dni)) {
        echo "ERROR: Por favor, proporcione su dni.<br>";
    }elseif (empty($nName)) {
        echo "ERROR: Por favor, proporcione su nombre.<br>";
    }elseif (empty($pWord)) {
        echo "ERROR: Por favor, proporcione su contraseña.<br>";
    }elseif (empty($fName)) {
        echo "ERROR: Por favor, proporcione su nombre.<br>";
    }elseif (empty($lName)) {
        echo "ERROR: Por favor, proporcione su apellido.<br>";
    }elseif (empty($email)) {
        echo "ERROR: Por favor, proporcione su email.<br>";
    }elseif (empty($phone)) {
        echo "ERROR: Por favor, proporcione su teléfono.<br>";
    }
    
    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
            echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";

        if ($q = "SELECT dni FROM users WHERE dni='$dni'") {
            mysqli_select_db($conexion, "project");
            $datos = mysqli_query($conexion, $q);

            if (mysqli_num_rows($datos) > 0) {
                echo "<p>Ya está en la base de datos.</p>";
                echo '<a href="user.php" class="badge badge-pill badge-success p-2">Volver</a>';
            }else{

                switch ($value) {
                    case '1':
                        $consulta = "INSERT INTO users (id,dni,nickname,code,name,lastname,email,phone,root,admin,client) 
                        VALUES ('','$dni','$nName','$pWord','$fName','$lName','$email','$phone','1','','')";
                        mysqli_select_db($conexion, "project");
                        echo "<p>Nuevo root.</p>";
                        break;
                    case '2':
                        $consulta = "INSERT INTO users (id,dni,nickname,code,name,lastname,email,phone,root,admin,client) 
                        VALUES ('','$dni','$nName','$pWord','$fName','$lName','$email','$phone','','2','')";
                        mysqli_select_db($conexion, "project");
                        echo "<p>Nuevo admin.</p>";
                        break;
                    case '3':
                        $consulta = "INSERT INTO users (id,dni,nickname,code,name,lastname,email,phone,root,admin,client) 
                        VALUES ('','$dni','$nName','$pWord','$fName','$lName','$email','$phone','','','3')";
                        mysqli_select_db($conexion, "project");
                        echo "<p>Nuevo cliente.</p>";
                        break;
                    default:
                        echo "<p>¡Andá a la cancha!.</p>";
                        break;
                    }
                
                if (mysqli_query($conexion, $consulta)) {
                    echo "<p>Registro agregado.</p>";
                }else {
                    echo "<p>No se agregó...</p>";
                } 
            echo '<a href="user.php" class="badge badge-pill badge-warning text-white p-2">Volver</a>';  
            }      
        }
    }else {
        echo"<p>MySQL no reconoce ese usuario y password.</p>";
    }   
}

function Login()
{
    $nName = $_POST["nick"];
    $pWord = $_POST["code"];

    if (empty($nName)) {
        echo "ERROR: Por favor, proporcione su apodo.<br>";
    }elseif (empty($pWord)) {
        echo "ERROR: Por favor, proporcione su contraseña.<br>";
    }
    
        if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
            echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";
        
            if ($q = "SELECT * FROM users WHERE nickname='$nName' and code='$pWord'") {
                mysqli_select_db($conexion, "project");
                $reg = mysqli_query($conexion, $q);
                $dato = mysqli_fetch_array($reg);
        
                if ($dato['nickname'] == $nName && $dato['code'] == $pWord) {
                    echo "<p>Usuario encontrado.</p>";  
                
                    if ($dato['root'] == 1) {
                        session_start();
                        $_SESSION["root"] = $dato;
                        //echo "<p>¡Hola ".$dato['nickname'].", sos root!</p>";
                        header("Location: user.php");

                    }elseif ($dato['admin'] == 2) {
                        session_start();
                        $_SESSION["admin"] = $dato;
                        //echo "<p>¡Hola ".$dato['nickname'].", sos admin!</p>";
                        header("Location: user.php");

                    }elseif ($dato['client'] == 3) {
                        session_start();
                        $_SESSION["client"] = $dato;
                        //echo "<p>¡Hola ".$dato['nickname'].", sos client!</p>";
                        echo '<h4 class="m-5">Client</h4><br>
                        <a href="user.php" class="badge badge-pill badge-grape p-2">Crear tabla.</a>
                        <a href="logout.php" class="badge badge-pill badge-success p-2">Cerrar sesión.</a>';

                    }else {
                        echo "<p>Registrate fierita.</p>";
                        Visitor();
                    }
                }else {
                    echo "Puede registrarse";
                    FormAutoReg();
                }
            }else {
                echo "Registrate chamigo";
            }     
        }else {
            echo"<p>MySQL no reconoce ese usuario y password.</p>";
        } 
}

function User() 
{
    session_start();

    if (empty($_SESSION["admin"]) && empty($_SESSION["client"]) && $_SESSION["root"]) {
        echo '<h4 class="m-5">Root</h4><br>
                <form action="control.php" method="post">
                    <select name="crud">
                        <option value="1">Crear</option>
                        <option value="3">Editar</option>
                        <option value="5">Borrar</option>
                    </select>
                    <input class="bg-primary text-white border rounded-pill" type="submit" value="Enviar">
                </form>
            <a href="lista.php" class="badge badge-pill badge-orange p-2" value="1">Ver tablas.</a>
            <a href="logout.php" class="badge badge-pill badge-success p-2">Cerrar sesión.</a>';

    }elseif (empty($_SESSION["root"]) && empty($_SESSION["client"]) && $_SESSION["admin"]) {
        echo '<h4 class="m-5">Admin</h4><br>
                <form action="control.php" method="post">
                    <select name="crud">
                        <option value="2">Crear</option>
                        <option value="4">Editar</option>
                        <option value="6">Borrar</option>
                    </select>
                    <input class="bg-primary text-white border rounded-pill" type="submit" value="Enviar">
                </form>
            <a href="lista.php" class="badge badge-pill badge-orange p-2">Ver tablas.</a>
            <a href="logout.php" class="badge badge-pill badge-success p-2">Cerrar sesión.</a>'; 

    }elseif (empty($_SESSION["root"]) && empty($_SESSION["admin"]) && $_SESSION["client"]) {
        FormCamp();
    }else {
        header("Location: index.php");
        exit();
    }
}

function Lista()
{
    session_start();

    if (empty($_SESSION["admin"]) && empty($_SESSION["client"]) && $_SESSION["root"]) {
        
        if ($conexion = mysqli_connect("127.0.0.1", "root","")) {

            if ($l = "SELECT * FROM users WHERE root") {
                mysqli_select_db($conexion, "project");
                $d1 = mysqli_query($conexion, $l);
                $show1 = mysqli_fetch_array($d1);

                echo '<a href="user.php" class="badge badge-pill badge-warning text-white mt-5 p-2">Volver.</a>'; 

                if ($show1['root'] == 1) {               
                    RootTable(); 
                    AdminTable();           
                }
            }
        }
    }elseif (empty($_SESSION["root"]) && empty($_SESSION["client"]) && $_SESSION["admin"]) {
        
        if ($conexion = mysqli_connect("127.0.0.1", "root","")) {

            if ($m = "SELECT * FROM users WHERE admin") {
                mysqli_select_db($conexion, "project");
                $d2 = mysqli_query($conexion, $m);
                $show2 = mysqli_fetch_array($d2);
                
                echo '<a href="user.php" class="badge badge-pill badge-warning text-white mt-5 p-2">Volver.</a>'; 

                if ($show2['admin'] == 2) {
                    AdminTable();
                    ClientTable();    
                }
            }
        }
    }elseif (empty($_SESSION["root"]) && empty($_SESSION["admin"]) && $_SESSION["client"]) {
        echo "<strong>Client</strong><br>";
        FormCamp();
    }else {
        header("Location: index.php");
        exit();
    }
}

function Control()
{
    session_start();
    $option = $_POST['crud'];

    if (empty($_SESSION["admin"]) && empty($_SESSION["client"]) && $_SESSION["root"]) {
        echo "<strong>Root</strong><br>";

        switch ($option) {
            case '1':
                FormReg();
                break;
            case '3':
                FormEdit();           
                break;
            case '5':
                FormDel();
                break;
            }

    }elseif (empty($_SESSION["root"]) && empty($_SESSION["client"]) && $_SESSION["admin"]) {
        echo "<strong>Admin</strong><br>";

        switch ($option) {
            case '2':
                FormReg();
                break;
            case '4':
                FormEdit();
                break;
            case '6':
                FormDel();
                break;
            }

    }elseif (empty($_SESSION["root"]) && empty($_SESSION["admin"]) && $_SESSION["client"]) {
        echo "<strong>Client</strong><br>";
        FormCamp();
    }else {
        header("Location: index.php");
        exit();
    }
}

function Auxit()
{
    $dni = $_POST["dni"];

    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
        echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";

        if ($e = "SELECT * FROM users WHERE dni='$dni'") {
            mysqli_select_db($conexion, "project");
            $mod = mysqli_query($conexion, $e);
            $dato3 = mysqli_fetch_array($mod);
        
            if ($dato3['dni'] == $dni) {
                echo "<p>Usuario encontrado.</p>";  
                return $dato3;
            }else {
                echo "<p>Mala suerte.</p>";  
            }
        }
    }else {
        echo "<p> MySQL no conoce ese usuario y password</p>";
    }
}

function Edit()
{
    $dni2 = $_POST["dni2"];
    $nName2 = $_POST["nick2"];
    $pWord2 = $_POST["code2"];
    $fName2 = $_POST["nombre2"];
    $lName2 = $_POST["apellido2"];
    $email2 = $_POST["email2"];
    $phone2 = $_POST["telefono2"];

    if (empty($dni2)) {
        echo "ERROR: Por favor, proporcione su documento.<br>";
    }elseif (empty($nName2)) {
        echo "ERROR: Por favor, proporcione su nombre.<br>";
    }elseif (empty($pWord2)) {
        echo "ERROR: Por favor, proporcione su contraseña.<br>";
    }elseif (empty($fName2)) {
        echo "ERROR: Por favor, proporcione su nombre.<br>";
    }elseif (empty($lName2)) {
        echo "ERROR: Por favor, proporcione su apellido.<br>";
    }elseif (empty($email2)) {
        echo "ERROR: Por favor, proporcione su email.<br>";
    }elseif (empty($phone2)) {
        echo "ERROR: Por favor, proporcione su teléfono.<br>";
    }

        if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
            echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";

            if ($e = "SELECT * FROM users WHERE dni='$dni2'") {
                mysqli_select_db($conexion, "project");
                $moda = mysqli_query($conexion, $e);
                $dato4 = mysqli_fetch_array($moda);
            
                if ($dato4['dni'] == $dni2) {
                    $consulta = "UPDATE users SET nickname='$nName2', code='$pWord2', name='$fName2', lastname='$lName2', email='$email2', phone='$phone2' WHERE dni=$dni2";
                    mysqli_query($conexion, $consulta);
                    echo "<p>Se actualizó correctamente.</p>";
                }
                echo '<a href="user.php" class="badge badge-pill badge-warning text-white p-2">Volver</a>';
            }     
        }else {
            echo"<p>MySQL no reconoce ese usuario y password.</p>";
        }   
}

function Delete()
{
    $dni = $_POST["dni"];

    if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
        echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";

        if ($d = "SELECT * FROM users WHERE dni='$dni'") {
            mysqli_select_db($conexion, "project");
            $datos = mysqli_query($conexion, $d);
            $dato2 = mysqli_fetch_array($datos);

            if ($dato2['dni'] == $dni) {
                mysqli_select_db($conexion, "project");
                $consulta = "DELETE FROM users WHERE dni='$dni'";
            
                if (mysqli_query($conexion, $consulta)) {
                    echo "<p>Registro eliminado.</p>";
                    echo '<a href="user.php" class="badge badge-pill badge-warning text-white mt-5 p-2">Volver.</a>'; 
                }else {
                    echo "<p>No se borró...</p>";
                }
            }else{
                echo "<p>No existís.</p>";
                header("Location: control.php");
            }
        }else{
            echo "<p>Registrate maquinola.</p>";
        }
    }else {
        echo"<p>MySQL no reconoce ese usuario y password.</p>";
    }
}

function Table()
{
    $value = $_POST['T1'];

    if (ctype_digit($value) && $value>=0 or $value<0) {
        echo '<div class="col-2 bg-gray-dark text-white float-left border border-rounded border-primary mt-3"> 
                <div class="container">
                    <form action="new.php" method="post">
                        <input class="bg-primary text-white mt-2" type="submit" value="Enviar">
                        <p><input class="bg-teal-light text-center" type="hidden" name="T2" value="'.$value.'"></p>
                        <p>Campos</p>';  
                        for ($i=0; $i<$value; $i++) { 
                            echo '<p><input class="border rounded-pill text-center" type="text" name="'.$i.'" size="16"></p>';               
                        }
                    '</form>
                </div>
            </div>';
    }else {
        echo '<h6 class="m-2 text-danger">"'.$value.'" no es un dato válido.</h6>';
        FormCamp();
    }
}

function NewTable()
{   
    $value = $_POST['T2'];

    $a = 0;
    $clientTable = array("Name","Type","Length/Values","Default","Collation","Attributes","Null","A_I","Comments");

    echo '<table class="col-'.$value.' table table-sm table-bordered table-striped bg-info text-white text-center m-5">';

            while ($a < $value) {
                $valor[$a]= $_POST[$a];          
                echo '<tr>
                        <td>'.$valor[$a].'</td>';
                        FormTable();
                    '</tr>';                                                         
                $a++;
            } 
        '</table>';           

    /* if ($conexion = mysqli_connect("127.0.0.1", "root","")) {
        echo "<p>MySQL le ha dado permiso a PHP para ejecutar consultas con ese usuario.</p>";
        
        mysqli_select_db($conexion, "project");
        $datos = mysqli_query($conexion, $q);
    
    }else {
        echo"<p>MySQL no reconoce ese usuario y password.</p>";
    } */
}

//Zona de formularios.
function FormAutoReg()
{
    echo '<div class="col-2 d-flex flex-wrap bg-dark text-teal float-left border border-rounded border-primary mt-5"> 
            <div class="container">  
                <h3 class="mt-4 text-center">Register</h3>     
                <form action="register.php" method="post">
                    <p class="mt-4">DNI:<br>
                    <input class="border rounded-pill" type="text" name="dni" size="16"></p>
                    <p>Nickname:<br>
                    <input class="border rounded-pill" type="text" name="nick" size="16"></p>
                    <p>Password:<br>
                    <input class="border rounded-pill" type="text" name="code" size="16"></p>          
                    <p>Nombre:<br>
                    <input class="border rounded-pill" type="text" name="nombre" size="16"></p>     
                    <p>Apellido:<br>
                    <input class="border rounded-pill" type="text" name="apellido" size="16"></p>
                    <p>Email:<br>
                    <input class="border rounded-pill" type="text" name="email" size="16"></p>
                    <p>Teléfono:<br>
                    <input class="border rounded-pill" type="text" name="telefono" size="16"></p>
                    <input type="hidden" name="filter" value="3">
                    <input class="bg-indigo text-white mt-2" type="submit" value="Enviar">';                     
                '</form>
            </div>
        </div>';
    return;
}

function FormReg()
{
    $option = $_POST['crud'];

    echo '<div class="col-2 d-flex flex-wrap bg-dark text-teal float-left border border-rounded border-primary mt-5"> 
            <div class="container">  
                <h3 class="mt-4 text-center">Register</h3>     
                <form action="register.php" method="post">
                    <p class="mt-4">DNI:<br>
                    <input class="border rounded-pill" type="text" name="dni" size="16"></p>
                    <p>Nickname:<br>
                    <input class="border rounded-pill" type="text" name="nick" size="16"></p>
                    <p>Password:<br>
                    <input class="border rounded-pill" type="text" name="code" size="16"></p>          
                    <p>Nombre:<br>
                    <input class="border rounded-pill" type="text" name="nombre" size="16"></p>     
                    <p>Apellido:<br>
                    <input class="border rounded-pill" type="text" name="apellido" size="16"></p>
                    <p>Email:<br>
                    <input class="border rounded-pill" type="text" name="email" size="16"></p>
                    <p>Teléfono:<br>
                    <input class="border rounded-pill" type="text" name="telefono" size="16"></p>
                    <input class="bg-indigo text-white mt-2" type="submit" value="Enviar">';
                    ($option %2 != 0)? RootOption() : AdminOption();                       
                '</form>
            </div>
        </div>';
    return;
}

function FormLog()
{
    echo'<div class="col-2 bg-teal-dark text-white float-left border border-rounded border-primary mt-5"> 
            <div class="container">
                <h3 class="m-4 text-center">Login</h3>
                <form action="login.php" method="post">
                    <p>Usuario o email:<br>
                    <input class="border rounded-pill" type="text" name="nick" size="16"></p>          
                    <p>Password:<br>
                    <input class="border rounded-pill" type="text" name="code" size="16"></p>     
                    <input class="bg-primary text-white border rounded-pill ml-5" type="submit" value="Enviar">
                </form>
            </div>
        </div>';
    return;
}

function FormChange()
{
    $bus = Auxit();

    $dni = $bus["dni"];
    $nName = $bus["nickname"];
    $pWord = $bus["code"];
    $fName = $bus["name"];
    $lName = $bus["lastname"];
    $email = $bus["email"];
    $phone = $bus["phone"];
    
    echo '<div class="col-2 bg-dark text-warning float-left border border-rounded border-primary mt-5"> 
            <div class="container">  
                <h3 class="mt-4 text-center">Edit</h3>
                <form action="edit.php" method="post">     
                    <p>DNI:<br>
                    <input class="border rounded-pill bg-teal-light" type="text" name="dni2" placeholder="nickname" value="'.$dni.'" readonly="readonly" size="16"></p>
                    <p>Nickname:<br>
                    <input class="border rounded-pill" type="text" name="nick2" placeholder="nickname" value="'.$nName.'" size="16"></p>
                    <p>Password:<br>
                    <input class="border rounded-pill" type="text" name="code2" placeholder="password" value="'.$pWord.'" size="16"></p>          
                    <p>Nombre:<br>
                    <input class="border rounded-pill" type="text" name="nombre2" placeholder="nombre" value="'.$fName.'" size="16"></p>     
                    <p>Apellido:<br>
                    <input class="border rounded-pill" type="text" name="apellido2" placeholder="apellido" value="'.$lName.'" size="16"></p>
                    <p>Email:<br>
                    <input class="border rounded-pill" type="text" name="email2" placeholder="email" value="'.$email.'" size="16"></p>
                    <p>Teléfono:<br>
                    <input class="border rounded-pill" type="text" name="telefono2" placeholder="teléfono" value="'.$phone.'" size="16"></p>
                    <input class="bg-indigo text-white mt-2" type="submit" value="Enviar">
                </form>
            </div>
        </div> ';
    return;
}

function FormDel()
{
    echo'<div class="col-2 bg-dark text-warning float-left border border-rounded border-primary mt-5"> 
            <div class="container">  
                <h3 class="mt-4 text-center">Delete</h3>
                <form action="delete.php" method="post">
                    <p>DNI:<br>
                    <input class="border rounded-pill" type="text" name="dni" size="16"></p>               
                    <input class="bg-primary text-white border rounded-pill ml-5" type="submit" value="Enviar">
                </form>
            </div>
        </div>';
    return;
}

function FormEdit()
{
    echo'<div class="col-2 bg-dark text-warning float-left border border-rounded border-primary mt-5"> 
            <div class="container">  
                <h3 class="mt-4 text-center">Búsqueda de usuario</h3>
                <form action="auxit.php" method="post">
                    <p>DNI:<br>
                    <input class="border rounded-pill" type="text" name="dni" size="16"></p>               
                    <input class="bg-primary text-white border rounded-pill ml-5" type="submit" value="Enviar">
                </form>
            </div>
        </div>';
    return;
}

function RootOption()
{
    echo '<select class="bg-orange-light" name="filter">
            <option value="1">root</option>
            <option value="2">admin</option>
        </select>';
}

function AdminOption()
{
    echo '<select name="filter">
            <option value="2">admin</option>
            <option value="3">client</option>
        </select>'; 
}

function ClientOption()
{
    
}

function FormCamp()
{
    echo '<div class="col-2 bg-grape-dark text-white float-left border border-rounded border-primary mt-3"> 
            <div class="container">
                <h3 class="m-4 text-center">Crear tabla</h3>
                <p>Elija el número de campos.</p>
                <form action="deposit.php" method="post">      
                    <p>Cantidad: <input type="text" name="T1" size="1"></p>          
                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>';
}

function FormTable()
{
    echo '<td>
            <select>
                <option value="1">INT</option>
                <option value="2">VARCHAR</option>
                <option value="3">TEXT</option>
                <option value="4">DATE</option>
            </select>
        </td>
        <td>
            <input></input>
        </td>
        <td>
            <select>
                <option value="1">None</option>
                <option value="2">As defined:</option>
                <option value="3">NULL</option>
                <option value="4">CURRENT_TIMESTAMP</option>
            </select>
        </td>';
}

//Partes de la página. 
function Head()
{
    echo '<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <link rel="stylesheet" href="https://bootstrap-colors-extended.herokuapp.com/bootstrap-colors.css" />
            <title>Document</title>
        </head>';
}

function ComHeader()
{
    echo '<header class="d-flex flex-wrap text-center">
            <div class="col-2 container bg-success text-white pt-3">           
                <h4>Potrero Digital</h4>
            </div>
            <div class="col-8 container bg-navy-dark text-teal">
                <h1>Conexion</h1>
            </div>
            <div class="col-2 container bg-info text-white pt-3">
                <a class="text-pink-dark" href="https://github.com/PotreroDigital/Ligamentos">Repositorio</a>
            </div>
        </header>';
}

function Nav()
{
    echo '<nav>
            <div class="col-2 container navbar navbar-expand-lg bg-navy-dark text-white border border-rounded border-primary mt-5">
                <a class="col-12 navbar-brand text-center text-white bg-navy border border-maroon-light" href="index.php">Home</a>
                <!--
                <div class="col-2"></div>
                <div class="col-2 collapse navbar-collapse">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Congress 113</a>
                    <div class="col-2 dropdown-menu text-center bg-vermillion-light">
                        <a class="dropdown-item" href="senate-data.html">Senate</a>
                        <a class="dropdown-item" href="house-data.html">House</a>
                    </div>
                </div>
                <div class="col-2 collapse navbar-collapse">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Party Loyalty</a>
                    <div class="col-2 dropdown-menu text-center bg-vermillion-light">
                        <a class="dropdown-item" href="senate_party-loyalty.html">Senate</a>
                        <a class="dropdown-item" href="house_party-loyalty.html">House</a>
                    </div>
                </div>
                <div class="col-2 collapse navbar-collapse">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Attendance</a>
                    <div class="col-2 dropdown-menu text-center bg-vermillion-light">
                        <a class="dropdown-item" href="senate_party-attendance.html">Senate</a>
                        <a class="dropdown-item" href="house_party-attendance.html">House</a>
                    </div>
                </div>
                -->
            </div>
        </nav>';
}

//Script bootstrap.
function Script()
{
    echo '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>';
}
?>