<?php
require_once(__DIR__."/../env_manager.php");
	if (is_env_remote()){
?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1DVHF9Z2KM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1DVHF9Z2KM');
</script>

<!-- End of php tag -->
<?php } ?>