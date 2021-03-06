<?php
if (isset($_SESSION["userPrivileges"]) && $_SESSION["userPrivileges"] == 1) { ?>
    <div class="row justify-content-center align-items-center" style="padding-top: 45px">
        <div class="col-8">
            <div class="text-center">
                <div class="card-header text-white bg-info"><strong>Compras</strong></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center" style="padding-top: 25px">
        <div class="col-8">
            <div class="text-center">
                <?php $indexRow = sizeof($allOutgoingSaved) + 1;?>
                <button type="button" class="btn btn-primary" value="<?php echo $indexRow ?>"
                        onclick="createRowSavedOutgoingInvoice(this)">Añadir otra
                    compra
                </button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center" style="padding-top: 25px">
        <div class="col-16">
            <div class="text-center">
                <form method="POST" action="" id="saveOutgoingForm"></form>
                <table class="table table-hover table-primary" id="outgoing">
                    <thead>
                    <tr>
                        <th scope="col" style="width:25%">Proveedor</th>
                        <th scope="col" style="width:20%">Nº REF.</th>
                        <th scope="col" style="width:20%">Fecha</th>
                        <th scope="col" style="width:11%">Total Bruto</th>
                        <th scope="col" style="width:11%">IGIC</th>
                        <th scope="col" style="width:11%">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $allGross = 0;
                    $allIgic = 0;
                    $allTotal = 0;
                    for ($i = 0; $i < sizeof($allOutgoingSaved); $i++) {
                        $supplier = $allOutgoingSaved[$i]["sup_id"];
                        $reference = $allOutgoingSaved[$i]["out_ref"];
                        $date = date('Y-m-d', strtotime($allOutgoingSaved[$i]["out_date"]));
                        $gross = $allOutgoingSaved[$i]["out_gross"];
                        $igic = $allOutgoingSaved[$i]["out_igic"];
                        $total = $allOutgoingSaved[$i]["out_total"];
                        $allGross += $gross;
                        $allIgic += $igic;
                        $allTotal += $total;
                        ?>
                        <tr>
                            <td scope="row"><select class="form-control" id="sup<?php echo($i + 1) ?>"
                                                    name="suppliers[]"
                                                    form="saveOutgoingForm" required>
                                    <option value="">Proveedor...</option>
                                    <?php for ($j = 0; $j < sizeof($suppliers); $j++) {
                                        $selected = "";
                                        if ($suppliers[$j]["sup_id"] == $supplier) $selected = "selected";
                                        echo '<option value="' . $suppliers[$j]["sup_id"] . '" ' . $selected . '>' . $suppliers[$j]["sup_name"] . '</option>';
                                    } ?>
                                </select></td>
                            <td scope="row"><input type="text" class="form-control" id="outref<?php echo($i + 1) ?>"
                                                   name="outgoingreferences[]" form="saveOutgoingForm"
                                                   autocomplete="off" required value="<?php echo $reference ?>"></td>
                            <td scope="row"><input type="date" class="form-control" id="outdate<?php echo($i + 1) ?>"
                                                   name="outgoingdates[]"
                                                   form="saveOutgoingForm" required value="<?php echo $date ?>"></td>
                            <td><input type="number" class="form-control" id="outgross<?php echo($i + 1) ?>"
                                       name="outgoinggross[]"
                                       form="saveOutgoingForm"
                                       oninput="calculateTotalSingleOutgoing(<?php echo($i + 1) ?>)" step=".01"
                                       autocomplete="off" required value="<?php echo $gross ?>">
                            </td>
                            <td><input type="number" class="form-control" id="outigic<?php echo($i + 1) ?>"
                                       name="outgoingigic[]"
                                       form="saveOutgoingForm"
                                       oninput="calculateTotalSingleOutgoing(<?php echo($i + 1) ?>)" step=".01"
                                       autocomplete="off" value="<?php echo $igic ?>"></td>
                            <td><input type="text" class="form-control" id="outtotal<?php echo($i + 1) ?>"
                                       name="outgoingtotals[]"
                                       form="saveOutgoingForm" step=".01" autocomplete="off" readonly
                                       value="<?php echo $total ?>"></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" scope="row" class=" text-right font-weight-bold"
                            style="vertical-align: middle">Suma de Totales
                        </td>
                        <td><input type="text" class="form-control" id="outallgross" name="outallgross"
                                   value="<?php echo $allGross ?>" readonly>
                        <td><input type="text" class="form-control" id="outalligic" name="outalligic"
                                   value="<?php echo $allIgic ?>" readonly>
                        <td><input type="text" class="form-control" id="outalltotal" name="outalltotal"
                                   value="<?php echo $allTotal ?>" readonly>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <div class="row justify-content-center align-items-center" style="padding-bottom:75px">
                    <div class="col-8">
                        <input type="hidden" name="saveOutgoing" form="saveOutgoingForm">
                        <button type="button" class="btn btn-primary" onclick="location.href='?page=gastos'">
                            Atrás
                        </button>
                        <button type="button" class="btn btn-primary" onclick="displayDivOutgoing()" id="saveoutbtn">
                            Guardar y exportar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center" style="padding-top: 20px;display: none;"
         id="createOutgoingFile">
        <div class="col-4">
            <div class="text-center">
                <table class="table table-hover table-info">
                    <thead>
                    <th scope="col">Nombre del documento:</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row"><input type="text" name="outgoingFileName" class="form-control"
                                               form="saveOutgoingForm" required autocomplete="off"></td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <button type="submit" form="saveOutgoingForm" class="btn btn-primary">Crear archivo
                </button>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row justify-content-center align-items-center" style="height:50vh">
        <div class="alert alert-primary" role="alert">
            Acceso Denegado. Por favor, ingresa un usuario y contraseña válidos pulsando <a href="?page=login">aquí</a>
        </div>
    </div>
<?php } ?>
