<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css">


<?php 
    $questsJSON = json_encode($quests);
?>

<div class="d-flex mr-40 overflow-hidden">
    <div class="mapview d-flex" style="width: 1000px; height: 560px;" id="map" hidden></div>

    <div class="boardview flex-wrap justify-content-between bg-third"  style="width: 1000px; height: 560px; overflow-y: scroll; padding: 40px 24px;" hidden>

        <!-- <div class="d-flex mb-16">
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
            $id = $quest['id'];
            $count++;

            $image_loc = $base_url."assets/images/".$giver_id."/".$image;
            list($width, $height, $type, $attr) = getimagesize($image_loc);

            $image_class = ($width < $height) ? 'quest__img' : 'quest__img--alt' ;
            

            echo "
            <div class='quest d-flex mb-40'>
                <div class='quest__image'>
                    <img class='bg-first $image_class' src='$image_loc' alt='$name'>
                </div>
                <div class='quest__info border border-first bg-white'>
                    <h3 class='quest__name text-center text-first mt-16'>$name</h3>
                    <p class='text-first mt-8 ml-16'>$ $reward</p>
                    <p class='text-first mt-8 ml-16'>Difficulty: <span class='ml-auto'>$difficulty</span></p>
                    <a data-id='$id' class='btn btn-first modal-trigger ml-16' data-toggle='modal' data-target='#exampleModal'>View Details</a>
                </div>
            </div>
            ";
        }
        if($count % 2 != 0) 
        {
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

    <div class="d-flex flex-column align-items-start p-3">
        <form class='focus-zipcode-form d-flex flex-column align-items-start'>
            <div class="form-group">
                <label for="">Zipcode</label>
                <input class='form-control' name='zipcode' type="text" placeholder='Zipcode'>
            </div>
            <input class='btn btn-second' type="submit" value="Search">
        </form>
        <button class="mt-5 btn btn-first switchview" data-view="map">Show Board</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-third">
      <div class="modal-header">
        <h1 class="modal-title text-first" style='font-size: 35px;' id="exampleModalLabel">Modal title</h1>
        <button type="button" class="close text-white" style='font-size: 40px;' data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-first modal-action" data-dismiss="modal">Accept Quest</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
<script src="<?=base_url()?>assets/js/explore.js"></script>

<script>
    M.quests = JSON.parse('<?=$questsJSON?>');
</script>