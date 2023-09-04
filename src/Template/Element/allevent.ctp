<div class="event_names d-flex justify-content-between align-items-center">

    <?php if ($id) {
        $getsingleeventevents = $this->Comman->singleeventdetail($id);
    } ?>
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $getsingleeventevents['name']; ?>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
            <?php
            $getallevents = $this->Comman->getallevents();
            foreach ($getallevents as $allevent) { //pr($allevent);exit;
            ?>
                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/<?php echo $this->request->params['action']; ?>/<?php echo $allevent['id']; ?> "><?php echo $allevent['name']; ?></a>
                </li>
            <?php } ?>
            <li>
                <a class="dropdown-item browseall_event" href="<?php echo SITE_URL; ?>event/myevent">Browse All
                    Event</a>
            </li>
        </ul>
    </div>
    <div class="text-center">

        <h6 class="event_Heading">
            <?php echo $getsingleeventevents['name']; ?>
        </h6>
    </div>


    <div class="text-right mt-1">
        <a href="<?php echo SITE_URL; ?>event/<?php echo $getsingleeventevents['slug']; ?>" target="_blank" class="btn view_event">View Event</a>
    </div>

</div>