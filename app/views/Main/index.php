<h1>hello</h1>
<?php
echo $name . '<br>';
echo $age . PHP_EOL;
echo $nickname . PHP_EOL;

foreach ($posts as $post):?>
<h3><?=$post->title;?></h3>
<?php endforeach;?>