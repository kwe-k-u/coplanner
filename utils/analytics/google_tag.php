<?php
require_once(__DIR__."/../env_manager.php");
	if (is_env_remote()){
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90XTF25RWY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90XTF25RWY');
</script>


<!-- End of php tag -->
<?php } ?>