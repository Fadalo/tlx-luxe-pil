<?php
$item = $memberResource;
if (!function_exists($config['meta'][$keyMeta]['call_m'])) {
    eval($config['meta'][$keyMeta]['callback_function']);
    
}

?>
<span><?php
  eval('echo '.$config['meta'][$keyMeta]['callback_execute'].' ; ');
?>
</span>