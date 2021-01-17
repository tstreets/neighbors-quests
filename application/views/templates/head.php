<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$page_title?></title>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">
    <script>
        const globalRef = {
            "base url": `<?=base_url()?>`,
            "site url": `<?=site_url()?>`,
            'page title': `<?=$page_title?>`,
            'this page': `<?=$this_page?>`,
            'user id': `<?=$this->session->user_id?>`
        }
    </script>
</head>
<body>
<div class="site d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light border-first" style="border: 2px solid;">
        <a class="navbar-brand text-first" href="<?=site_url()?>"><h1>Neighbors' Quests</h1></a>
        <div class="d-flex">
            <a class="nav-link text-first" id="home" href="<?=site_url()?>">Home</a>
            <!-- <a class="nav-link text-first" id="about" href="/neighbors_quests/about">About</a> -->
            <a class="nav-link text-first" id="contact" href="<?=site_url()?>/neighbors_quests/contact">Contact</a>
            <a class="nav-link text-first" id="explore" href="<?=site_url()?>/neighbors_quests/explore">Explore</a>
        </div>
        <div class="d-flex ml-auto">
            <?php
                if($this->session->user_id > 0){
                    echo '
                    <a class="nav-link text-first" id="myquests" href="'.site_url().'/neighbors_quests/myquests">Created Quests</a>
                    <a class="nav-link text-first" id="adventures" href="'.site_url().'/neighbors_quests/adventures">Accepted Quests</a>
                    <a class="nav-link text-first" id="logout" href="'.site_url().'/neighbors_quests/logout">Logout</a>
                    ';
                }else{
                    echo '
                    <a class="nav-link text-first" id="login" href="'.site_url().'/neighbors_quests/login">Login / Signup</a>
                    ';
                }
            ?>
            
        </div>
    </nav>