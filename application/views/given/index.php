<h2 class="text-first mt-40 ml-40 mr-40">Created Quests</h2>
<div class="ml-40 mr-40 mt-24">
    <a class="btn btn-first text-white" href="<?=site_url()?>/neighbors_quests/newquest">New Quest</a>
    <div class="mt-24 mb-40 d-flex flex-wrap justify-content-between">

        <!-- <div class="d-flex mb-16 mr-8">
            <img class="bg-first" src="https://via.placeholder.com/160x200.png?text=Quest+Image" alt="">
            <div class="overflow-hidden border border-first" style="height: 200px; width: 208px;">
                <h3 class="text-center text-first mt-16">Quest Name</h3>
                <p class="text-first mt-8 ml-16">$$$$</p>
                <p class="text-first mt-8 ml-16">Difficulty <span class="ml-auto">0</span></p>
            </div>
        </div> -->

        <?php
        $count = 0;
        foreach($quests as $quest)
        {
            $base_url = base_url();
            $giver_id = $quest['giver_id'];
            $image = $quest['image'];
            $name = $quest['name'];
            $reward = $quest['reward'];
            $difficulty = $quest['difficulty'];
            $count++;

            $image_loc = $base_url."assets/images/".$giver_id."/".$image;
            list($width, $height, $type, $attr) = getimagesize($image_loc);

            $image_class = ($width > $height) ? 'quest__img' : 'quest__img--alt' ;

            echo "
            <div class='quest d-flex mb-40'>
                <div class='quest__image'>
                    <img class='bg-first $image_class' src='$image_loc' alt='$name'>
                </div>
                <div class='quest__info border border-first bg-white'>
                    <h3 class='quest__name text-center text-first mt-16'>$name</h3>
                    <p class='text-first mt-8 ml-16'>$ $reward</p>
                    <p class='text-first mt-8 ml-16'>Difficulty: <span class='ml-auto'>$difficulty</span></p>
                </div>
            </div>
            ";
        }
        for($i = ($count % 3); $i < 3; $i++) {
            echo "
            <div class='quest quest--hidden d-flex mb-40'>
                <div class='quest__image'>
                    <img class='bg-first' src='https://via.placeholder.com/160x200.png?text=Quest+Image' alt=''>
                </div>
                <div class='quest__info border-first'>
                    <h3 class='quest__name text-center text-first mt-16'></h3>
                    <p class='text-first mt-8 ml-16'>$</p>
                    <p class='text-first mt-8 ml-16'>Difficulty: <span class='ml-auto'></span></p>
                </div>
            </div>
            ";
        }
        ?>
            
    </div>
</div>