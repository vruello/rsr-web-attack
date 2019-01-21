<?php
$messages = get_messages($db_guest);
?>

<div class="container">
    <section id="messages-board" class="board">

        <?php if ($stage >= 4) { ?>
        <div class="float-right">
            <?php if (!$private) { ?>
                <a href="<?php echo $_SERVER['PHP_SELF']?>?private=true" class="btn btn-primary mx-auto small-btn">Private messages</a>
            <?php } else { ?>
                <a href="<?php echo $_SERVER['PHP_SELF']?>" class="btn btn-primary mx-auto small-btn">Public messages</a>
            <?php } ?>
            </form>
        </div>
        <?php } ?>

        <h2><i class="fas fa-envelope"></i> Messages board</h2>

        <?php
        // Make messages public
        if ($private && $stage >= 4) { ?>
            <a href="<?php echo $_SERVER['PHP_SELF']?>?make-public=true" class="btn btn-primary mx-auto small-btn margin-bottom">Make it public!</a>
        <?php }

        // Display search bar for public messages
        if ($stage >= 3 && !$private) {
        ?>
        <div class="margin-bottom">
            <form class="form-inline d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="searchbar"
                placeholder="<?php echo ($keyword != '' ? $keyword : 'Search...')?>">
                <button type="submit" class="btn btn-primary mx-auto">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <?php
        }

        // Display private messages
        if ($private) {
            $messages = get_private_messages($db_admin, $_SESSION['login']);
        }

        // Display messages containing keyword
        else if (!empty($messages_found)) {
            $messages = $messages_found;
        }

        // Bob doesn't read messages until stage 4 (prevents Bob's session leak)
        if ($_SESSION['login'] == 'bob' && $stage < 4) {
            $messages = NULL;
        }

        foreach ($messages as $msg) { ?>
            <div class="card">
                <div class="card-header">
                    <b><?php echo ($private ? $msg['login'] : $msg['author']) . "</b>, " . $msg['date']; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $msg['content']?></p>
                </div>
            </div>

        <?php }?>

        <div class="card">
            <div class="card-header">
                Write a message
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-inline d-flex">
                        <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="write-message" placeholder="Content" maxlength="200">

                        <button type="submit" class="btn btn-primary mx-auto">Send</button>
                    </div>

                    <?php if ($stage >= 4) { ?>
                    <div class="float-right"><input type="checkbox" name="is-private"> Private message</div>
                    <?php } ?>

                </form>
            </div>
        </div>
    </section>
</div>
