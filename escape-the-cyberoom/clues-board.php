<?php

$nb_clues = 5;
$clues = get_clues($db_admin, $stage);

?>

<div class="container">
    <section id="clues-board" class="board">
        <div class="container">
            <h2><i class="fas fa-key"></i> Clues board</h2>

                <p>Find the clues and validate them!</p>

                <h3>Unlocked clues</h3>
                <div class="row">
                    <div class="col col-md-9">
                        <ul class="nav nav-tabs">
                            <?php
                            for ($i=1; $i<=$nb_clues; $i++) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($i == $stage) echo ' active'?>"
                                        data-toggle="tab" href="#tab-<?php echo $i ?>" role="tab">
                                        Clue <?php echo $i ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>

                        <div class="card card-tabs-1">
                            <div class="card-block">
                                <div class="tab-content">

                                    <?php

                                    for ($i=1; $i<=$nb_clues; $i++) {
                                        ?>
                                        <div
                                            id="tab-<?php echo $i;?>"
                                            class="tab-pane <?php if ($i == $stage) { echo 'active ';} ?>">

                                            <h4 class="card-title">Clue <?php echo $i; ?></h4>

                                            <p class="card-text">
                                                <?php
                                                    if ($stage > $i) {
                                                        echo $clues[$i - 1];
                                                    }

                                                    else {
                                                        echo "<i>Clue not found!</i>";
                                                    }
                                                 ?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($stage < 6) { ?>
                <h3>Validate a clue</h3>
                <div class="row">
                    <form class="form-inline d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="validate-clue" name="validate-clue" placeholder="Enter clue...">
                        <button type="submit" class="btn btn-primary mx-auto">Validate</button>
                    </form>
                </div>

                <div class="row">
                    <p class="green"><?php echo $validation_msg;?></p>
                    <p class="red"><?php echo $err_validation_msg;?></p>
                </div>

            <?php } ?>
            </section>
        </div>
