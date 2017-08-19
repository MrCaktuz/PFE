 <?php if($games->noGame) : ?>
    <div class="section-no-content">
        <p><?php echo $games->noGame; ?></p>
    </div>
<?php else : ?>
     <?php foreach($games as $game) : ?>
        <div class="gameCard">
            <div class="gameCard-header">
                <p class="gameCard-title"><?php echo $game->team_id; ?></p>
            </div>
            <div class="gameCard-body">
                <div class="gameCard-date">
                    <p class="gameCard-day"><?php echo $game->date;?></p>
                    <p class="gameCard-time"><?php echo $game->time; ?></p>
                    <?php if($game->appointment) : ?>
                        <p class="gameCard-appointment">Rendez-vous<span><?php echo $game->appointment; ?></span></p>
                    <?php endif; ?>
                </div>
                <div class="gameCard-teams">
                    <div class="gameCard-host">
                        <p class="gameCard-hostName"><?php echo $game->host; ?></p>
                        <?php if($game->host == 'RBC Ciney') : ?>
                            <p class="gameCard-hostAddress"><?php echo $addressStreet; ?>, <?php echo $addressNumber; ?></p>
                            <p class="gameCard-hostAddress"><?php echo $addressPostalCode; ?> <?php echo $addressCity; ?></p>
                        <?php endif; ?>
                        <span class="gameCard-icon"></span>
                    </div>
                    <div class="gameCard-visitor">
                        <p class="gameCard-visitorName"><?php echo $game->visitor; ?></p>
                    </div>
                </div>
            </div>
        </div>
     <?php endforeach; ?>
    <?php if (method_exists($games, 'links')) {
        echo $games->links();
    } ?>

<?php endif; ?>
