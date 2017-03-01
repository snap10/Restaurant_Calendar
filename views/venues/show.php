
    <div class="container-fluid">
        <div class="card">
            <img class="card-img-top" src="<?php echo $venue->picturepath ?>">
            <div class="card-block">
                <h1 class="card-title">
                    <?php echo $venue->name ?>
                </h1>
                <div class="card-text">
                <?php echo $venue->description ?>
                <h3>Buchbare Features</h3>
                <ul>
                    <?php foreach ($venue->getFeatures() as $feature) { ?>
                       
                                <li><?php echo $feature->id.': '.$feature->name  ?></li>
                                    <?php } ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
