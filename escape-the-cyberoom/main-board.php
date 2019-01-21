<div class="container">
    <section id="main-board" class="board">
        <div class="float-right">
            <form class="form-inline d-flex" method="post" action="logout.php">
                <button type="submit" class="btn btn-primary mx-auto small-btn">Log out</button>
            </form>
        </div>

            <h2><i class="fas fa-desktop"></i> Main board</h2>

            <p>Welcome dear <b><?php echo $_SESSION['login'];?></b>!</p>

            <p>Your goal is to escape this cyberoom. Enter the correct password in the <a href="#password-validation">password section</a> to unlock the door.

            <br/>Several clues are disseminated through the website. Each of them is part of an enigma that you will have to solve in order to find the password. Good luck and may the force be with you!</p>

            <h3><?php
                if ($stage <= 5) {
                    echo "Stage " . $stage;
                } else {
                    echo "Final stage : Enigma";
                }

            ?></h3>

            <blockquote>
                <?php

                    if ($stage <= 5) {
                        echo $description;
                    }

                    else {
                        echo "Pepper never goes without its alter ego. What did you expect?";
                    }


                    echo '<!-- ODUgMTA1IDExNSAxMDIgMTAyIDMyIDEwMSAxMTUgMTE4IDExMSAxMDggOTggMTE1IDEwMSAxMTYgNDQgMzIgNzggOTggMTE3IDExNyAxMDUgMTA2IDEwMiAxMTggNDQgMzIgNjkgOTggMTE5IDEwNiAxMDEgMzIgOTggMTExIDEwMSAzMiA3OCAxMjIgMTE1IDEwNiA5OCAxMTAgMzIgMTAxIDExNSAxMDYgMTExIDEwOCAzMiA5OCAzMiAxMTUgMTA1IDExOCAxMTAgMzIgOTkgOTggMTE1IDExNSAxMDIgMTA5IDMyIDExNyAxMTIgMTA0IDEwMiAxMTcgMTA1IDEwMiAxMTUgNDY= -->';
                ?>
            </blockquote>

            <?php if ($stage == 5) {
                $secret = get_secret($db_admin, $_SESSION['login']);
                echo '<a href="4979215374/' . $secret . '/secret.php">My secret</a>';
            } else if ($stage >= 6) {
                echo "<p>Congratulations! You have found all the clues. Now it is time to solve the enigma. The answer to the enigma will certainly help you to open the door... Will you be able to think and read between the lines?</p>";
            } ?>
    </section>
</div>
