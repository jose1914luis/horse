<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <title>Horse</title>
    </head>
    <body>
        <?php
        include './Orden.php';

        $orden = new Orden();

        $datos = $orden->obtenerOrden();
//        echo $datos;
        $ordenes = json_decode($datos);
        $gananciaEstimada = 0;
        ?>

        <table class="table table-inverse">
            <thead>
                <tr>                   
                    <th>Orden</th>              
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Bid/Ask</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($ordenes->result as $key) {
                    echo '<tr>';
                    echo '<td>' . $key->Exchange . '</td>';
                    echo '<td>' . $key->OrderType . '</td>';
                    echo '<td>' . $key->Quantity . '</td>';
                    echo '<td>' . number_format($key->Limit, 8, '.', ',') . '</td>';
                    echo '<td>' . number_format($key->Quantity * $key->Limit, 8, '.', ',') . '</td>';
                    echo '</tr>';
                    if (explode("-", $key->Exchange)[0] == "BTC") {
                        $gananciaEstimada = $gananciaEstimada + ($key->Quantity * $key->Limit);
                    }
                }
                ?>
            </tbody>
        </table>

        <br>
        <label>Ganacia Total (BTC):</label>
        <input type="text" readonly class="form-control" value="<?= $gananciaEstimada ?>"/>

    </body>
</html>
